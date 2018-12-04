/++
	The Braven Content Editor and associated code.
+/
module braven.editor;

version=hosted;

// FIXME: insert followed by substitute might be a modified line followed by an insertion
// that Phobos read the other way. Might be better to use LCS instead of Levenshtein , but
// for now I want to detect that particular pattern and better portray it to the users.

// FIXME: bz-retained-field-setup must be STRICTLY banned from all source

/*

	Files:

		I might need to put the title on the module attribute

		and pulling from production should be updated more often

		branches.sqlite (it does it for atomicness):
			{
				// there is also a 1.html.la
				"1.html" : {
					"production" : "latest on prod"
					"ordinal" : 1 // the module number

					// the rest are user-defined
					"branch_name" : "latest_commit",
					"other_branch_name" : "its_latest_commit"
				}
			}
*/

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

/++
	Symbol_groups:
		editing =
			## Editing
		schema =
			## Magic Field Schema
		analytics =
			## Analytics
		revision_management =
			## Revision Management

			The editor supports complex revision management, similar to Git.
		utility =
			## Utilities
		session_management =
			## Session Management
		portal_syncing =
			## Portal Syncing
+/
class EditorApi : ApiProvider {
	private Session session;
	private string ssoService = "http://editor.bebraven.org.arsdnet.net/sso";

	/// All access to the hosted editor requires a valid SSO login.
	version(hosted)
	override void _initializePerCall() {
		session = new Session(cgi);
		if(!session.hasKey("user")) {
			// hack for magic field update cron...
			if(cgi.pathInfo != "/sso" && cgi.pathInfo != "/do-magic-field-update") {
				import std.uri;
				session.comingFrom = cgi.getCurrentCompleteUri();
				session.commit();
				redirect("https://sso.bebraven.org/login?service=" ~ encodeComponent(ssoService));
				throw new Exception("not logged in");
			}
		}
	}

	export:

	/// Log in via sso.bebraven.org
	/// Group: session_management
	string sso(string ticket) {
		import std.uri;
		auto client = new HttpClient();
		auto request = client.navigateTo(arsd.http2.Uri("https://sso.bebraven.org/serviceValidate?ticket="~encodeComponent(ticket)~"&service=" ~ encodeComponent(ssoService)));
		auto response = request.waitForCompletion();
		if(response.code == 200) {
			auto xml = new XmlDocument(response.contentText);
			auto user = xml.optionSelector(`cas\:authenticationSuccess > cas\:user`).innerText;
			if(user.length && (user == "admin@beyondz.org" || user.indexOf("@bebraven.org") != -1)) {
				session["user"] = user;
				session.commit();

				redirect(session.comingFrom);

				return user;
			} else
				throw new Exception(xml.toString);
		}

		return null;
	}

	/// Returns a list of module names that contain the given string in their html
	/// Group: utility
	string[] grep(string str) {
		string[] result;
		auto bdb = openBranchDatabase();
		foreach(file; bdb.query("SELECT name, latest_production_commit FROM files")) {
			auto info = load(file[1]);

			auto html = info.rendered;

			auto txt = html.toString();//innerText;
			if(txt.indexOf(str) != -1)
				result ~= file[0];
		}
		return result;
	}

	/// Just bounces some of the HTML from the client back out for preview purposes.
	/// Group: editing
	Document viewHtml(string html) {
		import std.file;
		auto document = new Document(readText("module.html"), true, true);
		document.requireSelector("#module-container").appendChild(new DocumentFragment(Html(html)));

		foreach(thing; document.querySelectorAll("[data-replace-with-page]")) {
			// FIXME
			thing.innerHTML = readText("data/" ~ thing.dataset.replaceWithPage ~ ".html");
		}

		return document;
	}

	/++
		Views the given commit or file ID

		Params:
			id = Commit ID or File ID
			showMagicFieldTimings = perform a magic field timing analysis for inline viewing

		Group: editing
	+/
	Document view(string id, bool showMagicFieldTimings = false) {

		if(id.length < 3) {
			auto bdb = openBranchDatabase();
			foreach(res; bdb.query("SELECT latest_commit FROM branches WHERE file_id = ? AND name = ?", id, "working"))
				id = res[0];
		}

		import std.file;
		auto document = new Document(readText("module.html"), true, true);
		document.requireSelector("#module-container").appendChild(load(id).render(this).removeFromTree);

		foreach(thing; document.querySelectorAll("[data-replace-with-page]")) {
			// FIXME
			auto bdb = openBranchDatabase();
			foreach(res; bdb.query("SELECT id FROM files WHERE name = ?", thing.dataset.replaceWithPage))
				thing.innerHTML = load(res[0]).render(this).toString;
		}

		if(showMagicFieldTimings) {
			auto db = openProductionMagicFieldDatabase();
			int[int] baseline;
			int averageSum = 0;
			foreach(mg; document.querySelectorAll("[data-bz-retained]")) {
				auto name = mg.dataset.bzRetained;
				int differencesSum = 0;
				int differencesCount = 0;
				foreach(row; db.query("SELECT user_id, strftime('%s', updated_at) FROM magic_fields WHERE name = ?", name)) {
					if(row[0] == "null")
						continue;
					auto uid = row[0].to!int;
					auto time = row[1].to!int;

					if(auto b = uid in baseline) {
						auto diff = time - *b;
						if(diff < 3600) {
						if(diff < 0)
							diff = 0;
						differencesSum += diff;
						differencesCount += 1;
						}
					}

					baseline[uid] = time;
				}

				if(differencesCount) {
					auto average = differencesSum / differencesCount;
					averageSum += average;
					mg.dataset.reachedIn = to!string(average);
					mg.dataset.reachedAt = to!string(averageSum);
				}
			}
		}

		return document;
	}

	@GenericContainerType("magic_field_schema") {
		/// Represents a magic field
		static struct MagicField {
			string key;///                     data-bz-retained
			string display_name;///            <not on html>
			int weight = 1;///                  data-bz-weight

			///
			enum DisplayType {
				text,///
				checkbox,///
				radio,///
				button,///
				textarea,///
				file,///
				range,///
				email,///
				select///
			}

			DisplayType type;///              type, tagName, etc

			string answer;///                  data-bz-answer (nullable)

			///
			enum PartialCreditMode {
				none,///
				per_char,///
			}

			PartialCreditMode partial_credit;///          data-bz-partial-credit
			bool optional;///                data-bz-optional

			float min;/// for range types
			float max;/// ditto
			float step;/// ditto

			// for radios
			string[] options;///

			URL[] uses; ///
		}

		/// Get the current magic field schema out of the live HTML
		/// Group: schema
		MagicField[] allMagicFieldsFromHtml() {
			MagicField[string] fields;
			auto bdb = openBranchDatabase();
			foreach(res; bdb.query("SELECT latest_production_commit, name, id FROM files")) {
				string name = res[1];
				auto e = load(res[0]).render(this);

				foreach(i; e.querySelectorAll("[data-bz-retained]")) {
					MagicField field;
					switch(i.tagName) {
						case "input":
							field.type = to!(MagicField.DisplayType)(i.attrs.type);
						break;
						case "textarea":
							field.type = MagicField.DisplayType.textarea;
						break;

						case "img":
						case "span":
						default:
							// view-only, skip
							continue;
					}

					if(i.dataset.bzWeight.length) field.weight = to!int(i.dataset.bzWeight);
					if(i.attrs.min.length) field.min = to!float(i.attrs.min);
					if(i.attrs.max.length) field.max = to!float(i.attrs.max);
					if(i.attrs.step.length) field.step = to!float(i.attrs.step);
					if(i.hasAttribute("data-bz-answer")) field.answer = i.dataset.bzAnswer;
					if(i.hasAttribute("data-bz-partial-credit")) field.partial_credit = to!(MagicField.PartialCreditMode)(i.dataset.bzPartialCredit);
					if(i.hasClass("bz-optional-magic-field")) field.optional = true;

					if(i.hasAttribute("value")) field.options ~= i.attrs.value;

					field.key = i.dataset.bzRetained;
					string usageHash = encodeComponent("editor [data-bz-retained=\""~field.key~"\"]");
					/*
					auto withId = i;
					while(withId !is null && !withId.hasAttribute("id"))
						withId = withId.previousInSource();
					if(withId !is null)
						usageHash = withId.attrs.id;
					*/
					field.uses ~= URL("/edit?fileId=" ~ res[2] ~ "&branch=working#" ~ usageHash, name);
					if(field.key in fields) {
						fields[field.key].options ~= i.attrs.value;
						fields[field.key].uses ~= field.uses;
					} else {
						fields[field.key] = field;
					}
				}
			}

			return fields.values;
		}
	}

	@GenericContainerType("analytics") {
		/// Get the fellow's interests for the given course. Suggest viewing with `format=table` on the url.
		/// Group: analytics
		string[6][string] fellowInterests(int courseId) {
			string[6][string] res;
			auto mf = openProductionMagicFieldDatabase();
			foreach(row; mf.query("
				SELECT
					users.user_id,
					users.name,
					users.email,
					magic_fields.name,
					magic_fields.value
				FROM
					magic_fields
				INNER JOIN
					users ON users.user_id = magic_fields.user_id
				INNER JOIN
					course_enrollments ON course_enrollments.user_id = users.user_id
				WHERE
					course_enrollments.course_id = ?
					AND
					magic_fields.name IN (?, ?, ?)
			", courseId, "dyc-industry-1", "dyc-industry-2", "dyc-industry-freeform-other"))
			{
				if(row[0] !in res)
					res[row[0]] = typeof(res[null]).init;
				auto ptr = &res[row[0]];
				(*ptr)[0] = row[0];
				(*ptr)[1] = row[1];
				(*ptr)[2] = row[2];
				if(row[3] == "dyc-industry-1")
					(*ptr)[3] = row[4];
				else if(row[3] == "dyc-industry-2")
					(*ptr)[4] = row[4];
				else
					(*ptr)[5] = row[4];
			}
			return res;
		}

		/// This is the structure of the data we get from the cohort teamwork things.
		struct CohortMagicFieldAnswer {
			/// The person writing the evaluation
			string evaluatorUserId;
			/// ditto
			string evaluatorName;
			/// ditto
			string evaluatorEmail;

			/// The person being evaluated
			string subjectUserId;
			/// ditto
			string subjectName;
			/// ditto
			string subjectEmail;

			/// the data source
			string magicFieldName;

			/// the data value
			string value;
		}

		/// Gets the data from the Cohort Teamwork Evaluation in the LYL module
		/// Group: analytics
		CohortMagicFieldAnswer[] cohortTeamworkEvaluation(int courseId) {
			return cohortMagicFieldAnswers(courseId, [
				"actively-contributed-to-team-success-peer-score-for-{ID}",
				"met-deadlines-peer-score-for-{ID}",
				"gave-feedback-peer-score-for-{ID}",
				"embraced-different-perspectives-peer-score-for-{ID}"
			]);
		}

		DataFile cohortTeamworkEvaluationDownload(int courseId) {
			import std.zip;

			auto answer = cohortTeamworkEvaluation(courseId);

			CohortMagicFieldAnswer[][string] bySubject;

			foreach(a; answer) {
				if(a.subjectUserId in bySubject)
					bySubject[a.subjectUserId] ~= a;
				else
					bySubject[a.subjectUserId] = [a];
			}

			auto zip = new ZipArchive();
			foreach(uid, arr; bySubject) {
				string csv;

				csv = "\"Fellow Name\",Area,Score";

				int[string] areaSums;
				int[string] areaCounts;

				foreach(item; arr) {
					/*
					csv ~= "\n";
					csv ~= toCsv(item.evaluatorName);
					csv ~= ",";
					csv ~= toCsv(item.subjectName);
					csv ~= ",";
					*/
					string mfn;
					switch(item.magicFieldName[0 .. item.magicFieldName.lastIndexOf("-")]) {
						case "actively-contributed-to-team-success-peer-score-for":
							mfn = "Actively Contributed to Team Success";
						break;
						case "met-deadlines-peer-score-for":
							mfn = "Met Deadlines";
						break;
						break;
						case "gave-feedback-peer-score-for":
							mfn = "Gave Feedback";
						break;
						case "embraced-different-perspectives-peer-score-for":
							mfn = "Embraced Different Perspectives";
						break;
						default: assert(0);
					}
					/*
					csv ~= toCsv(mfn);
					csv ~= ",";
					csv ~= toCsv(item.value);
					*/

					if(mfn in areaSums) {
						areaSums[mfn] += to!int(item.value);
						areaCounts[mfn] ++;
					} else {
						areaSums[mfn] = to!int(item.value);
						areaCounts[mfn] = 1;
					}
				}

				foreach(area, sum; areaSums) {
					auto count = areaCounts[area];

					auto avg = format("%0.2f", cast(float) sum / count);
					
					csv ~= "\n" ~ toCsv(arr[0].subjectName) ~ "," ~ toCsv(area) ~ "," ~ avg;
				}

				auto am = new ArchiveMember();
				am.name = "data-course-"~to!string(courseId)~"/" ~ arr[0].subjectName ~ ".csv";
				am.expandedData = csv.representation.dup;
				zip.addMember(am);
			}

			cgi.header("Content-Disposition: attachment; filename=\"data-course-"~to!string(courseId)~".zip\"");
			return new DataFile("application/zip", zip.build().idup);

		}

		/// Baseline function to get magic field answers for a particular cohort thing
		///
		/// You can probably use [cohortTeamworkEvaluation] instead.
		/// Group: analytics
		CohortMagicFieldAnswer[] cohortMagicFieldAnswers(int courseId, string[] fields) {

			CohortMagicFieldAnswer[] answers;

			string fieldsSql;

			foreach(i, field; fields) {
				if(i) fieldsSql ~= " OR ";
				fieldsSql ~= "magic_fields.name LIKE '";
				fieldsSql ~= prepareMagicFieldNameForSql(field);
				fieldsSql ~= "'";
			}

			auto mf = openProductionMagicFieldDatabase();

			static struct UserCache {
				string name;
				string email;
			}
			UserCache[string] userCache;

			userCache["2134"] = UserCache("Test Student" , "N/A");
			userCache["2269"] = UserCache("Test Student" , "N/A");

			foreach(row; mf.query("
				SELECT
					users.user_id,
					users.name,
					users.email
				FROM
					users
				INNER JOIN
					course_enrollments ON course_enrollments.user_id = users.user_id
				WHERE
					course_enrollments.course_id = ?
			", courseId))
				userCache[row[0]] = UserCache(row[1], row[2]);


			// since I already have the in-memory data above, i might not need
			// to query the users again but meh.
			foreach(row; mf.query("
				SELECT
					users.user_id,
					users.name,
					users.email,
					magic_fields.name,
					magic_fields.value
				FROM
					magic_fields
				INNER JOIN
					users ON users.user_id = magic_fields.user_id
				INNER JOIN
					course_enrollments ON course_enrollments.user_id = users.user_id
				WHERE
					course_enrollments.course_id = ?
					AND
					(
					" ~ fieldsSql ~ "
					)
			", courseId))
			{
				CohortMagicFieldAnswer answer;

				answer.evaluatorUserId = row[0];
				answer.evaluatorName = row[1];
				answer.evaluatorEmail = row[2];

				// this isn't strictly right but it works the way I write the fields
				// so technical FIXME but meh
				answer.subjectUserId = row[3][row[3].lastIndexOf("-") + 1 .. $];

				if(auto found = answer.subjectUserId in userCache) {
					answer.subjectName = found.name;
					answer.subjectEmail = found.email;
				}

				answer.magicFieldName = row[3];
				answer.value = row[4];

				answers ~= answer;
			}

			return answers;
		}

		/// Displays Rate This Module responses
		/// Group: analytics
		Element rateThisModule() {
			Element div = Element.make("div");
			div.addChild("h1", "Rate This Module Responses");
			auto bdb = openBranchDatabase();
			auto mf = openProductionMagicFieldDatabase();
			foreach(res; bdb.query("SELECT latest_production_commit, name FROM files")) {
				string name = res[1];
				auto e = load(res[0]).render(this);

				string rangeField;
				string commentsField;
				foreach(i; e.querySelectorAll("div:has(#rate-this-module) [data-bz-retained]")) {
					if(i.attrs.type == "range")
						rangeField = i.dataset.bzRetained;
					else if(i.tagName == "textarea")
						commentsField = i.dataset.bzRetained;
				}

				div.addChild("h2", name);

				if(rangeField.length == 0 || commentsField.length == 0) {
					div.addChild("p", "No Rate This Module header on module");
					continue;
				}

				auto overview = div.addChild("div");

				auto details = div.addChild("details");
				auto table = cast(Table) details.addChild("table");
				table.addClass("data-display");
				table.caption = "Raw Data";
				table.appendHeaderRow("User ID", "Updated", "Response");

				int[11] hits;
				int totalCount;
				int totalSum;

				foreach(row; mf.query("SELECT user_id, value, updated_at, name FROM magic_fields WHERE name IN (?, ?) ORDER BY user_id, name = ? DESC", rangeField, commentsField, rangeField)) {
					table.appendRow(row[0], row[2], row[1]);
					if(row[3] == rangeField) {
						int val;
						try
							val = to!int(row[1]);
						catch(Exception)
							val = 0;

						if(val >= 0 && val < hits.length) {
							hits[val] ++;
							totalCount++;
							totalSum += val;
						}
					}
				}

				overview.addChild("p", format("%s responses, average score: %.2f", totalCount, cast(float) totalSum / totalCount));

				table = cast(Table) overview.addChild("table");
				table.addClass("data-display");
				table.caption = "Overview";
				table.appendHeaderRow("Score", "Number of Responses");
				foreach(i; 1 .. hits.length) {
					table.appendRow(i, hits[i]);
				}
			}
			return div;
		}

		/// Analytics homepage. Returns list of links of all analytics group functions.
		/// Group: analytics
		Element analytics() {
			auto div = Element.make("div");
			div.addClass("analytics-nav");
			foreach(fun; __traits(derivedMembers, typeof(this))) {
				static if(hasValueAnnotation!(__traits(getMember, this, fun), GenericContainerType))
				static if(__traits(getProtection, __traits(getMember, this, fun)) == "export")
					div.addChild("a", beautify(fun), fun);
			}
			return div;
		}

		/// Group: analytics
		Table assignmentStartTimes(int course, bool includeHour = false) {
			auto table = new Table(null);

			auto db = openProductionMagicFieldDatabase();
			auto canvas = getCanvasApiClient(productionCredentials());

			auto assignmentsRes = canvas.rest.
				courses[course].assignments
				._SELF()
				("per_page", 30)
				("include[]", "items")
				.GET;

			more_assignments:
			foreach(assignment; assignmentsRes.result) {
				// work with assignment

				auto data = Element.make("div", Html(assignment.description.get!string));
				if(data.querySelector("[data-bz-retained]") is null)
					continue;

				table.appendRow("Assignment " ~ assignment.name.get!string);// ~ " (due " ~ assignment.due_at.get!string ~ ")");

				timingHelper(db, includeHour, course, data, table);
			}
			if(auto next = "next" in assignmentsRes.response.linksHash) {
				assignmentsRes = canvas.request(next.url);
				goto more_assignments;
			}

			return table;
		}

		/// Group: analytics
		Table startTimes(bool includeHour = false, int courseFilter = 0) {
			auto table = new Table(null);

			auto db = openProductionMagicFieldDatabase();

			if(courseFilter) {
				foreach(row; db.query("SELECT name FROM courses WHERE course_id = ?", courseFilter))
					table.caption = row[0];
			}

			table.appendHeaderRow("Count", "Hour and Day (YYYY-MM-DD HH)");

			foreach(i; 1 .. 17+1) {
				auto data = view(to!string(i), false);

				table.appendRow("Module " ~ to!string(i));
				timingHelper(db, includeHour, courseFilter, data.root, table);
			}

			return table;
		}

		private void timingHelper(Database db, bool includeHour, int courseFilter, Element data, Table table) {
			table.addClass("timing-table-display");
			auto allFields = data.querySelectorAll("[data-bz-retained]:not([type=checkbox]):not(.bz-optional-magic-field)");
			string field;
			if(allFields.length > 2)
				field = allFields[2].dataset.bzRetained;
			else if(allFields.length > 1)
				field = allFields[1].dataset.bzRetained;
			else if(allFields.length == 1)
				field = allFields[0].dataset.bzRetained;
			else
				return;

			foreach(row; db.query("
				SELECT
					count(magic_fields.user_id) AS cnt,
					strftime('%Y-%m-%d"~(includeHour ? " %H:xx":"")~"', magic_fields.created_at) AS started
				FROM
					magic_fields
				INNER JOIN
					users ON users.user_id = magic_fields.user_id
				" ~ (courseFilter ? "
				INNER JOIN
					course_enrollments ON course_enrollments.user_id = users.user_id
				" : "") ~ "
				WHERE
					magic_fields.name = ?
					AND
					is_test_account = 0
				" ~ (courseFilter ? "
					AND
					course_id = ?
				" : " AND ? = 0" /* prevent bind column index out of range error */) ~ "
				GROUP BY
					started
				ORDER BY
					started ASC
				",
				field, courseFilter))
			{
				table.appendRow(row[0], row[1], Element.make("div", "", "bar").setAttribute("style", "width: " ~ row[0] ~ "px;"));
			}
		}


		/// Group: analytics
		Table timingAnalysis() {
			auto table = new Table(null);

			table.appendHeaderRow("Module", "1/4 Time", "1/2 Time", "3/4 Time", "End Time", "Longest Parts");

			string fmt(Element d, bool showIn = false) {
				int secs = to!int(showIn ? d.dataset.reachedIn : d.dataset.reachedAt);

				int hours = 0;
				int mins = (secs / 60);
				hours = (mins / 60);
				mins %= 60;
				secs %= 60;

				string str = "";
				if(hours)
					str ~= hours.to!string ~ ":";
				if(mins < 10)
					str ~= "0";
				str ~= mins.to!string ~ ":";
				if(secs < 10)
					str ~= "0";
				str ~= secs.to!string;
				return str;
			}

			foreach(i; 1 .. 17+1) {
				auto data = view(to!string(i), true);
				auto ats = data.querySelectorAll("[data-reached-at]");
				auto details = Element.make("details");
				foreach(at; ats) {
					if(to!int(at.dataset.reachedIn) > 60)
						details.addChild("p", at.dataset.bzRetained ~ " " ~ at.parentNode.innerText ~ " " ~ fmt(at, true));
				}
				if(ats.length)
				table.appendRow(Element.make("a", to!string(i), "/view?id=" ~ to!string(i) ~ "&showMagicFieldTimings=true"), fmt(ats[$ / 4]), fmt(ats[$/2]), fmt(ats[3*$ / 4]), fmt(ats[$-1]), details);
			}

			return table;
		}

		/// Group: analytics
		Element magicFieldCollisions(string moduleId) {
			import std.file;
			Element div = Element.make("div");
			Element[string][string] names;

			auto bdb = openBranchDatabase();
			foreach(res; bdb.query("SELECT latest_production_commit, name FROM files")) {
				string name = res[1];
				Element[string] mod;
				auto e = load(res[0]).render(this);
				foreach(i; e.querySelectorAll("[data-bz-retained]")) {
						mod[i.dataset.bzRetained] = i;
				}

				names[name[5 .. $-5]] = mod;
			}


			outer: foreach(name, element; names[moduleId]) {
				foreach(nameId, mod; names) {
					if(nameId == moduleId)
						continue;

					if(name in mod) {
						auto d = div.addChild("div");
						d.addChild("strong", name);
						d.addChild("div", element.toString());
						d.addChild("div","potentially conflicts with");
						d.addChild("div", "module " ~ nameId);
						div.addChild("br");
						div.addChild("br");
						continue outer;
					}
				}
			}


			return div;
		}

		Element magicFieldTimeStats(string moduleId, int student_id = 0) {
			assert(0);
		}

		/// Displays a magic field report
		/// Group: analytics
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

	}

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
			fileId  = the file you are working on
		Group: editing
	+/
	string save(int fileId, string basedOn, Html html, string branch = "working", string tag = "", ushort flags = 0) {

		html = annotateHtml(html);

		// it saves it as a diff from the base...
		auto base = load(basedOn);
		string[] r1 = normalizeHtml(base.render(this));
		string[] r2 = normalizeHtml(new DocumentFragment(html)); //.requireSelector(".bz-module"));

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
			4 /* file Id */ +
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

		data ~= (fileId >> 0) & 0xff;
		data ~= (fileId >> 8) & 0xff;
		data ~= (fileId >> 16) & 0xff;
		data ~= (fileId >> 24) & 0xff;

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
		std.file.write("data/revisions/" ~ id.toString() ~ ".dat", header ~ compress(data));

		auto db = openBranchDatabase();
		if(db.query("SELECT latest_commit FROM branches WHERE file_id = ? AND name = ?", fileId, branch).empty)
			db.query("
			INSERT INTO
				branches
				(file_id, name, latest_commit)
			VALUES
				(?, ?, ?)
			", fileId, branch, id.toString());
		else
			db.query("
			UPDATE
				branches
			SET
				latest_commit = ?
			WHERE
				file_id = ? AND name = ?
			", id.toString(), fileId, branch);

		return id.toString();
	}

	/**
		Performs scans of HTML structure and adds other necessary html annotations
		such as class names.

		Group: editing
	*/
	Html annotateHtml(Html content) {
		auto df = new DocumentFragment(content);

		// FIXME: if title includes Privacy Badger, fail validation - this could be a lot prettier
		if(auto e = df.querySelector("[title^=\"Privacy Badger\"]"))
			throw new Exception("Privacy Badger corrupted content present!");

		// sort-to-match isn't allowed to have headers in it; make sure the content is sane
		foreach(e; df.querySelectorAll("
			.sort-to-match h1,
			.sort-to-match h2,
			.sort-to-match h3,
			.sort-to-match h4,
			.sort-to-match h5,
			.sort-to-match h6
		")) {
			if(e.parentNode.hasAttribute("draggable"))
				e.parentNode.innerText = e.innerText;
		}

		// FIXME: for-eval, for-eval-sum, for-compare-scores
		foreach(e; df.querySelectorAll(".bz-box:has(.checklist) .bz-toggle-all-next:not(.for-checklist)"))
			e.addClass("for-checklist");
		foreach(e; df.querySelectorAll(".bz-box:has(.radio-list) .bz-toggle-all-next:not(.for-radio-list)"))
			e.addClass("for-radio-list");
		foreach(e; df.querySelectorAll(".bz-box:has([data-bz-range-answer]) .bz-toggle-all-next:not(.for-range)"))
			e.addClass("for-range");
		foreach(e; df.querySelectorAll(".bz-box:has(.sort-to-match) .bz-toggle-all-next:not(.for-match)"))
			e.addClass("for-match");

		// for masteries
		foreach(e; df.querySelectorAll(".radio-list:has([data-bz-answer]):not(.bz-check-answers)"))
			e.addClass("bz-check-answers");
		foreach(e; df.querySelectorAll(".checklist:has([data-bz-answer]):not(.bz-check-answers)"))
			e.addClass("bz-check-answers");

		foreach(e; df.querySelectorAll("h1, h2, h3, h4, h5, h6")) {
			if(!e.hasAttribute("id")) {
				auto p = urlify(e.innerText);
				int count;
				while(df.getElementById(p)) {
					if(count > 0 && count < 10)
						p = p[0 .. $-2];
					else if(count && count < 100)
						p = p[0 .. $-3];
					count++;
					p ~= "-" ~ to!string(count);
				}
				e.id = p;
			}
			if(!e.querySelector("a")) {
				auto a = Element.make("a");
				a.addClass("stealth-link");
				a.href = "#" ~ e.id;
				a.innerHTML = e.innerHTML;
				e.removeAllChildren();
				e.appendChild(a);
			}
		}

		return Html(df.innerHTML);
	}

	/// $(WARNING Use with caution.)
	/// Group: portal_syncing
	string pushToStaging(string fileId, string html) {
		// first, find the file we have as a page in the staging content library
		auto bdb = openBranchDatabase();

		string canvasUrl;
		foreach(line; bdb.query("SELECT canvas_page_name FROM files WHERE id = ?", fileId))
			canvasUrl = line[0];

		if(canvasUrl.length == 0)
			return null;

		if(canvasUrl.startsWith("https://portal.bebraven.org/api/v1/courses/1/pages/"))
			canvasUrl = canvasUrl["https://portal.bebraven.org/api/v1/courses/1/pages/".length .. $];

		// then update it
		auto canvas = getCanvasApiClient(stagingCredentials());

		var fix = var.emptyObject;
		fix["wiki_page"] = var.emptyObject;
		fix["wiki_page"]["body"] = html;

		auto result = canvas.rest.courses[1].pages[canvasUrl].PUT(fix).result;

		// then return the URL of the new page on Canvas

		return "https://stagingportal.bebraven.org/courses/1/pages/" ~ canvasUrl;
	}

	/// $(PITFALL Use with extreme caution)
	/// Group: portal_syncing
	void pushAllToProduction() {
		auto bdb = openBranchDatabase();
		foreach(line; bdb.query("SELECT id FROM files")) {
			foreach(res; bdb.query("SELECT latest_commit FROM branches WHERE file_id = ? AND name = ?", line[0], "working")) {
				auto l = load(res[0]);
				pushToProduction(line[0], l.render(this).toString);
				break;
			}
		}

	}

	/// $(PITFALL Use with extreme caution)
	/// Group: portal_syncing
	string pushToProduction(string fileId, string html) {
		// first, find the file we have as a page in the staging content library
		auto bdb = openBranchDatabase();

		string canvasUrl;
		string prodCommit;
		foreach(line; bdb.query("SELECT canvas_page_name, latest_production_commit FROM files WHERE id = ?", fileId)) {
			canvasUrl = line[0];
			prodCommit = line[1];
		}

		if(canvasUrl.length == 0)
			return null;

		if(canvasUrl.startsWith("https://portal.bebraven.org/api/v1/courses/1/pages/"))
			canvasUrl = canvasUrl["https://portal.bebraven.org/api/v1/courses/1/pages/".length .. $];

		// then update it
		auto canvas = getCanvasApiClient(productionCredentials());

		var fix = var.emptyObject;
		fix["wiki_page"] = var.emptyObject;
		fix["wiki_page"]["body"] = html;

		auto result = canvas.rest.courses[1].pages[canvasUrl].PUT(fix).result;

		// save it locally
		// FIXME?
		auto commitId = save(fileId.to!int, prodCommit, Html(html), "working");
		bdb.query("UPDATE files SET latest_production_commit = ? WHERE id = ?", commitId, fileId);

		// then return the URL of the new page on Canvas
		return "https://portal.bebraven.org/courses/1/pages/" ~ canvasUrl;
	}

	/// $(PITFALL Use with caution)
	/// Group: revision_management
	void rollbackCommits(string areYouSure) {
		auto bdb = openBranchDatabase();

		foreach(branch; bdb.query("SELECT branches.name, latest_commit, files.name FROM branches inner join files on files.id = branches.file_id")) {
			auto info = loadRevision(branch[1]);
			import core.stdc.time;
			if(info.timestamp >= time(null) - 3600) {
				import std.stdio;
				writeln("rolling back ", info.id, " ", branch[2], "/", branch[0]);
			} else {
				writeln(info.id, " ok ", time(null) - info.timestamp, " ", branch[2], "/", branch[0]);
			}
		}

	}

	/// $(PITFALL Use with caution)
	/// Group: portal_syncing
	Html doProductionBranchUpdate() {
		string returnedToBrowser;
		auto canvas = getCanvasApiClient(productionCredentials());

		auto modulesRes = canvas.rest.
			courses[1].modules
			._SELF()
			("per_page", 30)
			("include[]", "items")
			.GET;

		var[] modules;

		// handle potential pagination
		more_modules:
		foreach(mod; modulesRes.result) {
			modules ~= mod;
		}
		if(auto next = "next" in modulesRes.response.linksHash) {
			modulesRes = canvas.request(next.url);
			goto more_modules;
		}

		// and here we go!

		auto bdb = openBranchDatabase();
		bool breakOnNext = false;

		foreach(mod; modules) {
			if(mod.published == false)
				continue;
			//if(breakOnNext)
				//break;
			if(mod.name == "Braven Resources")
				breakOnNext = true;

			// writeln("Updating ", mod.position, " - ", mod.name);

			// FIXME: make this only download if actually needed
			int partNum = 0;
			foreach(item; mod.items) {
				auto page = canvas.request(item.url.get!string).result;

				if(false) {
					int fileId;
					string oldName;
					foreach(r; bdb.query("SELECT id, name FROM files WHERE module_number = ? AND subnumber = ?", mod.position.get!string, partNum)) {
						fileId = to!int(r[0]);
						oldName = r[1];
						break;
					}
					if(item.title.get!string != oldName) {
						renamePage(oldName, item.title.get!string, item.url.get!string, false, false);

						returnedToBrowser ~= oldName ~ " => " ~ item.title.get!string ~ "<br>";

					}
					partNum++;
					continue;
				}

				int id;
				string prodCommit;
				foreach(r; bdb.query("SELECT id, latest_production_commit FROM files WHERE name = ?", item.title.get!string)) {
					id = r[0].to!int;
					prodCommit = r[1].to!string;
				}

				if(!id) {
					foreach(r; bdb.query("SELECT coalesce(max(id), 0) FROM files"))
						id = r[0].to!int + 1;

					import std.stdio; writeln("*** ",  mod.position.get!string, " ", partNum);
					if(partNum == 0) {
						// this handles https://stackoverflow.com/questions/19381350/simulate-order-by-in-sqlite-update-to-handle-uniqueness-constraint via hack
						bdb.startTransaction();
						bdb.query("UPDATE files SET module_number = - (module_number + 1) WHERE module_number >= ?", mod.position.get!string);
						bdb.query("UPDATE files SET module_number = -module_number WHERE module_number < 0");
						bdb.query("COMMIT");
					} else {
						// ditto, just subnumber
						bdb.startTransaction();
						bdb.query("UPDATE files SET subnumber = - (subnumber + 1) WHERE module_number = ? AND subnumber >= ?", mod.position.get!string, partNum);
						bdb.query("UPDATE files SET subnumber = -subnumber WHERE module_number = ? AND subnumber < 0", mod.position.get!string);
						bdb.query("COMMIT");
					}

					bdb.query("INSERT INTO files (id, name, module_number, subnumber, latest_production_commit, canvas_page_name) VALUES (?, ?, ?, ?, ?, ?)",
						id, item.title.get!string, mod.position.get!string, partNum, "", item.url.get!string);
				}

				// create the module
				auto commitId = save(id, prodCommit, Html(page["body"].get!string), "working");

				bdb.query("UPDATE files SET latest_production_commit = ? WHERE id = ?", commitId, id);
				//}

				/*
				std.file.write(filename,
					replace(htmlBefore, "TITLE_HERE", "Module " ~mod.position.get!string ~ ": " ~ mod.name.get!string)
					~ page["body"].get!string
					~ htmlAfter);
				*/

				partNum++;
			}
		}

		return Html(returnedToBrowser);
	}

	alias _sitemap sitemap;

	/// $(PITFALL Use with extreme caution)
	/// Group: portal_syncing
	void renamePage(string oldName, string newName, string newUrl, bool onStaging, bool onProduction) {
		/*
		// FIXME
			This must:
				* rename file on Canvas (if not already done - new url should be null then)
				* rename files on the branches.db and update the canvas URL
				* rename Course Participation assignment
				* rename throughout the synced pages too
				* fix up any data-replace-with
				* fix links?
				* save back fixed content to canvas and locally
		*/
		if(oldName == newName)
			return;
		auto bdb = openBranchDatabase();
		auto entry = bdb.query("SELECT id, canvas_page_name, latest_production_commit FROM files WHERE name = ?", oldName).front;
		if(newUrl == entry[1])
			return;

		auto fileId = entry[0];
		auto oldUrl = entry[1];
		auto latestProductionCommit = entry[2];

		auto canvasApi = getCanvasApiClient(productionCredentials());

		if(newUrl is null) {
			// FIXME: rename the file on canvas, get the new url
			assert(0);
		}

		bdb.query("UPDATE files SET name = ?, canvas_page_name = ? WHERE id = ?", newName, newUrl, entry[0]);


		// FIXME: other courses too probably.
		courses_loop: foreach(course; [1]) {

			auto assignments = loadCachedAssignments(canvasApi, course);
			foreach(assignment; assignments) {
				auto an = assignment.name.get!string;

				if(an == "Course Participation - " ~ oldName) {
					var changes = var.emptyObject;
					changes["assignment"] = var.emptyObject;
					changes["assignment"]["name"] = "Course Participation - " ~ newName;
					canvasApi.rest.courses[course].assignments[assignment.id.get!string].PUT(changes).waitForCompletion();
					writeln("UPDATED ASSIGNMENT");
					continue courses_loop;
				}
			}
		}


		foreach(branch; bdb.query("SELECT name, latest_commit, file_id FROM branches")) {
			auto info = loadRevision(branch[1]);
			auto element = info.render(this);
			bool changed = false;

			foreach(e; element.querySelectorAll("[data-replace-with-page=\""~oldName~"\"]")) {
				e.dataset.replaceWithPage = newName;
				changed = true;
			}

			if(!changed)
				continue;

			writeln("UPDATED CONTENT ", info.id);

			auto fixedHtml = element.toString();
			if(branch[1] == latestProductionCommit && branch[0] == "working") {
				pushToProduction(branch[2], fixedHtml);
			} else {
				auto commitId = save(branch[2].to!int, branch[1], Html(fixedHtml), branch[0]);
			}
		}
	}

	/// Group: portal_syncing
	var[] loadCachedAssignments(T)(T canvasApi, int course) {
		assert(course == 1);
		static var[] assignments;
		if(assignments is null) {
			auto assignmentsRes = canvasApi.rest.
				courses[course].assignments
				._SELF()
				("per_page", 30)
				.GET;

			more_assignments:
			foreach(assignment; assignmentsRes.result) {
				assignments ~= assignment;

			}
			if(auto next = "next" in assignmentsRes.response.linksHash) {
				assignmentsRes = canvasApi.request(next.url);
				goto more_assignments;
			}
		}
		return assignments;
	}

	///
	static struct UploadedFileInfo {
		string url; ///
		string contentType; ///
		string description; ///
	}

	/// Uploads a file to Portal, returning information so we can embed it in the editor html.
	/// Group: portal_syncing
	UploadedFileInfo uploadFile(string description, Cgi.UploadedFile file) {

		string contentHash = "unimplemented"; // FIXME
		import std.datetime;
		string lastChanged = Clock.currTime.toISOExtString;
		import std.random;
		int id = uniform(1, int.max);
		import std.conv;

		auto db = openUploadsDatabase();
		db.query("INSERT INTO uploads
			(id, description, name, size, content_type, content_hash, last_changed)
			VALUES
			(?, ?, ?, ?, ?, ?, ?)
		", id, description, file.filename, file.fileSize(), file.contentType, contentHash, lastChanged);

		import std.file;
		mkdirRecurse("data/uploads");

		file.writeToFile("data/uploads/" ~ to!string(id) ~ ".dat");

		auto canvas = getCanvasApiClient(productionCredentials()); // stagingCredentials());
		auto response = canvas.rest.courses[1].files.POST(
			"name", file.filename,
			"size", file.fileSize(),
			"content_type", file.contentType,
			"parent_folder_path", "editor_uploads"
		).result;

		auto url = response.upload_url.get!string;
		auto fd = new FormData();
		foreach(k, v; response.upload_params) {
			fd.append(k.get!string, v.get!string);
		}
		fd.append("file", std.file.read("data/uploads/" ~ to!string(id) ~ ".dat"));

		auto client = new HttpClient();
		import arsd.http2 : Uri;
		auto request2 = client.request(Uri(url), fd);
		auto response2 = request2.waitForCompletion();

		if(response2.code >= 400)
			throw new Exception(response2.contentText);

		auto canvasObject = canvas.request(response2.location, response2.code == 201 ? HttpVerb.GET : HttpVerb.POST).result;

		//db.query("UPDATE uploads SET staging_id = ? WHERE id = ?", canvasObject.id.get!string, id);
		db.query("UPDATE uploads SET production_id = ? WHERE id = ?", canvasObject.id.get!string, id);

		return
			UploadedFileInfo(
			//"https://stagingportal.bebraven.org/courses/1/files/"~canvasObject.id.get!string~"/preview",
			"https://portal.bebraven.org/courses/1/files/"~canvasObject.id.get!string~"/preview",
			file.contentType,
			description);
	}

	string[] allClassNames() {
		return null;
	}

	/// Update the roster for better analytics.
	/// Group: portal_syncing
	void doRosterUpdate() {
		auto db = openProductionMagicFieldDatabase();
		auto canvas = getCanvasApiClient(productionCredentials());

		if(1) {
			auto usersRes = canvas.rest.
				accounts.self.users
				._SELF()
				("per_page", 300)
				.GET;

			// handle potential pagination
			more_users:
			foreach(u; usersRes.result) {
				bool isTestAccount = false;
				if(indexOf(u.email.get!string, "@bebraven.org") != -1)
					isTestAccount = true;
				if(indexOf(u.email.get!string, "@beyondz.org") != -1)
					isTestAccount = true;
				try
				db.query("INSERT INTO users VALUES (?, ?, ?, ?)",
					u.id.get!string, u.name.get!string, u.email.get!string, isTestAccount ? 1 : 0);
				catch(Exception e) {}

			}
			if(auto next = "next" in usersRes.response.linksHash) {
				usersRes = canvas.request(next.url);
				goto more_users;
			}
		}

		if(1) {

			auto coursesRes = canvas.rest.
				courses
				._SELF()
				("per_page", 300)
				.GET;

			// handle potential pagination
			more_courses:
			foreach(c; coursesRes.result) {

				try
				db.query("INSERT INTO courses VALUES (?, ?, ?)",
					c.id.get!string, c.name.get!string, c.time_zone.get!string);
				catch(DatabaseException e) { continue; }

				more_users:
				auto usersRes = canvas.rest.
					courses[c.id.get!int]
					.users
					._SELF()
					("per_page", 300)
					("include[]", "enrollments")
					.GET;

				foreach(user; usersRes.result) {
					foreach(enrollment; user.enrollments)
						try
						db.query("INSERT INTO course_enrollments VALUES (?, ?, ?, ?)",
							enrollment.id.get!int, enrollment.course_id.get!int, enrollment.user_id.get!int, enrollment.role.get!string);
						catch(DatabaseException e) {}
						

				}

				if(auto next = "next" in usersRes.response.linksHash) {
					usersRes = canvas.request(next.url);
					goto more_users;
				}
			}
			if(auto next = "next" in coursesRes.response.linksHash) {
				coursesRes = canvas.request(next.url);
				goto more_courses;
			}
		}


	}

	/// Update the magic field for analytics.
	/// Group: portal_syncing
	string doMagicFieldUpdate() {
		auto db = openProductionMagicFieldDatabase();

		string lastUpdate = "0";
		foreach(res; db.query("SELECT max(strftime('%s', updated_at)) from magic_fields"))
			lastUpdate = res[0];

		auto accessToken = productionCredentials().apiToken;

		auto updateJson = getText("https://portal.bebraven.org/bz/magic_field_dump?since="~lastUpdate~"&access_token=" ~ accessToken);

		import std.file, arsd.jsvar;
		var json = var.fromJson(updateJson);
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
		return count.to!string;

	}

	/++
		Returns the commit ID for the given branch of a file.

		Group: editing
	+/
	string readBranch(string filename, string branch) {
		auto bdb = openBranchDatabase();
		if(branch == "production")
			foreach(file; bdb.query("SELECT  latest_production_commit FROM files WHERE name = ?", filename))
				return file[0];
		else
			foreach(file; bdb.query("
				SELECT
					latest_commit
				FROM
					branches
				INNER JOIN
					files ON branches.file_id = files.id
				WHERE
					files.name = ?
					AND
					branches.name = ?
			", filename, branch))
			{
				return file[0];
			}

		return null;
	}

	/++
		Loads the bz-module revision with the given commit ID

		See_also: [readBranch]

		Group: editing
	+/
	RevisionData load(string id) {
		id = sanitizeId(id);
		if(id.length && std.file.exists("data/revisions/" ~ id ~ ".dat")) {
			auto data = loadRevision(id);
			data.render(this); // populates the html field
			return data;
		}
		return RevisionData.init;
	}

	/++
		Loads details about a particular commit

		Group: editing
	+/
	RevisionData loadRevision(string id) {
		RevisionData data;

		if(id is null)
			return data;

		if(!std.file.exists("data/revisions/" ~ id ~ ".dat"))
			throw new Exception("revision " ~ id ~ " not found");

		auto rawData = cast(ubyte[]) std.file.read("data/revisions/" ~ id ~ ".dat");

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
		headerLength |= rawData[pos++] << 8;

		ushort fileFormatVersion;
		fileFormatVersion |= rawData[pos++];
		fileFormatVersion |= rawData[pos++] << 8;
		ushort flags;
		flags |= rawData[pos++];
		flags |= rawData[pos++] << 8;

		int fileId;
		fileId |= rawData[pos++];
		fileId |= rawData[pos++] << 8;
		fileId |= rawData[pos++] << 16;
		fileId |= rawData[pos++] << 24;

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
		data.fileId = fileId;
		data.tag = tag;
		data.basedOn = basedOn;
		data.timestamp = timestamp;
		data.editedBy = editedBy;
		data.mergeId = mergeId;
		data.comment = comment;
		data.diffData = diffData;

		return data;
	}

	///
	static struct RevisionData {
		string id; // stored as file name
		// actually in file
		ushort fileFormatVersion;
		ushort flags;
		int fileId;
		string tag;
		string basedOn;
		uint timestamp;
		string editedBy;
		string mergeId;
		string comment;
		ubyte[] diffData;

		Element rendered;
		Element render(EditorApi _this) {
			if(rendered is null) {
				if(id is null) {
					return new TextNode(null, null);
				}
				/*
				if(isHtml) {
					auto html = std.file.readText("data/" ~ id ~ ".html");
					auto normalized = normalizeHtml(Element.make("div", Html(html)).requireSelector(".bz-module"));
					rendered = (new Document(normalized.join("\n"))).requireSelector(".bz-module");
				} else {
				*/
				Element basedOnElement;
				if(basedOn) {
					basedOnElement = _this.load(basedOn).render(_this);
				} else {
					basedOnElement = null;
				}
				rendered = applyBinaryDiff(basedOnElement, diffData);
				//rendered = rendered.requireSelector(".bz-module");
			}
			return rendered;
		}

		///
		enum Flags : ushort {
			autoSave = 	1 << 0, /// it was an auto save
			merge = 	1 << 1, /// the data of the file starts with the other merge id. or something
			complete = 	1 << 2, /// the data is a complete dump rather than a diff (may be set periodically to avoid excessively O(n) loads)
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

	/// Merges two commits
	/// Group: revision_management
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

		//assert(0, to!string(intoParents.map!("a.id")) ~ " ---- " ~ to!string(whatParents.map!("a.id")));

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
				normalizeHtml(what.render(this)),
				&splitWords);
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

	/// Display differences between two commits
	/// Group: revision_management
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
		string findme;
		RevisionData[string] allRevisions;
		string[] roots;
		string[string] leafs;
		string[string] titles;
		string[string] htmls;

		static bool sorter(string a, string b) {
			import std.string : cmp;
			if(a.isNumeric && b.isNumeric) {
				return (a.to!int - b.to!int) < 0;
			}
			if(a.startsWith("Module ") && b.startsWith("Module ")) {
				a = a["Module ".length .. a.indexOf(":")];
				b = b["Module ".length .. b.indexOf(":")];
				return (a.to!int - b.to!int) < 0;
			}
			return a.cmp(b) < 0;
		}

		Element makeHtmlElement(Document document = null) {
			auto div = Element.make("div");
			auto dl = div.addChild("dl");
			foreach(root; roots.sort!sorter) {
				auto dt = dl.addChild("dt", root in titles ? titles[root] : "no title");
				foreach(id, leafRoot; leafs) {
					if(root == leafRoot) {
						auto data = allRevisions[id];
						/*
							Version   Created By     Last Edited By     Last Edited Date     History / Merge / Compare / Delete
							===================================================================================================
							Production                                                        [Update]
							user-branches
						*/
						auto a = Element.make("a", data.tag ~ " latest change by " ~ data.editedBy ~ " at " ~ printTimestamp(data.timestamp), "edit?id=" ~ id);


						if(findme.length) {
							auto e = htmls[id];
							if(e.indexOf(findme) != -1)
								a.innerText = "********** " ~ a.innerText;

						}

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
				
			}
			return div;
		}
	}

	/// Lists all files (modules for now) known to the editor
	/// Group: editing
	Element files() {
		auto bdb = openBranchDatabase();
		auto div = Element.make("div");
		string lastModule;
		Element list;
		foreach(file; bdb.query("SELECT id, name, latest_production_commit, module_number, canvas_page_name FROM files ORDER BY module_number, subnumber")) {
			if(file[3] != lastModule) {
				lastModule = file[3];
				div.addChild("h3", "Module " ~ lastModule);
				list = div.addChild("ol");
			}
			auto li = list.addChild("li", Element.make("span", file[1]).setAttribute("title", file[4])); // Element.make("a", file[1], "/edit?id=" ~ file[2]));
			auto ul = li.addChild("ul");
			foreach(branch; bdb.query("SELECT name, latest_commit FROM branches WHERE file_id = ?", file[0])) {
				auto sli = ul.addChild("li", Element.make("a", branch[0], "/edit?fileId=" ~ file[0] ~ "&branch=" ~ branch[0]));
				sli.appendText(" ");
				auto cl = sli.addChild("a", "[Changes from Production]", "/diff?v1=" ~ file[2] ~ "&v2=" ~ branch[1]);
				sli.appendText(" ");
				auto clh = sli.addChild("a", "[History]", "/branchHistory?fileId="~file[0]~"&branch="~branch[0]);
			}

		}
		return div;
	}

	/// Group: revision_management
	Element branchHistory(int fileId, string branch) {
		auto bdb = openBranchDatabase();
		auto lc = bdb.query("SELECT latest_commit FROM branches WHERE file_id = ? AND name = ?", fileId, branch).front[0];

		auto div = Element.make("div");
		auto table = cast(Table) div.addChild("table");
		auto rd = loadRevision(lc);
		string prev;
		while(rd.id.length) {
			table.appendRow(Element.make("a", printTimestamp(rd.timestamp), "/edit?id=" ~ rd.id), prev.length ? Element.make("a", "Changes", "/diff?v1=" ~ prev ~ "&v2=" ~ rd.id) : Element.make("span"));
			prev = rd.id;
			if(rd.basedOn.length == 0)
				break;
			rd = loadRevision(rd.basedOn);
		}
		return div;
	}

	/// Gives the raw log of revisions. For recovery of accidentally deleted items.
	/// Group: revision_management
	FilesResult reflog(string findme = null) {
		import std.file;

		EditorApi api;
		RevisionData[] results;
		string[] roots;
		string[string] leafs;
		string[string] titles;
		string[string] htmls;

		RevisionData[string] helper;


		auto bdb = openBranchDatabase();
		// FIXME
		foreach(row; bdb.query("SELECT name, latest_production_commit FROM files")) {
			titles[row[1]] = row[0];
		}

		foreach(string name; dirEntries("data/revisions", "*.dat", SpanMode.shallow)) {
			auto data = loadRevision(name["data/revisions/".length .. $-".dat".length]);
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

			if(findme.length) {
				auto d = helper[k];
				//auto e = d.render(this);
				htmls[k] = load(k).rendered.toString;//e.toString;
			}
		}

		return FilesResult(findme, helper, roots, leafs, titles, htmls);
	}

	/// Edits a file - the main entry point to the editor
	/// Group: editing
	Document edit(int fileId = 0, string branch = "working", string id = null) {
		import std.file;
		auto document = new Document(readText("editor.html"), true, true);
		_postProcess(document);
		if(fileId && branch.length && id is null) {
			auto bdb = openBranchDatabase();
			foreach(res; bdb.query("SELECT latest_commit FROM branches WHERE file_id = ? AND name = ?", fileId, branch))
				id = res[0];

			document.mainBody.addChild("script", "loadObject(" ~ toJson(load(id)) ~ ", "~var(branch).toJson~");");
		} else if(fileId && branch.length) {
			// specific id inside the branch
			assert(0, "FIXME");
		} else {
			// specific id, no branch info
			document.mainBody.addChild("script", "load(" ~ var(id).toJson() ~ ");");
		}
		return document;
	}

	/* ********************************* */
	/* These functions are just a bit of plumbing for the framework. */
	/* ********************************* */

	public override Element _getGenericContainer(string type) {
		import std.file;
		auto document = new Document(readText("skeleton.html"), true, true);
		if(type == "analytics")
			document.requireElementById("page-name-title").innerText = "Content Analytics";
		return document.requireElementById("generic-container");
	}
	public override Document _defaultPage() {
		auto e = _getGenericContainer("default");
		e.appendChild(files());
		return e.parentDocument;
	}

	protected override FileResource _catchAll(string path) {
		path = path.replace("../", "");
		import std.file;
		if(path == "bz_newui.css")
			return new DataFile("text/css", readText("../bz_newui.css"));
		if(path == "bz_custom.js")
			return new DataFile("text/javascript", readText("../bz_custom.js"));
		else if(path.startsWith("images/"))
			return new DataFile(extensionToMime(path), cast(immutable) std.file.read("../" ~ path));
		else if(path.startsWith("icons/"))
			return new DataFile(extensionToMime(path), cast(immutable) std.file.read(path));
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

			foreach(img; document.querySelectorAll("[src^=\"HERE/\"]"))
				img.src = loc ~ img.src[5 .. $];
			foreach(img; document.querySelectorAll("[href^=\"HERE/\"]"))
				img.href = loc ~ img.href[5 .. $];
			foreach(img; document.querySelectorAll("[action^=\"HERE/\"]"))
				img.action = loc ~ img.action[5 .. $];

			document.mainBody.addChild("script")
				.setAttribute("id", "webd-functions-js")
				.src = loc ~ "functions.js?" ~ compiliationStamp;
			document.mainBody.addChild("script", "EditorApi._apiBase = " ~ toJson(loc) ~ ";");
			if(auto css = document.getElementById("embedded-css"))
				css.innerRawSource = std.file.readText("editor.css");
			if(auto js = document.getElementById("embedded-js"))
				js.innerRawSource = std.file.readText("editor.js");
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

/**
	The diff algorithm uses a custom word splitter in an attempt to better
	display legible differences between HTML files. It is aware of HTML
	tags and will not try to break them up into words, like a naive split
	on space or whatever would do.
*/
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

/**
	The editor tries to minimize useless diffs by first normalizing all
	HTML it tries to compare or to save. It changes a few WYSIWYG tags to
	a standard representation, automatically formats whitespace inside the
	HTML, fixes some ancillary data Portal attaches, etc.

	With this, comparing two diffs, even if the formatting is radically
	different, will only show actual content changes, not just indentation
	or other trivial points. The automatic formatting also happens to keep
	the HTML source code consistently legible.
*/
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

/// The commits are stored on disk as a binary diff, this applies one to build up to the final product.
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

	return new DocumentFragment(Html(lines.join("\n")));//.requireSelector(".bz-module");
}

import core.stdc.time;
string printTimestamp(time_t unixTimestamp) {
	char[255] buffer;
	auto res = strftime(buffer.ptr, buffer.length - 1, "%a, %d %b %Y %T %z", localtime(&unixTimestamp));
	return buffer[0 .. res].idup;
}

/// This function turns English text headings into HTML ids or URL components.
string urlify(string text) {
	string n;
	foreach(ch; text) {
		if(ch >= 'a' && ch <= 'z')
			n ~= ch;
		else if(ch >= 'A' && ch <= 'Z')
			n ~= ch | 0x20;
		else if(ch >= '0' && ch <= '9')
			n ~= ch;
		else if(ch == '-' || ch == '_')
			n ~= ch;
		else if(ch == ' ')
			n ~= '-';
	}
	return n;
}

/// Commit IDs are strictly sanitized before use.
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

string prepareMagicFieldNameForSql(string n) {
	string sanitized = "";
	bool insidePlaceholder = false;
	foreach(ch; n) {
		if(insidePlaceholder) {
			if(ch == '}')
				insidePlaceholder = false;
			continue;
		}

		if(ch == '_')
			sanitized ~= `\_`;
		else if(ch == '%')
			sanitized ~= `\%`;
		else if(ch == '\\')
			sanitized ~= `\\`;
		else if(ch == '{') {
			sanitized ~= "%";
			insidePlaceholder = true;
		}
		else
			if(ch == '-' || ch == '_' || 
				(ch >= 'a' && ch <= 'z') ||
				(ch >= 'A' && ch <= 'Z') ||
				(ch >= '0' && ch <= '9'))
				sanitized ~= ch;
	}

	return sanitized;
}

///
struct MergeResult(T) {
	T suggestion; /// Suggested merged content
	T o; /// Original ancestor content
	T a; /// Merge candidate A content
	T b; /// Merge candidate B content
	bool potentialProblem; /// flags if the suggestion is likely wrong and requires manual review/merge conflict action
}

import std.range;
/++
	Performs a three-way merge of `a` and `b`, if `o` is their common ancestor.
	Will run `problemResolutionFunction` on a merge conflict line to attempt
	a sub-merge to make a better suggestion.
+/
MergeResult!(ElementType!R)[] threeWayMerge(R)(R o, R a, R b, string[] function(string) problemResolutionFunction = null) {
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
					f ~= ResultType(null, old, null, b[b_pos], false);
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
					string suggestion = null;
					bool problem = true;
					if(problemResolutionFunction !is null && old_by_a == old_by_b) {
						auto na = problemResolutionFunction(new_by_a);
						auto nb = problemResolutionFunction(new_by_b);
						auto no = problemResolutionFunction(old_by_a);
						auto merged = threeWayMerge(no, na, nb, null);
						bool anyProblem = false;
						foreach(word; merged) {
							suggestion ~= word.suggestion;
							anyProblem = anyProblem || word.potentialProblem;
						};
						problem = anyProblem;
					}


					f ~= ResultType(suggestion, old_by_a, new_by_a, new_by_b, problem);
				}

				a_pos++;
				b_pos++;
			break;
			case EditOp.remove:
				auto old = o_at_a(a_pos);
				if(old == a[a_pos]) {
					// it was in the old, removed from the second branch
					// also keep it removed
					f ~= ResultType(null, old, a[a_pos], null, false);
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
struct CanvasCredentials {
	string apiToken;
	string apiBaseUrl;
}

CanvasCredentials stagingCredentials() {
	import std.file;
	return var.fromJson(readText("data/staging_canvas_creds.json")).get!CanvasCredentials;
}
CanvasCredentials productionCredentials() {
	import std.file;
	return var.fromJson(readText("data/production_canvas_creds.json")).get!CanvasCredentials;
}

HttpApiClient!() getCanvasApiClient(CanvasCredentials credentials) {
	return new HttpApiClient!()(credentials.apiBaseUrl, credentials.apiToken, "application/json");
}

import arsd.sqlite;

Sqlite openBranchDatabase() {
	return openDBAndCreateIfNotPresent("data/branches.db", `
		CREATE TABLE files (
			id INTEGER NOT NULL,
			name TEXT NOT NULL UNIQUE,

			module_number INTEGER NOT NULL,
			subnumber INTEGER NOT NULL,

			latest_production_commit TEXT NOT NULL,

			canvas_page_name TEXT,

			UNIQUE(module_number, subnumber),

			PRIMARY KEY (name)
		);

		CREATE TABLE branches (
			file_id INTEGER NOT NULL,
			name TEXT NOT NULL,

			latest_commit TEXT NOT NULL,

			FOREIGN KEY (file_id) REFERENCES files(id) ON DELETE CASCADE ON UPDATE CASCADE,

			PRIMARY KEY (file_id, name)
		);
	`);
}

Sqlite openUploadsDatabase() {
	return openDBAndCreateIfNotPresent("data/uploads.db", `
		CREATE TABLE uploads (
			id INTEGER NOT NULL,

			name TEXT NOT NULL,
			description TEXT NOT NULL,
			size INTEGER NOT NULL,
			content_type TEXT NOT NULL,
			content_hash TEXT NOT NULL,

			last_changed TEXT NOT NULL,

			production_id INTEGER NULL,
			staging_id INTEGER NULL,

			PRIMARY KEY (id)
		);
	`);
}


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

		CREATE TABLE users (
			user_id INTEGER NOT NULL,
			name TEXT,
			email TEXT,
			is_test_account INTEGER NOT NULL,
			PRIMARY KEY(user_id)
		);

		CREATE TABLE courses (
			course_id INTEGER NOT NULL,
			name TEXT,
			timezone TEXT,
			PRIMARY KEY(course_id)
		);

		CREATE TABLE course_enrollments (
			enrollment_id INTEGER NOT NULL,
			course_id INTEGER NOT NULL,
			user_id INTEGER NOT NULL,
			enrollment_type TEXT,
			PRIMARY KEY(enrollment_id)
		);
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

string htmlBefore = `<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TITLE_HERE</title>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous">
</script>
<style>
@font-face {
 font-family: "TradeGothicNo.20-CondBold";
 src: url('../TradeGothicLTStd-BdCn20.otf');
}
</style>
<link rel="stylesheet" type="text/css" href="../bz_newui.css" />
</head>
<body>
`;

string htmlAfter = `
<script src="../new-ui-sandbox.js"></script>
</body>
</html>`;


