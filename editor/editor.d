import arsd.web;

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

	/* ********************************* */
	/* These functions are just a bit of plumbing for the framework. */
	/* ********************************* */

	version(none)
	protected override Element _getGenericContainer() {
		return null;
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
		if(document.getElementById("webd-functions-js") is null)
			document.mainBody.addChild("script").src = cgi.getCurrentCompleteUri ~ "functions.js?" ~ compiliationStamp;
		import std.file;
		document.requireElementById("embedded-css").innerRawSource = readText("editor.css");
		document.requireElementById("embedded-js").innerRawSource = readText("editor.js");
	}
}

string extensionToMime(string path) {
	if(path.length < 4)
		throw new Exception("bad");
	if(path[$-4 .. $] == ".png")
		return "image/png";
	if(path[$-4 .. $] == ".jpg")
		return "image/jpeg";
	assert(0);
}

mixin FancyMain!EditorApi;
