import arsd.web;

import std.algorithm;
static import std.file;
import std.uuid;
import std.zlib;

struct Save {
	string id;
	string basedOn;
	long timestamp;
	string editedBy;
	/*
		the diff is a simple RLE thing of edit ops on lines
		for a substitution or insert it has a length+string thing followed
		the whole file is gzipped on disk.

		Upper two bits: operation
		Lower six bits: repeat count
	*/
	string diff;
}

class EditorApi : ApiProvider {
	export:
	/*
		load
		save
		compare
		merge conflict
		deploy to canvas
		magic field analysis
	*/
	/++
		Returns: id of the new save
		Params:
			basedOn = ID of the last version you are changing
			html    = the new HTML you want to save
	+/
	string save(string basedOn, Html html) {
		// it saves it as a diff from the base...
		string[] r1 = normalizeHtml(load(basedOn));
		string[] r2 = normalizeHtml(Element.make("div", html).requireSelector(".bz-module"));

		auto path = levenshteinDistanceAndPath(r1, r2);

		ubyte[] data;

		/*
			things on data:
				based on (16 byte guid)
				timestamp (4 byte unix timestamp)
				edited by (0-terminated string)
				diff data (binary stream)
		*/

		auto id = randomUUID();
		string editedBy = "admas";
		import core.stdc.time;
		uint timestamp = cast(int) time(null);

		data ~= cast(ubyte[]) basedOn;
		data ~= 0;

		data ~= (timestamp >>  0) & 0xff;
		data ~= (timestamp >>  8) & 0xff;
		data ~= (timestamp >> 16) & 0xff;
		data ~= (timestamp >> 24) & 0xff;

		data ~= cast(ubyte[]) editedBy;
		data ~= 0;

		EditOp last = EditOp.none;
		int lastCount = 0;

		void addOp(EditOp op, int count, string text) {
			ubyte opByte;
			final switch(op) {
				case EditOp.none: opByte = 0; break;
				case EditOp.substitute: opByte = 1; break;
				case EditOp.insert: opByte = 2; break;
				case EditOp.remove: opByte = 3; break;
			}

			assert(count > 0);
			assert(count <= 0b00_111111);

			opByte <<= 6;
			opByte |= count;

			assert(text.length == 0 || op == EditOp.insert || op == EditOp.substitute);

			data ~= opByte;
			if(op == EditOp.insert || op == EditOp.substitute) {
				data ~= text.length & 0xff;
				data ~= (text.length >> 8) & 0xff;
				data ~= (text.length >> 16) & 0xff;
				data ~= (text.length >> 24) & 0xff;
				data ~= cast(ubyte[]) text;
			}
		}

		void commit() {
			if(lastCount == 0) return;
			addOp(last, lastCount, null);
			last = EditOp.none;
			lastCount = 0;
		}

		int pos;
		int pos2;
		foreach(editOp; path[1]) {
			final switch(editOp) {
				case EditOp.none:
					if(last == EditOp.none && lastCount < 0b00_111111) {
						lastCount++;
					} else {
						commit();
						last = EditOp.none;
						lastCount = 1;
					}
					pos++;
					pos2++;
				break;
				case EditOp.insert:
					commit();
					auto newText = r2[pos2];
					pos2++;
					addOp(editOp, 1, newText);
				break;
				case EditOp.substitute:
					commit();
					auto newText = r2[pos2];
					pos++;
					pos2++;
					addOp(editOp, 1, newText);
				break;
				case EditOp.remove:
					if(last == EditOp.remove && lastCount < 0b00_111111) {
						lastCount++;
					} else {
						commit();
						last = EditOp.remove;
						lastCount = 1;
					}
					pos++;
				break;
			}
		}

		commit();

		std.file.write("data/" ~ id.toString() ~ ".dat", compress(data));

		return id.toString();
	}

	/++
		Loads the bz-module revision with the given ID
	+/
	Element load(string id) {
		id = sanitizeId(id);
		if(std.file.exists("data/" ~ id ~ ".dat")) {
			auto rawData = std.file.read("data/" ~ id ~ ".dat");
			auto data = cast(ubyte[]) uncompress(rawData);

			string basedOn;
			int pos = 0;
			while(data[pos])
				pos++;
			basedOn = cast(string) data[0 .. pos];
			pos++; // skip 0 terminator
			uint timestamp;
			timestamp |= data[pos++];
			timestamp |= data[pos++] << 8;
			timestamp |= data[pos++] << 16;
			timestamp |= data[pos++] << 24;
			string editedBy;
			auto start = pos;
			while(data[pos])
				pos++;
			editedBy = cast(string) data[start .. pos];
			pos++; // skip 0 terminator
			ubyte[] diffData = data[pos .. $];

			auto basedOnElement = load(basedOn);
			// timestamp, editedBy also available

			//return Element.make("div", to!string(diffData));

			return applyBinaryDiff(basedOnElement, diffData);
		} else if(std.file.exists("data/" ~ id ~ ".html")) {
			auto html = std.file.readText("data/" ~ id ~ ".html");
			auto normalized = normalizeHtml(Element.make("div", Html(html)).requireSelector(".bz-module"));
			return (new Document(normalized.join("\n"))).requireSelector(".bz-module");
		} else {
			return null;
		}
	}

	Element diff(string v1, string v2) {
		// FIXME: if the only difference in a line is whitespace, don't need to call it out.

		auto div = Element.make("div");

		auto r1 = normalizeHtml(load(v1)); // normalizeHtml(_getGenericContainer().requireSelector(".bz-module"));
		auto r2 = normalizeHtml(load(v2)); // (new Document(std.file.readText("../tools/1.html"))).requireSelector(".bz-module"));

		auto path = levenshteinDistanceAndPath(r1, r2);

		//std.file.write("a.html", r1.join("\n"));
		//std.file.write("b.html", r2.join("\n"));

		int pos;
		int pos2;
		foreach(editOp; path[1]) {
			final switch(editOp) {
				case EditOp.none:
					div.addChild("div", r1[pos], "no-change");
					pos++;
					pos2++;
				break;
				case EditOp.insert:
					div.addChild("div", r2[pos2], "inserted");
					pos2++;
				break;
				case EditOp.substitute:
					auto sub1 = r1[pos].splitWords();
					auto sub2 = r2[pos2].splitWords();
					auto subpath = levenshteinDistanceAndPath(sub1, sub2);
					pos++;
					pos2++;

					Element changes = Element.make("div");
					changes.addClass("substituted");

					int sp;
					int sp2;
					foreach(subeditOp; subpath[1]) {
						final switch(subeditOp) {
							case EditOp.none:
								changes.appendText(sub1[sp]);
								sp++;
								sp2++;
							break;
							case EditOp.insert:
								changes.addChild("span", sub2[sp2], "inserted");
								sp2++;
							break;
							case EditOp.substitute:
								// if the previous word was also a substitution, group
								// them together as it makes the change easier to read
								// for a human.
								if(changes.children.length && changes.children[$-1].className == "substituted-to") {
									changes.insertBefore(changes.children[$-1], Element.make("span", sub1[sp], "substituted-from"));
									changes.addChild("span", sub2[sp2], "substituted-to");
								} else if(changes.children.length && changes.children[$-1].className == "inserted") {
									// insert followed immediately by substitute can be displayed
									// as the sub from, insert, sub to
									//
									// generally speaking, any strikes should be shown consecutively
									// on the left
									//
									// then any inserts shown consecutively on the right

									changes.insertBefore(changes.children[$-1], Element.make("span", sub1[sp], "substituted-from"));
									changes.addChild("span", sub2[sp2], "substituted-to");
								} else {
									changes.addChild("span", sub1[sp], "substituted-from");
									changes.addChild("span", sub2[sp2], "substituted-to");
								}
								sp++;
								sp2++;
							break;
							case EditOp.remove:
								changes.addChild("span", sub1[sp], "removed");
								sp++;
							break;
						}
					}

					div.appendChild(changes);
				break;
				case EditOp.remove:
					div.addChild("div", r1[pos], "removed");
					pos++;
				break;
			}
		}

		return div;
	}

	string[] files() {
		import std.file;
		string[] results;
		foreach(string name; dirEntries("../tools/", "*.html", SpanMode.shallow)) {
			auto document = new Document(readText(name));
			results ~= document.title;
		}

		return results;
	}

	/* ********************************* */
	/* These functions are just a bit of plumbing for the framework. */
	/* ********************************* */

	public override Element _getGenericContainer() {
		auto document = _defaultPage();
		return document.requireElementById("editor");
	}
	public override Document _defaultPage() {
		import std.file;
		return new Document(readText("editor.html"), true, true);
	}

	protected override FileResource _catchAll(string path) {
		path = path.replace("../", "");
		import std.file;
		if(path == "bz_newui.css")
			return new DataFile("text/css", readText("../bz_newui.css"));
		else if(path.startsWith("images/"))
			return new DataFile(extensionToMime(path), cast(immutable) std.file.read("../" ~ path));
		return super._catchAll(path);
	}

	public override void _postProcess(Document document) {
		if(document.getElementById("webd-functions-js") is null) {
			string loc = cgi.getCurrentCompleteUri;
			if(loc.length > 8) {
				auto slash = loc[9 .. $].indexOf("/");
				if(slash != -1)
					loc = loc[0 .. 9 + slash + 1]; // trim off any extra path to get a root url
			}

			document.mainBody.addChild("script").src = loc ~ "functions.js?" ~ compiliationStamp;
			document.mainBody.addChild("script", "EditorApi._apiBase = " ~ toJson(loc) ~ ";");
			document.requireElementById("embedded-css").innerRawSource = std.file.readText("editor.css");
			document.requireElementById("embedded-js").innerRawSource = std.file.readText("editor.js");
		}
	}
}

// ////////////////////
// Helper functions
// ////////////////////

string extensionToMime(string path) {
	if(path.length < 4)
		throw new Exception("bad");
	if(path[$-4 .. $] == ".png")
		return "image/png";
	if(path[$-4 .. $] == ".jpg")
		return "image/jpeg";
	assert(0);
}

string[] splitWords(string s) {
	string[] words;
	string curr;

	void commit() {
		if(curr !is null)
			words ~= curr;
		curr = null;
	}

	bool inHtmlTag;
	bool inHtmlElement;
	foreach(dchar ch; s) {
		curr ~= ch;

		if(ch == '<') {
			inHtmlTag = true;
		} else if(ch == '>') {
			inHtmlTag = false;
			inHtmlElement = false;
			commit();
		}

		if(ch == ' ') {
			commit();
			if(inHtmlTag) {
				inHtmlTag = false;
				inHtmlElement = true;
			}
		}
	}

	commit();

	return words;
}

string stripVerifier(string s) {
	auto idx = s.indexOf("?");
	if(idx != -1) {
		auto qs = s[idx + 1 .. $];
		s = s[0 .. idx];
		auto vars = decodeVariables(qs);
		if("verifier" in vars)
			vars.remove("verifier");
		if(vars.length)
			s ~= "?" ~ encodeVariables(vars);
	}
	return s;
}

string[] normalizeHtml(Element element) {
	if(element is null)
		return null;

	foreach(g; element.querySelectorAll("b"))
		g.tagName = "strong"; // we will consistently use <strong> instead of <b>
	foreach(g; element.querySelectorAll("i"))
		g.tagName = "em"; // we will consistently use <em> instead of <i> (yes i know this "breaks" bootstrap icons but bootstrap is trash, don't use that garbage in here
	foreach(g; element.querySelectorAll("g")) // canvas grammar checks
		g.stripOut();
	// canvas urls from the api export
	foreach(g; element.querySelectorAll(`[href^="https://portal.bebraven.org"]`)) {
		g.href = stripVerifier(g.href["https://portal.bebraven.org".length .. $]);
	}
	foreach(g; element.querySelectorAll(`[src^="https://portal.bebraven.org"]`)) {
		g.src = stripVerifier(g.src["https://portal.bebraven.org".length .. $]);
	}
	foreach(g; element.querySelectorAll(`[data-api-endpoint^="https://portal.bebraven.org"]`))
		g.dataset.apiEndpoint = g.dataset.apiEndpoint["https://portal.bebraven.org".length .. $];

	// consistently format indentation with two spaces
	return element.toPrettyString(false, 0, "  ").splitLines;
}

Element applyBinaryDiff(Element basedOn, const(ubyte)[] binaryDiff) {
	auto source = normalizeHtml(basedOn);
	int sourcePos = 0;
	string[] lines;
	while(binaryDiff.length) {
		auto b = binaryDiff[0];
		binaryDiff = binaryDiff[1 .. $];
		auto opBin = (b & 0b11_000000) >> 6;
		auto repeat = b & 0b00_111111;

		switch(opBin) {
			case 0: // EditOp.none; copy from the source
				lines ~= source[sourcePos .. sourcePos + repeat];
				sourcePos += repeat;
			break;
			case 1: // EditOp.substitute; skip line from the source, replace with string from data
			case 2: // EditOp.insert; insert the string from data
				assert(repeat == 1);
				uint dataLength;
				dataLength |= binaryDiff[0];
				dataLength |= binaryDiff[1] << 8;
				dataLength |= binaryDiff[2] << 16;
				dataLength |= binaryDiff[3] << 24 ;
				binaryDiff = binaryDiff[4 .. $];

				string data = cast(string) binaryDiff[0 .. dataLength];
				lines ~= data;

				binaryDiff = binaryDiff[dataLength .. $];

				if(opBin == 1) // substitute means skip the source line
					sourcePos += repeat;
			break;
			case 3: // EditOp.remove; skip lines from source
				sourcePos += repeat;
			break;
			default: assert(0);
		}
	}

	return Element.make("div", Html(lines.join("\n"))).requireSelector(".bz-module");
}

string sanitizeId(string id) {
	string sanitized;
	foreach(ch; id) {
		if(ch == '-' || ch == '_' || 
			(ch >= 'a' && ch <= 'z') ||
			(ch >= 'A' && ch <= 'Z') ||
			(ch >= '0' && ch <= '9'))
			sanitized ~= ch;
	}
	return sanitized;
}


	/*
		#editor {
		  zoom: 50%;	
		  -moz-transform: scale(0.5);
		  -moz-transform-origin: 0 0;
		}
	*/



mixin FancyMain!EditorApi;
