// i might cache the results later to avoid walking the whole directory to find
// Distribute changes button merges from one inro multi branches
// leafs, etc, but for now i want it to work this way so distributed editing is proven
// FIXME: all the files this creates should be made write-protected
/*
	I will have to support image uploading and scaling.
*/
/*
	When you hit compare, it calls that the "anchor". then you click
	around on the other links and it shows the diff between them. A
	"stop comparing" button turns the anchor thing back off.

	The diff will always put the older one as v1 and the newer one as v2
	unless specifically told not to. (which might not be in the ui)
*/
/*
	CSS edit: since we do not allow the dynamic insertion of HTML,
	we can statically analyze css rules and have a pretty good sense
	of everywhere they are actually used. Only user-interaction things
	apply and those can be limited to class names we list out or have
	a naming convention for.
*/
/*
	To sync two user's changes: just combine the files from their data
	directories, and show the files UI.
*/
/*
	On the preview, you have test users with a set of magic fields
	you can edit and reset from point X onward.

	You can also view a module with magic fields from a REAL user and
	see their stuff (a button will advance to the next one so you can
	see in context) and grade things as you go. See participation %
	and uncompleted things.

	You can also do aggregate magic field analysis from the editor.


	When you pull from production, it makes a diff.

	Merge branches interactively to confirm the merge and fixup and
	conflicts.

	move features to modules; independent css and js things with editor
	support.

	File type magic field; inline uploads. Submit type magic field to trigger
	grading and/or student collab. Eventually, we might expand so students
	can see other student's responses. (But this is for later; currently this
	is an editor/viewer only for staff.)

	Magic field history - keep a lot of all changes users make in addition to
	the current value. Can be used to rewind submission in a sense.

	Magic field snapshot - a button that copies them all (can emulate canvas
	submission).

	Magic field auto grading and manually graded thing - manually graded can stand
	out for TAs.

	When saving, you can tag it. e.g. "2017 Fall" and then branch off it later
	for new feature for next semester.

	When viewing, you can view from different contexts like different locations
	with the data-replace-with stuff.

	Dynamic syllabus editor?!!?

	Magic field viewer needs a UI to pull the magic field ID by clicking on it
	in another module.


	BTW i eventually want to write a CAS client. Make the editor work with SSO.
		this is trivial. if the session requires login, redirect to
		CAS url ?service=my_url

		the CAS server sends it back to us with a ticket param
		we ask the CAS server for serviceValidate?service=us&ticket=that
		it gives back some xml with some info

		then we done, do our own cookie thing.
*/


import arsd.web;
import arsd.jsvar;
import arsd.http2;

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
	Session session;
	override void _initializePerCall() {
		cgi.requireBasicAuth("temporary", "test1234");
		/*
		session = new Session(cgi);
		if(!session.hasKey("user")) {
			import std.uri;
			redirect("https://stagingsso.bebraven.org/?service=" ~ encodeComponent("http://editor.bebraven.org.arsdnet.net/"));
			throw new Exception("not logged in");
		}
		*/
	}

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
	string save(string basedOn, Html html, string tag = "", ushort flags = 0) {
		// it saves it as a diff from the base...
		string[] r1 = normalizeHtml(load(basedOn).render(this));
		string[] r2 = normalizeHtml(Element.make("div", html).requireSelector(".bz-module"));

		auto path = levenshteinDistanceAndPath(r1, r2);

		ubyte[] data;

		string mergeId;
		string comment;

		auto id = randomUUID();
		string editedBy = "admas";
		import core.stdc.time;
		uint timestamp = cast(int) time(null);

		data ~= cast(ubyte[]) "BZME"; // magic number

		ushort headerLength = 0;
		headerLength +=
			4 /* magic number */ +
			6 /* length, version, flags */ +
			4 /* timestamp */ +
			basedOn.length + editedBy.length + tag.length + mergeId.length + comment.length + 5 /* zero terminators */;

		data ~= (headerLength >>  0) & 0xff;
		data ~= (headerLength >>  8) & 0xff;

		ushort fileFormatVersion = 0;
		data ~= (fileFormatVersion >>  0) & 0xff;
		data ~= (fileFormatVersion >>  8) & 0xff;
		data ~= (flags >>  0) & 0xff;
		data ~= (flags >>  8) & 0xff;

		data ~= cast(ubyte[]) tag;
		data ~= 0;

		data ~= cast(ubyte[]) basedOn;
		data ~= 0;

		data ~= (timestamp >>  0) & 0xff;
		data ~= (timestamp >>  8) & 0xff;
		data ~= (timestamp >> 16) & 0xff;
		data ~= (timestamp >> 24) & 0xff;

		data ~= cast(ubyte[]) editedBy;
		data ~= 0;

		data ~= cast(ubyte[]) mergeId;
		data ~= 0;
		data ~= cast(ubyte[]) comment;
		data ~= 0;

		ubyte[] header = data[];
		data = null;

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

		// don't compress the header so it is easier to examine the file
		// and it wouldn't be squashed that much anyway
		std.file.write("data/" ~ id.toString() ~ ".dat", header ~ compress(data));

		return id.toString();
	}

	int doMagicFieldUpdate() {
		auto db = openProductionMagicFieldDatabase();

		import std.file, arsd.jsvar;
		var json = var.fromJson(readText("data/magic_field_dump.json"));
		int count;
		foreach(field; json) {
			try
			db.query("INSERT INTO magic_fields VALUES (?, ?, ?, ?, ?, ?)",
				field.name.get!string, field.value.get!string, field.path.get!string, field.user_id.get!string, field.created_at.get!string, field.updated_at.get!string);
			catch(Exception e)
			db.query("UPDATE magic_fields SET name = ?, value = ?, path = ?, user_id = ?, created_at = ?, updated_at = ? WHERE name = ? AND user_id = ?",
				field.name.get!string, field.value.get!string, field.path.get!string, field.user_id.get!string, field.created_at.get!string, field.updated_at.get!string, field.name.get!string, field.user_id.get!string);
				count++;
		}
		return count;

	}

	Element magicFieldCollisions(string moduleId) {
		import std.file;
		Element div = Element.make("div");
		Element[string] names;
		foreach(name; dirEntries("data/", "*.html", SpanMode.shallow)) {
			auto document = new Document(readText(name));
			foreach(i; document.querySelectorAll("[data-bz-retained]")) {
				if(name == "data/" ~ moduleId ~ ".html") {
					if(i.dataset.bzRetained in names) {
						auto d = div.addChild("div");
						d.addChild("strong", i.dataset.bzRetained);
						d.addChild("div", i.toString());
						d.addChild("div","potentially conflicts with");
						d.addChild("div", names[i.dataset.bzRetained]);
						div.addChild("br");
						div.addChild("br");
					}
					names[i.dataset.bzRetained] = i;

				} else
					names[i.dataset.bzRetained] = i;
			}
		}
		return div;
	}

	Element magicFieldAnalysis(string moduleId, int student_id = 0) {
		auto db = openProductionMagicFieldDatabase();


		auto div = Element.make("div");

		auto mod = load(moduleId);
		auto html = mod.render(this);
		foreach(magicField; html.querySelectorAll("[data-bz-retained]")) {
			auto d = div.addChild("div").addClass("magic-field-report");
			auto mfn = magicField.dataset.bzRetained;
			d.addChild("span", mfn);
			if(magicField.hasClass("bz-optional-magic-field"))
				d.addChild("span", " [optional]");
			d.appendText(" ");
			d.addChild("span", magicField.tagName == "textarea" ? "textarea" : magicField.attrs.type);
			d.addChild("p", magicField.parentNode.innerText).addClass("magic-field-context");

			bool empty = true;
			foreach(row; db.query("SELECT value, created_at, updated_at FROM magic_fields WHERE user_id = ? AND name = ?", student_id, mfn)) {
				empty = false;
				d.addChild("div", row[0]);
				d.addChild("span", row[1]);
				if(row[1] != row[2]) {
					d.appendText(" ");
					auto span = d.addChild("span", row[2]);
					span.style.backgroundColor = "yellow";
				}
			}

			if(empty)
				d.addClass("empty-magic-field-submission");

			if(empty && !magicField.hasClass("bz-optional-magic-field") && magicField.attrs.type != "checkbox")
				d.addClass("empty-required-magic-field-submission");
		}

		return div;
	}

	/++
		Loads the bz-module revision with the given ID
	+/
	RevisionData load(string id) {
		id = sanitizeId(id);
		if(std.file.exists("data/" ~ id ~ ".dat")) {
			auto data = loadRevision(id);
			data.render(this); // populates the html field
			return data;
		} else if(std.file.exists("data/" ~ id ~ ".html")) {
			RevisionData b;
			b.isHtml = true;
			b.id = id;
			b.render(this);
			return b;
		} else {
			return RevisionData.init;
		}
	}

	RevisionData loadRevision(string id) {
		RevisionData data;

		if(id is null)
			return data;

		if(std.file.exists("data/" ~ id ~ ".dat")) {
			auto rawData = cast(ubyte[]) std.file.read("data/" ~ id ~ ".dat");

			int pos = 0;

			// magic number: BZME == "BZ Module Editor"
			if(!(rawData[pos++] == 'B' &&
				rawData[pos++] == 'Z' &&
				rawData[pos++] == 'M' &&
				rawData[pos++] == 'E'))
			{
				throw new Exception("Wrong file format");
			}

			ushort headerLength;
			headerLength |= rawData[pos++];
			headerLength |= rawData[pos++];

			ushort fileFormatVersion;
			fileFormatVersion |= rawData[pos++];
			fileFormatVersion |= rawData[pos++];
			ushort flags;
			flags |= rawData[pos++];
			flags |= rawData[pos++];
			string tag;
			auto tagStart = pos;
			while(rawData[pos])
				pos++;
			tag = cast(string) rawData[tagStart .. pos];
			pos++; // skip 0 terminator

			string basedOn;
			auto basedOnStart = pos;
			while(rawData[pos])
				pos++;
			basedOn = cast(string) rawData[basedOnStart .. pos];
			pos++; // skip 0 terminator
			uint timestamp;
			timestamp |= rawData[pos++];
			timestamp |= rawData[pos++] << 8;
			timestamp |= rawData[pos++] << 16;
			timestamp |= rawData[pos++] << 24;
			string editedBy;
			auto start = pos;
			while(rawData[pos])
				pos++;
			editedBy = cast(string) rawData[start .. pos];
			pos++; // skip 0 terminator

			string mergeId;
			start = pos;
			while(rawData[pos])
				pos++;
			mergeId = cast(string) rawData[start .. pos];
			pos++; // skip 0 terminator

			string comment;
			start = pos;
			while(rawData[pos])
				pos++;
			comment = cast(string) rawData[start .. pos];
			pos++; // skip 0 terminator



			if(pos != headerLength) {
				throw new Exception("corrupted file");
			}

			ubyte[] diffData = cast(ubyte[]) uncompress(rawData[pos .. $]);

			data.id = id;
			data.fileFormatVersion = fileFormatVersion;
			data.flags = flags;
			data.tag = tag;
			data.basedOn = basedOn;
			data.timestamp = timestamp;
			data.editedBy = editedBy;
			data.mergeId = mergeId;
			data.comment = comment;
			data.diffData = diffData;
		} else if(std.file.exists("data/" ~ id ~ ".html")) {
			data.id = id;
			data.isHtml = true;
		}

		return data;
	}

	static struct RevisionData {
		string id; // stored as file name
		// actually in file
		ushort fileFormatVersion;
		ushort flags;
		string tag;
		string basedOn;
		uint timestamp;
		string editedBy;
		string mergeId;
		string comment;
		ubyte[] diffData;

		bool isHtml;

		Element rendered;
		Element render(EditorApi _this) {
			if(rendered is null) {
				if(id is null) {
					return new TextNode(null, null);
				}
				if(isHtml) {
					auto html = std.file.readText("data/" ~ id ~ ".html");
					auto normalized = normalizeHtml(Element.make("div", Html(html)).requireSelector(".bz-module"));
					rendered = (new Document(normalized.join("\n"))).requireSelector(".bz-module");
				} else {
					auto basedOnElement = _this.load(basedOn).render(_this);
					rendered = applyBinaryDiff(basedOnElement, diffData);
				}
			}
			return rendered;
		}

		enum Flags : ushort {
			autoSave = 	1 << 0,
			merge = 	1 << 1, // the data of the file starts with the other merge id. or something
		}

		RevisionData[] allParents(EditorApi api) {
			if(this.id is null) return null;

			RevisionData[] all;
			all ~= this;
			int pos = 0;
			while(pos < all.length) {
				if(all[pos].basedOn.length) {
					bool alreadyThere = false;
					foreach(i; all)
						if(i.id == all[pos].basedOn) {
							alreadyThere = true;
							break;
						}
					if(!alreadyThere)
						all ~= api.loadRevision(all[pos].basedOn);
				}
				if(all[pos].mergeId.length) {
					bool alreadyThere = false;
					foreach(i; all)
						if(i.id == all[pos].mergeId) {
							alreadyThere = true;
							break;
						}
					if(!alreadyThere)
						all ~= api.loadRevision(all[pos].mergeId);
				}
				pos++;

			}

			return all;
		}
	}

	Element merge(string intoId, string whatId) {
		// find the common ancestor.
		auto into = loadRevision(intoId);
		auto what = loadRevision(whatId);

		auto intoParents = into.allParents(this);
		auto whatParents = what.allParents(this);

		RevisionData commonAncestor;
		{
			RevisionData[] a, b;
			if(intoParents.length > whatParents.length) {
				a = intoParents;
				b = whatParents;
			} else {
				a = whatParents;
				b = intoParents;
			}

			outer: foreach(p; a)
				foreach(p2; b)
					if(p.id == p2.id) {
						commonAncestor = p;
						break outer;
					}
		}

		if(commonAncestor.id is null)
			throw new Exception("recursive 3-way merge not implemented");

		if(commonAncestor.id == into.id) {
			// fast-forward; whatId is the correct merge already
			return Element.make("div", "fast-forward");
		} else if(commonAncestor.id == what.id) {
			// intoId is already up-to-date
			return Element.make("div", "up-to-date");
		} else {
			// need to actually 3-way merge
			auto suggestion = threeWayMerge(
				normalizeHtml(commonAncestor.render(this)),
				normalizeHtml(into.render(this)),
				normalizeHtml(what.render(this)));
			auto div = Element.make("div").addClass("three-way-merge");
			foreach(line; suggestion) {
				auto l = div.addChild("div").addClass(line.potentialProblem ? "problem" : "ok");
				if(line.suggestion != line.o)
					l.addClass("changed");
				l.addChild("div", line.o).addClass("old");
				l.addChild("div", line.a).addClass("into");
				l.addChild("div", line.b).addClass("what");
				l.addChild("div", line.suggestion).addClass("suggestion");
			}
			return div;
		}

		assert(0);
	}

	Element diff(string v1, string v2) {
		auto div = Element.make("div");

		auto r1 = normalizeHtml(load(v1).render(this)); // normalizeHtml(_getGenericContainer().requireSelector(".bz-module"));
		auto r2 = normalizeHtml(load(v2).render(this)); // (new Document(std.file.readText("../tools/1.html"))).requireSelector(".bz-module"));

		// by stripping them all, it only shows changes that are more than just
		// whitespace. In some cases, the whitespace might matter (e.g. a <pre> block)
		// but.... meh not that important for our case to show here. I'd rather have legible
		// diffs when just a wrapper div is added.
		auto path = levenshteinDistanceAndPath(r1.map!strip, r2.map!strip);

		//std.file.write("a.html", r1.join("\n"));
		//std.file.write("b.html", r2.join("\n"));


		// now we want to squeeze the no-change ones so it just shows some before and after the actual changes
		int forceNoChangeShowCount = 0;
		Element[] lastNoChanges;

		void registerChanges(bool ending = false) {

			int contextToShow = 10;

			int showCount = ending ? 0 : contextToShow;
			auto show = lastNoChanges.length > showCount ? showCount : cast(int) lastNoChanges.length;
			auto hidden = cast(int) lastNoChanges.length - show;
			// it is silly to show a line that says "one line hidden"
			if(hidden == 1) {
				show++;
				hidden--;
			}
			if(hidden)
				div.addChild("div", " --- " ~ to!string(hidden) ~ " unchanged line"~(hidden > 1 ? "s" : "")~" hidden --- ", "hidden-no-changes");
			foreach(nc; lastNoChanges[$ - show .. $])
				div.addChild(nc);
			forceNoChangeShowCount = contextToShow;
			lastNoChanges = lastNoChanges[0 .. 0];
			lastNoChanges.assumeSafeAppend();
		}

		int pos;
		int pos2;
		foreach(editOp; path[1]) {
			final switch(editOp) {
				case EditOp.none:
					auto nc = Element.make("div", r1[pos], "no-change");
					if(forceNoChangeShowCount) {
						div.addChild(nc);
						forceNoChangeShowCount--;
					} else {
						lastNoChanges ~= nc;
					}
					pos++;
					pos2++;
				break;
				case EditOp.insert:
					registerChanges();
					div.addChild("div", r2[pos2], "inserted");
					pos2++;
				break;
				case EditOp.substitute:
					registerChanges();
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
					registerChanges();
					div.addChild("div", r1[pos], "removed");
					pos++;
				break;
			}
		}

		registerChanges(true);

		return div;
	}

	/*
		Main files view:
			Root
				Leaf
				Leaf
		It shows all the files and the latest revisions of each active branch.

		Revisions view:
			Leaf
				linked list back to root
		It shows all the changes that led to where it is now

		Diff view:
			Compare base   Compare revision        Diff
			Changes from... to

		When you click a thing in the revisions view, it defaults to from its base to it.
		When you click a branch it will show the diff from the latest revision... or common parent of latest revision?
	*/

	static struct FilesResult {
		RevisionData[string] allRevisions;
		string[] roots;
		string[string] leafs;
		string[string] titles;

		Element makeHtmlElement(Document document = null) {
			auto div = Element.make("div");
			auto dl = div.addChild("dl");
			foreach(root; roots) {
				auto dt = dl.addChild("dt", titles[root]);
				foreach(id, leafRoot; leafs)
					if(root == leafRoot) {
						auto data = allRevisions[id];
						auto a = Element.make("a", data.tag ~ " latest change by " ~ data.editedBy ~ " at " ~ to!string(data.timestamp), "edit?id=" ~ id);
						auto dd = dl.addChild("dd", a);
						dd.appendText(" ");
						dd.addChild("button", "History").setAttribute("type", "button").setAttribute("onclick", q{
					this.parentNode.classList.toggle("show-history");	
						});
							/* checkbox to include/exclude auto-saves in between explicit saves */
						dd.dataset.id = data.id;
						dd.appendText(" ");
						dd.addChild("button", "Merge").setAttribute("type", "button").setAttribute("onclick", q{
							setMerge(this.parentNode.dataset.id);
						});
							/*
						Merge can be all checkboxes. You check the ones you want to merge
						together, and it asks you which one ought to be the base (assuming
						latest one with a set tag name by default). You can set a new name
						if you like.

						A box will be presented to merge while keeping the old branch(s) active,
						or to close the old one after merging. Use case: regional teams merge
						in changes from the design team.

						Then it just starts with the base and 2-way merges all the rest into
						it, one at a time, asking for confirmation on the changesets showing it
						as: original, version 1, version 2, auto-merged.

						Once you're done, it loads it up in the editor or previewer and you can
						save after a final sanity check.

						An n-way merge will produce n-1 new diff files
							*/
						dd.appendText(" ");
						dd.addChild("button", "Compare").setAttribute("type", "button").setAttribute("onclick", q{
							setCompare(this.parentNode.dataset.id);
						});

						auto history = dd.addChild("ol");
						history.addClass("history-view");
						history.attrs.reversed = "reversed";
						auto parent = allRevisions[data.basedOn];
						while(parent != RevisionData.init) {
							auto li = history.addChild("li", Element.make("a", parent.editedBy ~ " " ~ to!string(parent.timestamp), "/diff?v1=" ~ parent.basedOn ~ "&v2=" ~ parent.id));

							if(parent.basedOn !in allRevisions)
								break;
							parent = allRevisions[parent.basedOn];
						}
					}
				
			}
			return div;
		}
	}

	FilesResult files() {
		import std.file;

		RevisionData[] results;
		string[] roots;
		string[string] leafs;
		string[string] titles;

		RevisionData[string] helper;

		foreach(string name; dirEntries("data/", "*.html", SpanMode.shallow)) {
			auto document = new Document(readText(name));
			auto id = name["data/".length .. $-".html".length];

			RevisionData data;
			data.id = id;
			results ~= data;
			roots ~= id;
			titles[id] = document.title;
			helper[data.id] = data;
		}

		foreach(string name; dirEntries("data/", "*.dat", SpanMode.shallow)) {
			auto data = loadRevision(name["data/".length .. $-".dat".length]);
			data.diffData = null;
			results ~= data;
			if(data.basedOn.length == 0)
				roots ~= data.id;
			leafs[data.id] = ""; // will be made into the root later

			helper[data.id] = data;
		}

		foreach(result; results)
			leafs.remove(result.basedOn);

		foreach(k, v; leafs) {
			string parent = helper[k].basedOn;
			string root;
			while(parent.length) {
				root = parent;
				parent = helper[parent].basedOn;
			}

			leafs[k] = root;
		}

		return FilesResult(helper, roots, leafs, titles);
	}

	Document edit(string id) {
		import std.file;
		auto document = new Document(readText("editor.html"), true, true);
		_postProcess(document);
		document.mainBody.addChild("script", "load(" ~ var(id).toJson() ~ ");");
		return document;
	}

	/* ********************************* */
	/* These functions are just a bit of plumbing for the framework. */
	/* ********************************* */

	public override Element _getGenericContainer() {
		import std.file;
		auto document = new Document(readText("skeleton.html"), true, true);
		return document.requireElementById("generic-container");
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

			document.mainBody.addChild("script")
				.setAttribute("id", "webd-functions-js")
				.src = loc ~ "functions.js?" ~ compiliationStamp;
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

		if(ch == '<') {
			commit();
			inHtmlTag = true;
		}

		// ending punctuation
		if(ch == ')' || ch == ' ' || ch == '.' || ch == '!' || ch == '?' || ch == ',') {
			commit();
		}

		curr ~= ch;

		if(ch == '(') {
			commit();
		}

		if(ch == '>') {
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

struct MergeResult(T) {
	T suggestion;
	T o;
	T a;
	T b;
	bool potentialProblem;
}

import std.range;
MergeResult!(ElementType!R)[] threeWayMerge(R)(R o, R a, R b) {
	alias ResultType = MergeResult!(ElementType!R);
	ResultType[] f;

	auto o_a = levenshteinDistanceAndPath(o, a)[1];
	auto o_b = levenshteinDistanceAndPath(o, b)[1];
	auto a_b = levenshteinDistanceAndPath(a, b)[1];

	//writeln(o_a);
	//writeln(a_b);

	int a_pos = 0;
	int b_pos = 0;

	int o_pos_by_a = 0;
	int o_pos_by_b = 0;
	int a_pos_by_o = 0;
	int b_pos_by_o = 0;

	string o_at_a(int desired_a_pos) {
		if(a_pos_by_o > desired_a_pos)
			assert(0);
		while(o_a.length) {
			if(a_pos_by_o == desired_a_pos)
				return o[o_pos_by_a];

			auto op = o_a[0];
			o_a = o_a[1 .. $];
			final switch(op) {
				case EditOp.none:
					o_pos_by_a++;
					a_pos_by_o++;
				break;
				case EditOp.insert:
					a_pos_by_o++;
				break;
				case EditOp.substitute:
					o_pos_by_a++;
					a_pos_by_o++;
				break;
				case EditOp.remove:
					o_pos_by_a++;
				break;
			}
		}
		assert(0);
	}

	string o_at_b(int desired_b_pos) {
		if(b_pos_by_o > desired_b_pos)
			assert(0);
		while(o_b.length) {
			if(b_pos_by_o == desired_b_pos)
				return o[o_pos_by_b];
			auto op = o_b[0];
			o_b = o_b[1 .. $];
			final switch(op) {
				case EditOp.none:
					o_pos_by_b++;
					b_pos_by_o++;
				break;
				case EditOp.insert:
					b_pos_by_o++;
				break;
				case EditOp.substitute:
					o_pos_by_b++;
					b_pos_by_o++;
				break;
				case EditOp.remove:
					o_pos_by_b++;
				break;
			}
		}
		assert(0);
	}

	foreach(op; a_b) {
		final switch(op) {
			case EditOp.none:
				f ~= ResultType(a[a_pos], a[a_pos], a[a_pos], a[a_pos], false);
				a_pos++;
				b_pos++;
			break;
			case EditOp.insert:
				auto old = o_at_b(b_pos);
				if(old == b[b_pos]) {
					// if it was in the old, but not ours, it was deliberately
					// deleted by the one branch. We should leave it out.
				} else {
					// otherwise, it was added legitimately and we should keep it
					// (though flag it for review and confirmation by the user)
					f ~= ResultType(b[b_pos], old, null, b[b_pos], true);
				}
				b_pos++;
			break;
			case EditOp.substitute:
				auto old_by_a = o_at_a(a_pos);
				auto old_by_b = o_at_b(b_pos);

				auto new_by_a = a[a_pos];
				auto new_by_b = b[b_pos];

				if(new_by_a == old_by_a) {
					f ~= ResultType(new_by_b, old_by_a, new_by_a, new_by_b, false);
				} else if(new_by_b == old_by_b) {
					f ~= ResultType(new_by_a, old_by_a, new_by_a, new_by_b, false);
				} else {
					// traditional merge conflict
					f ~= ResultType(null, old_by_a, new_by_a, new_by_b, true);
				}

				a_pos++;
				b_pos++;
			break;
			case EditOp.remove:
				auto old = o_at_a(a_pos);
				if(old == a[a_pos]) {
					// it was in the old, removed from the second branch
					// also keep it removed
				} else {
					// this must have been added by the other branch, let's keep it
					f ~= ResultType(a[a_pos], old, a[a_pos], null, false);
				}
				a_pos++;
			break;
		}
	}

	return f;
}

	/*
		#editor {
		  zoom: 50%;	
		  -moz-transform: scale(0.5);
		  -moz-transform-origin: 0 0;
		}
	*/


import arsd.sqlite;
Sqlite openProductionMagicFieldDatabase() {
	return openDBAndCreateIfNotPresent("data/prod-magic-fields.db", `
		CREATE TABLE magic_fields (
			name TEXT NOT NULL,
			value TEXT,
			path TEXT,
			user_id INTEGER NOT NULL,
			created_at TEXT NOT NULL,
			updated_at TEXT NOT NULL,
			PRIMARY KEY (user_id, name)
		);

		CREATE INDEX magic_fields_by_user ON magic_fields(user_id);
		CREATE INDEX magic_fields_by_name ON magic_fields(name);
	`, delegate (Sqlite db) {
		// db created, now time to populate with initial data
		import std.file, arsd.jsvar;
		var json = var.fromJson(readText("data/magic_field_dump.json"));
		int count;
		foreach(field; json) {
			count++;
			if(count % 100 == 0)
				writeln("created ", count);
			try
			db.query("INSERT INTO magic_fields VALUES (?, ?, ?, ?, ?, ?)",
				field.name.get!string, field.value.get!string, field.path.get!string, field.user_id.get!string, field.created_at.get!string, field.updated_at.get!string);
			catch(Exception e) writeln(e.msg);
		}
	});
}

mixin FancyMain!EditorApi;
