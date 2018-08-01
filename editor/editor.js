// note that .classList is null on text nodes...

// FIXME: for-match, for-checklist

var selectionButtons = [
	"bold",
	"italic",
	"underline",
	"",
	"insertUnorderedList",
	"insertOrderedList",
	{ icon: "quote", command: "formatBlock", argument: "BLOCKQUOTE"},
	"",
	"removeFormat",
	//"format",
	{ icon: "hyperlink", command: "createLink", argument: "#" },
	{ icon: "hyperlink", command: "unlink" },
	"",
	"justifyleft",
	"justifycenter",
	"justifyright",
	"",
	"copy",
	"cut",
	"paste",
	"",
	//"indent",
	//"outdent",
	//"print",
	"undo",
	"redo",
];

// FIXME: warn on any hidden required fields
// FIXME: all sliders need to be optional or otherwise validated

/*
	If it knows you have focused a table, it should offer
	stuff like insert row, insert column contextually.

	realtime css edit?


	Key controls:

	shift + page up/down - go up and down to a bz-box
	esc - toggle rendered and source view
	shift+enter will break out of one level of element
		for example, when in a blockquote, shift+enter will put you in a <p> after the </blockquote>
		inside a <li>, shift+enter will go to new li. If in a blank li, shift+enter will delete the
		empty one and take you outside the list.
	shift+space will return to normal formatting
	alt+< will open the "insert html" thingy allowing you to insert an arbitrary html tag name

	Revision comparisons:

	show differences
	do conflict resolution by showing each thing and being
		like "keep old version", "keep A", "keep B", or "merge both"
*/

var viewingHtml = true;

// convenience compatibility with dom.d
HTMLElement.prototype.addChild = function(tag, arg1, arg2) {
	var t = document.createElement(tag);
	switch(tag) {
		case "input":
			if(arg1)
				t.setAttribute("type", arg1);
			if(arg2)
				t.setAttribute("value", arg2);
		break;
		default:
			if(arg1)
				t.textContent = arg1;
			if(arg2)
				t.className = arg2;
	}
	this.appendChild(t);
	return t;
};

var currentlyLoaded = {
	id: null,
	fileId: 0
};

function listMagicFields() {
	var mf = document.getElementById("sidebar");
	mf.innerHTML = "";
	document.querySelectorAll("#editor [data-bz-retained]").forEach(function(e) {
		var a = document.createElement("a");
		a.textContent = e.dataset.bzRetained;
		a.onclick = function() {
			e.scrollIntoView();
		};
		mf.appendChild(a);
	});
}

// from https://stackoverflow.com/a/2117523/1457000
function uuidv4() {
	return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
		(c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
	)
}


function listHeaders() {
	var mf = document.getElementById("sidebar");
	mf.innerHTML = "";
	var root = document.getElementById("editor");
	var iterator = document.createNodeIterator(root, NodeFilter.SHOW_ELEMENT, null);
	var e;
	while(e = iterator.nextNode()) {
		if(e.tagName == "H1" || e.tagName == "H2" || e.tagName == "H3" || e.tagName == "H4" || e.tagName == "H5" || e.tagName == "H6") {
			var a = document.createElement("a");
			var label = "";
			var level = Number(e.tagName.substring(1));
			for(var i = 0; i < level; i++)
				label += "\u00a0";
			label += e.textContent;
			a.textContent = label;
			a.onclick = (function(e) { return function() {
				e.scrollIntoView();
			} }(e));
			mf.appendChild(a);
		}
	}
}

function isChecklist(ele) {
	return ele && ele.classList && ele.classList.contains("checklist");
}
function isRadioList(ele) {
	return ele && ele.classList && ele.classList.contains("radio-list");
}

function bzBoxType(ele) {
	if(!ele) return null;
	if(!ele.classList) return null;
	if(!ele.classList.contains("bz-box")) return null;
	return ele.className.replace("bz-box", "").
		replace("incorrect", "").
		replace("correct", "").
		replace(/\s/g, '');
}

function addAttributeTextBox(parent, ele, attr) {
	var input = document.createElement("input");
	input.setAttribute("type", "text");
	input.value = ele.getAttribute(attr);
	input.onchange = function() {
		ele.setAttribute(attr, input.value);
	};
	input.refersToInEditor = ele;
	parent.appendChild(input);
}

function addAttributeSelect(parent, ele, attr, options) {
	var input = document.createElement("select");

	options.forEach(function(opt) {
		var option = document.createElement("option");
		option.textContent = opt;
		input.appendChild(option);
	});

	input.value = ele.getAttribute(attr);
	input.onchange = function() {
		ele.setAttribute(attr, input.value);
	};
	input.refersToInEditor = ele;
	parent.appendChild(input);
}


function addStyleTextBox(parent, ele, attr, unit) {
	if(!unit)
		unit = "";
	var input = document.createElement("input");
	input.setAttribute("type", "text");
	input.value = ele.style[attr].replace(unit, "");
	input.onchange = function() {
		if(input.value.length)
			ele.style[attr] = input.value + unit;
		else
			ele.style[attr] = null;
	};
	input.refersToInEditor = ele;
	parent.appendChild(input);
}


function getIfPresent(list, options) {
	for(var i = 0; i < options.length; i++)
		if(list.contains(options[i]))
			return options[i];
	return "";
}

function getSidebarBox(ele) {
	if(ele.nodeType == Node.TEXT_NODE)
		return null;

	if(bzBoxType(ele) !== null) {
		var div = document.createElement("div");
		var h3 = document.createElement("h3");
		h3.textContent = "BZ Box";
		div.appendChild(h3);
		div.appendChild(makeSelect("BZ Box Type:", function(opt) {
			ele.className = "bz-box " + opt.className;
			var header = ele.querySelector(".box-title");
			if(header) {
				var isDefault = false;
				bzBoxTypes.forEach(function(def) {
					if(header.textContent == def.defaultTitle)
						isDefault = true;
				});
				if(isDefault) {
					header.textContent = opt.defaultTitle;
					if(opt.className == "video") {
						// insert the default scaffolding for a video if empty
						if(!ele.querySelector("h4 + *")) {
							ele.innerHTML += "<figure>Replace this text with the video<figcaption><p>Description here</p><p class=\"media-duration\">About 2 minutes</p></figcaption></figure>";
							wrapStuffForEditing(ele);
						}

					}
				}
			}
		}, bzBoxTypes, bzBoxType(ele)));

		div.appendChild(document.createElement("br"));

		div.appendChild(makeSelect("Correctness:", function(opt) {
			ele.classList.remove("correct");
			ele.classList.remove("incorrect");
			ele.classList.remove("maybe");
			if(opt != "")
				ele.classList.add(opt);
		}, ["", "correct", "incorrect", "maybe"], getIfPresent(ele.classList, ["correct", "incorrect", "maybe"])));


		return div;

	} else if(isChecklist(ele) || isRadioList(ele)) {
		var div = document.createElement("div");
		var h3 = document.createElement("h3");
		h3.textContent = isChecklist(ele) ? "Checklist" : "Radio List";
		div.appendChild(h3);
		div.appendChild(makeCheckbox("Mix", function(checked) {
			if(checked)
				ele.classList.remove("dont-mix");
			else
				ele.classList.add("dont-mix");
		}, !ele.classList.contains("dont-mix")));

		div.appendChild(document.createElement("br"));

		div.appendChild(makeCheckbox("Instant Feedback", function(checked) {
			if(checked)
				ele.classList.add("instant-feedback");
			else
				ele.classList.remove("instant-feedback");
		}, ele.classList.contains("instant-feedback")));

		div.appendChild(document.createElement("br"));

		div.appendChild(makeCheckbox("To Columns", function(checked) {
			if(checked)
				ele.classList.add("to-columns");
			else
				ele.classList.remove("to-columns");
		}, ele.classList.contains("to-columns")));

	// FIXME
			dt = document.createElement("dt");
			dt.textContent = "Checklist Max Score";
			div.appendChild(dt);
			dd = document.createElement("dd");
			addAttributeTextBox(dd, ele, "data-bz-max-score");
			div.appendChild(dd);


		return div;
	} else if(ele.tagName == "LI" && (isChecklist(ele.parentNode) || isRadioList(ele.parentNode))) {
		var div = document.createElement("div");
		var h3 = document.createElement("h3");
		h3.textContent = isChecklist(ele.parentNode) ? "Checklist Item" : "Radio List Item";
		div.appendChild(h3);
		div.appendChild(makeSelect("Correctness:", function(opt) {
			ele.className = opt;
		}, ["", "correct", "incorrect", "maybe"], ele.className));
		if(!ele.querySelector(".inline.feedback")) {
			var button = document.createElement("button");
			button.setAttribute("type", "button");
			button.textContent = "Add Inline Feedback";
			button.addEventListener("click", function() {
				ele.innerHTML += "<p class=\"inline feedback\">Inline Feedback</p>";
				selectAll(ele.querySelector(".inline.feedback").firstChild);
			});
			div.appendChild(button);
		}
		return div;
	} else if(ele.tagName == "TABLE") {
		var div = document.createElement("div");
		var h3 = document.createElement("h3");
		h3.textContent = "Table";
		div.appendChild(h3);
		div.appendChild(makeCheckbox("Zebra Stripe", function(checked) {
			if(checked)
				ele.classList.remove("no-zebra");
			else
				ele.classList.add("no-zebra");
		}, !ele.classList.contains("no-zebra")));

		var button = document.createElement("button");
		button.textContent = "Insert Row";
		button.onclick = function() {
			var orig = ele.querySelector("tr");
			var tr = orig.cloneNode(true);
			var inside = tr.querySelectorAll("td");
			for(var i = 0; i < inside.length; i++)
				inside[i].innerHTML = "<p>&nbsp;</p>";
			ele.appendChild(tr);
			if(tr.querySelector("p")) {
				selectAll(tr.querySelector("p"));
				tr.querySelector("p").scrollIntoView();
			}
		};
		div.appendChild(button);

		var button = document.createElement("button");
		button.textContent = "Insert Column";
		button.onclick = function() {
			var rows = ele.querySelectorAll("tr");
			for(var i = 0; i < rows.length; i++) {
				var row = rows[i];
				var td = row.querySelector("td:last-child");
				if(td) {
					td = td.cloneNode(true);
				} else {
					td = document.createElement("td");
					td.innerHTML = "<p>&nbsp;</p>";
				}

				row.appendChild(td);

				if(td.querySelector("p")) {
					selectAll(td.querySelector("p"));
					td.querySelector("p").scrollIntoView();
				}
			}
		};
		div.appendChild(button);


		return div;
	}

	var div = document.createElement("div");


	var h3 = document.createElement("h3");
	h3.textContent = "<" + ele.tagName + ">"; // + (ele.id ? "#"+ele.id : "") + (ele.className.length? "."+ele.className.replace(" ", ".") : "");
	div.appendChild(h3);
	h3.style.cursor = "pointer";
	h3.onclick = (function(ele) { return function() {
		ele.classList.add("editor-focused");
		setTimeout(function() {
			ele.classList.remove("editor-focused");
		}, 3000);
	} })(ele);

	var details = div.addChild("details");

	var l = details.addChild("label");
	l.addChild("span", "ID: ");
	var i = l.addChild("input", "text", ele.getAttribute("id"));
	i.onchange = (function(ele) { return function() {
		ele.setAttribute("id", this.value);
	} })(ele);


	div.addChild("br");

	var l = details.addChild("label");
	l.addChild("span", "Classes: ");
	var i = l.addChild("input", "text", ele.getAttribute("class"));
	i.onchange = (function(ele) { return function() {
		ele.setAttribute("class", this.value);
	} })(ele);


	var dl = document.createElement("dl");
	div.appendChild(dl);

	if(ele.tagName == "TR") {
		var button = document.createElement("button");
		button.textContent = "Delete Whole Row";
		button.onclick = function() {
			ele.parentNode.removeChild(ele);
		};
		div.appendChild(button);

	}

	if(ele.getAttribute("data-bz-reference")) {
		// .conditional-show
	}


	if(ele.classList.contains("feedback")) {
		dt = document.createElement("dt");
		dt.textContent = "Feedback Lower Range";
		dl.appendChild(dt);
		dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "data-bz-range-flr");
		dl.appendChild(dd);

		dt = document.createElement("dt");
		dt.textContent = "Feedback Upper Range";
		dl.appendChild(dt);
		dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "data-bz-range-clg");
		dl.appendChild(dd);

	}

	
	if(ele.getAttribute("data-bz-retained")) {
		if(ele.tagName == "TEXTAREA") {

			dt = document.createElement("dt");
			dt.textContent = "Display Height";
			dl.appendChild(dt);
			dd = document.createElement("dd");
			addStyleTextBox(dd, ele, "height", "em");
			dl.appendChild(dd);

		}

		dt = document.createElement("dt");
		dt.textContent = "Type";
		dl.appendChild(dt);
		dd = document.createElement("dd");
		addAttributeSelect(dd, ele, "type", [
			"",
			"text",
			"file",
			"checkbox",
			"radio"
		]);
		dl.appendChild(dd);

		dt = document.createElement("dt");
		dt.textContent = "Placeholder";
		dl.appendChild(dt);
		dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "placeholder");
		dl.appendChild(dd);

		var dt = document.createElement("dt");
		dt.textContent = "Magic Field Name";
		dl.appendChild(dt);
		var dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "data-bz-retained");
		dl.appendChild(dd);

		dt = document.createElement("dt");
		dt.textContent = "Mastery Answer";
		dl.appendChild(dt);
		dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "data-bz-answer");
		dl.appendChild(dd);

		dt = document.createElement("dt");
		dt.textContent = "Mastery Weight";
		dl.appendChild(dt);
		dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "data-bz-weight");
		dl.appendChild(dd);

		dt = document.createElement("dt");
		dt.textContent = "Mastery Partial Credit";
		dl.appendChild(dt);
		dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "data-bz-partial-credit");
		dl.appendChild(dd);

		div.appendChild(makeCheckbox("Optional Magic Field", function(checked) {
			if(checked) {
				ele.classList.add("bz-optional-magic-field");
			} else {
				ele.classList.remove("bz-optional-magic-field");
			}
		}, ele.classList.contains("bz-optional-magic-field")));


		if(ele.getAttribute("type") == "range") {
			dt = document.createElement("dt");
			dt.textContent = "Range Answer";
			dl.appendChild(dt);
			dd = document.createElement("dd");
			addAttributeTextBox(dd, ele, "data-bz-range-answer");
			dl.appendChild(dd);

			dt = document.createElement("dt");
			dt.textContent = "Min";
			dl.appendChild(dt);
			dd = document.createElement("dd");
			addAttributeTextBox(dd, ele, "min");
			dl.appendChild(dd);

			dt = document.createElement("dt");
			dt.textContent = "Max";
			dl.appendChild(dt);
			dd = document.createElement("dd");
			addAttributeTextBox(dd, ele, "max");
			dl.appendChild(dd);

			dt = document.createElement("dt");
			dt.textContent = "Step";
			dl.appendChild(dt);
			dd = document.createElement("dd");
			addAttributeTextBox(dd, ele, "step");
			dl.appendChild(dd);
		}
	}

	if(ele.classList.contains("slider-container")) {
		div.appendChild(makeCheckbox("Likert Style", function(checked) {
			if(checked)
				ele.classList.add("likert-style");
			else
				ele.classList.remove("likert-style");

		}, ele.classList.contains("likert-style")));
	}


	if(ele.tagName == "P") {
		div.appendChild(makeCheckbox("Inline Feedback", function(checked) {
			if(checked) {
				ele.classList.add("inline");
				ele.classList.add("feedback");
			} else {
				ele.classList.remove("inline");
				ele.classList.remove("feedback");
			}
		}, ele.classList.contains("inline") && ele.classList.contains("feedback")));
	}

	if(ele.classList.contains("bz-has-tooltip")) {
		var dt = document.createElement("dt");
		dt.textContent = "Tooltip";
		dl.appendChild(dt);
		var dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "title");
		dl.appendChild(dd);
	}

	if(ele.classList.contains("context-notes")) {
		var dt = document.createElement("dt");
		dt.textContent = "Popup Notes";
		dl.appendChild(dt);
		var dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "data-content");
		dl.appendChild(dd);
	}

	
	if(ele.tagName == "A" && ele.href) {
		var dt = document.createElement("dt");
		dt.textContent = "Links To";
		dl.appendChild(dt);
		var dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "href");
		dl.appendChild(dd);
	}

	if(ele.tagName == "IFRAME") {
		var dt = document.createElement("dt");
		dt.textContent = "Iframe Source";
		dl.appendChild(dt);
		var dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "src");
		dl.appendChild(dd);
	}
	
	if(ele.tagName == "IMG") {
		var dt = document.createElement("dt");
		dt.textContent = "Image Source";
		dl.appendChild(dt);
		var dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "src");
		dl.appendChild(dd);

		var dt = document.createElement("dt");
		dt.textContent = "Alt Text";
		dl.appendChild(dt);
		var dd = document.createElement("dd");
		addAttributeTextBox(dd, ele, "alt");
		dl.appendChild(dd);
	}


	return div; // null if we don't want a box for this element
}

function makeSelect(label, onchange, options, current) {
	var labelElement = document.createElement("label");
	var select = document.createElement("select");
	options.forEach(function(e) {
		var disp = e;
		if(typeof disp != "string")
			disp = disp.className; // hack to support passing an array of objects
		var o = document.createElement("option");
		o.value = disp;
		o.textContent = disp;
		if(disp == current)
			o.setAttribute("selected", "selected");
		select.appendChild(o);
	});
	select.onchange = function() {
		onchange(options[select.selectedIndex]);
	};
	var span = document.createElement("span");
	span.textContent = label;
	labelElement.appendChild(span);
	labelElement.appendChild(document.createTextNode(" "));
	labelElement.appendChild(select);
	return labelElement;

}

function makeCheckbox(label, onchange, checked) {
	var labelElement = document.createElement("label");
	var input = document.createElement("input");
	input.setAttribute("type", "checkbox");
	if(checked)
		input.setAttribute("checked", "checked");
	input.onchange = function() {
		onchange(input.checked);
	};
	labelElement.appendChild(input);
	labelElement.appendChild(document.createTextNode(" " + label));
	return labelElement;
}

var showingSidebarFor;
function showSidebarFor(ele) {
	if(ele == showingSidebarFor)
		return;
	var sidebar = document.getElementById("sidebar");
	sidebar.innerHTML = "";

	var current = ele;
	while(current || (!current.classList || !current.classList.contains("bz-module"))) {
		if(current.id == "editor")
			break;
		var inspecting = current;
		if(current.classList && current.classList.contains("hacky-wrapper")) {
			if(current.classList.contains("wraps-iframe")) {
				inspecting = current.querySelector("iframe");
			} else {
				current = current.parentNode;
				continue;
			}
		}
		var editorElement = getSidebarBox(inspecting);
		if(editorElement)
			sidebar.appendChild(editorElement);

		current = current.parentNode;
		if(!current || (current.classList && current.classList.contains("bz-module")))
			break;

		sidebar.appendChild(document.createElement("hr"));
	}

	if(ele.querySelectorAll) {
		var magicFields = ele.querySelectorAll("[data-bz-retained]");
		for(var i = 0; i < magicFields.length; i++) {
			var name = magicFields[i].getAttribute("data-bz-retained");
			var mf = document.createElement("div");
			mf.textContent = "Contains magic field: " + name;
			sidebar.appendChild(mf);
		}
	}

	showingSidebarFor = ele;
}

function insertChecklistBox(f) {
	if(!f.querySelector("input[type=checkbox]")) {
		var i = document.createElement("input");
		i.setAttribute("type", "checkbox");
		i.setAttribute("data-bz-retained", uuidv4());
		f.insertBefore(i, f.firstChild);

		wrapStuffForEditing(f);
	}
}

function updateSelectionData() {
	var f = window.getSelection().focusNode;
	updateSidebar(f);
}

function updateSidebar(f) {
	if(f) {
		var bf = document.getElementById("block-format");
		bf.selectedIndex = 0;
		var oldf = f;
		while(f) {
			if(f.tagName && f.tagName.substring(0, 1) == "H") {
				for(var i = 0; i < bf.options.length; i++)
					if(bf.options[i].value == f.tagName.toLowerCase()) {
						bf.selectedIndex = i;
						f =  null;
						break;
					}
			}
			if(f)
				f = f.parentNode;
		}
		f = oldf;
		if(f.tagName == "LI" && isChecklist(f.parentNode)) {
			insertChecklistBox(f);
		}
		if(f.nodeType == Node.TEXT_NODE && f.parentNode.tagName == "LI" && isChecklist(f.parentNode.parentNode)) {
			insertChecklistBox(f.parentNode);
		}

		var p = f.parentNode;
		while(p) {
			if(p.id == "editor")
				break;
			p = p.parentNode;
		}
		if(p) {
			showSidebarFor(f);
		}
	}
};


function selectNode(ele) {
	var selection = window.getSelection();
	var range = document.createRange();
	range.setStart(ele, 0);
	range.collapse(true);
	selection.removeAllRanges();
	selection.addRange(range);
	console.log("on " + ele);
}


window.onload = function() {
	document.execCommand("enableObjectResizing", false, false);
	document.execCommand("enableInlineTableEditing", false, false);
	document.execCommand("styleWithCSS", false, false);
	document.execCommand("defaultParagraphSeparator", false, "p");
	document.execCommand("insertBrOnReturn", false, false);

	selectionButtons.forEach(function(e) {
		var icon, command, argument, title;
		if(typeof e == "object") {
			icon = e.icon;
			command = e.command;
			argument = e.argument;
			title = e.title ? e.title : e.icon;
		} else {
			icon = e;
			command = e;
			title = e;
			argument = null;
		}
		var sb = document.getElementById("selection-buttons");
		if(command == "") {
			var span = document.createElement("span");
			span.textContent = " ";
			sb.appendChild(span);
		} else {
			var button = document.createElement("button");
			var img = document.createElement("img");
			img.src = EditorApi._apiBase + "/icons/" + icon + ".png";
			img.alt = title;
			button.appendChild(img);
			button.setAttribute("title", title);
			button.setAttribute("type", "button");
			button.onclick = function() {
				document.execCommand(command, false, argument);
			};
			sb.appendChild(button);
		}
	});

	document.getElementById("sidebar").addEventListener("keydown", function(event) {
		var key = event.keyCode || event.which;
		var target = event.target;
		if(key == 13 && event.target.refersToInEditor) {
			event.preventDefault();
			selectAll(event.target.refersToInEditor);
			document.getElementById("editor").focus();
		}
	});

	/*
	var storedSelectionRange = null;
	document.getElementById("editor").addEventListener("focusout", function(event) {
		storedSelectionRange = null;
		var s = window.getSelection();
		if(s) {
			var r = s.getRangeAt(0);
			if(r)
				storedSelectionRange = r.cloneRange();
		}

	});

	document.getElementById("editor").addEventListener("focusin", function(event) {
		if(storedSelectionRange) {
			var s = window.getSelection();
			if(!s.getRangeAt(0)) {
				s.removeAllRanges();
				s.addRange(storedSelectionRange);
			}
		}
	});
	*/


	document.onselectionchange = updateSelectionData;
	document.getElementById("editor").addEventListener("click", function(event) {
		/*
		var selection = window.getSelection();
		var at = selection.focusNode;
		*/
		var at = event.target;

		updateSidebar(at);

		var sidebar = document.getElementById("sidebar");
		//sidebar.innerHTML = "";

		var dl = document.createElement("dl");
		sidebar.appendChild(dl);

		var disp = document.getElementById("tree-position");
		disp.innerHTML = "";
		while(at) {
			if(at.tagName && at.className != "hacky-wrapper") {
				var li = document.createElement("li");
				var label = at.tagName;
				if(at.id)
					label += "#" + at.id;
				if(at.classList)
				at.classList.forEach(function(cn) {
					label += "." + cn;
				});
				li.textContent = label;
				disp.insertBefore(li, disp.firstChild);
			}
			at = at.parentNode;
			if(at && at.getAttribute && at.getAttribute("id") == "editor")
				break;
		}
	});

	function enterShouldBreakOutTo(e) {
		while(e) {
			if(e.classList && (e.classList.contains("slider-container") || e.classList.contains("hacky-wrapper"))) {
				if(e.nextElementSibling && e.nextElementSibling.tagName != "BR")
					return e.nextElementSibling;
				else if(e.parentNode.nextElementSibling && e.parentNode.nextElementSibling.tagName != "BR")
					return e.parentNode.nextElementSibling;
				else {
					var p = document.createElement("p");
					if(e.parentNode.tagName == "P") {
						e.parentNode.parentNode.insertBefore(p, e.parentNode.nextElementSibling);
					} else
						e.parentNode.appendChild(p);
					return p;
				}
			}

			e = e.parentNode;
		}
		return null;
	}

	document.addEventListener("keydown", function(event) {
		var key = event.keyCode || event.which;
		if(key == 32 && event.shiftKey) {
			var selection = window.getSelection();
			var b = selection.focusNode;
			var o = b;
			if(b.nodeType == Node.TEXT_NODE)
				b = b.parentNode;
			if(b.tagName == "SPAN" || b.tagName == "STRONG" || b.tagName == "I" || b.tagName == "B" || b.tagName == "EM" || b.tagName == "A") {
				event.preventDefault();
				var txt = document.createTextNode(" ");
				b.parentNode.insertBefore(txt, b.nextSibling);
				selectAll(txt);
			}
		}
		if(key == 13 && event.ctrlKey && event.shiftKey) {
			event.preventDefault();

			var selection = window.getSelection();
			var b = selection.focusNode;
			while(!b.classList || !b.classList.contains("bz-box"))
				b = b.parentNode;
			if(b) {
				var p = document.createElement("p");
				p.textContent = "hi";
				if(b.nextElementSibling)
					b.parentNode.insertBefore(p, b.nextElementSibling);
				else
					b.parentNode.appendChild(p);

				selectAll(p.firstChild);
				p.scrollIntoView();
			}

		} else if(key == 13 && event.ctrlKey) {
			// move cursor out of current html element
			// FIXME: if inside a table, insert a new row
			event.preventDefault();

			var selection = window.getSelection();
			var b = selection.focusNode;
			if(b.nodeType == Node.TEXT_NODE)
				b = b.parentNode;
			var n = b.nextElementSibling;
			if(n == null)
				n = b.parentNode.nextSibling;

			selectNode(n);
		} else if(key == 13) {
			var selection = window.getSelection();
			var b = selection.focusNode;
			var eto = enterShouldBreakOutTo(b);
			if(eto) {
				event.preventDefault();
				selectNode(eto);
			}
		}

		if(key == 65 && event.ctrlKey) { // ctrl+a
			var selection = window.getSelection();
			// FIXME
			event.preventDefault();
		}

		if(key == 66 && event.ctrlKey) { // ctrl+b
			document.execCommand("bold");
			event.preventDefault();
		}
		if(key == 73 && event.ctrlKey) { // ctrl+i
			document.execCommand("italic");
			event.preventDefault();
		}

		if(key == 46 && event.shiftKey) {
			// delete key with shift will delete the entire html element
			// containing the caret, or (eventually the common parent of the entire current
			// selection
			event.preventDefault();
			var selection = window.getSelection();
			// var a = selection.anchorNode;
			var b = selection.focusNode;
			if(b.nodeType == Node.TEXT_NODE)
				b = b.parentNode;
			var n = b.nextSibling;
			if(n == null)
				n = b.parentNode.nextSibling;
			// var next = b.nextSibling;
			b.parentNode.removeChild(b);

			selectNode(n);
		}
		if(key == 188 /* , or < */ && event.altKey) {
			// pop up the html edit in place

			var sel = window.getSelection();
			var anchorNode = sel.anchorNode;
			var anchorOffset = sel.anchorOffset;
			var focusNode = sel.focusNode;
			var focusOffset = sel.focusOffset;

			var tp = document.getElementById("tree-position");
			tp.innerHTML = "";
			var input = document.createElement("input");
			input.value = "<";
			tp.appendChild(input);
			input.focus();
			input.addEventListener("keydown", function(event) {
				var key = event.keyCode || event.which;

				// so assuming us layout lol
				if(key == 13 || key == 10 || (key == 190 && event.shiftKey)) {
					event.preventDefault();
					var html = input.value; // + ">";
					tp.innerHTML = "";

					var tagName = html.substring(1);
					var newFragment = document.createElement(tagName);
					newFragment.innerHTML = "new stuff";
					focusNode.parentNode.insertBefore(newFragment, focusNode.nextSibling);
					var range = document.createRange();
					range.selectNodeContents(newFragment);
					sel.removeAllRanges();
					sel.addRange(range);
					document.getElementById("editor").focus();
				}
			});
		}
		if(key == 27) {
			var textarea = document.querySelector("#view-source textarea");
			var editor = document.getElementById("editor");

			if(viewingHtml) {
				var selection = window.getSelection();
				var at = selection.anchorNode;
				var anchor = document.createElement("anchor-start");
				anchor.textContent = "|";
				at.parentNode.insertBefore(anchor, at);

				var at = selection.focusNode;
				var anchor = document.createElement("anchor-end");
				anchor.textContent = "|";
				at.parentNode.insertBefore(anchor, at);

				unwrapStuffForEditing(editor);

				var html = editor.innerHTML;
				var selStart = html.indexOf("<anchor-start>");
				html = html.replace("<anchor-start>|</anchor-start>", "");
				var selEnd = html.indexOf("<anchor-end>");
				html = html.replace("<anchor-end>|</anchor-end>", "");

				selStart += selection.anchorOffset;
				selEnd += selection.focusOffset;

				textarea.value = html;
				editor.style.display = "none";
				textarea.parentNode.style.display = "block";

				/*
				var range = document.createRange();
				range.setStart(textarea, selStart);
				range.collapse(true);
				selection.removeAllRanges();
				selection.addRange(range);
				*/

				textarea.select();
				textarea.setSelectionRange(selStart, selEnd);
				textarea.focus();
			} else {
				var html = textarea.value;
				editor.innerHTML = html;
				wrapStuffForEditing(editor);
				editor.style.display = "block";
				textarea.parentNode.style.display = "none";
			}

			viewingHtml = !viewingHtml;
		}
	});

	wrapStuffForEditing(document.getElementById("editor"));
};

function unwrapStuffForEditing(parent) {
	parent.querySelectorAll(".hacky-wrapper").forEach(function(e) {
		var c = e.firstChild;
		e.removeChild(c);
		e.parentNode.insertBefore(c, e);
		e.parentNode.removeChild(e);
	});
}

function wrapStuffForEditing(parent) {
	var list = parent.querySelectorAll("input[type=checkbox], input[type=radio], iframe");
	list.forEach(function(e) {
		var wrapper = document.createElement(e.tagName == "IFRAME" ? "div" : "span");
		wrapper.className = "hacky-wrapper";
		if(e.tagName == "IFRAME")
			wrapper.className += " wraps-iframe";
		else
			wrapper.setAttribute("contenteditable", "false");
		if(e.parentNode.classList.contains("hacky-wrapper"))
			return; // don't double wrap
		e.parentNode.insertBefore(wrapper, e);
		e.parentNode.removeChild(e);
		wrapper.appendChild(e);
		e.addEventListener("click", function(event) {
			event.preventDefault();
		});
	});
}

function selectAll(textNode) {
	var range = document.createRange();
	var selection = window.getSelection();
	range.selectNode(textNode);
	selection.removeAllRanges();
	selection.addRange(range);

	document.getElementById("editor").focus();
	updateSelectionData();
}


function insertBox() {
	var box = document.createElement("div");
	var def = bzBoxTypes[1];
	box.className = "bz-box " + def.className;
	var h4 = document.createElement("h4");
	h4.className = "box-title";
	var textNode = document.createTextNode(def.defaultTitle);
	h4.appendChild(textNode);
	box.appendChild(h4);

	var current = window.getSelection().focusNode;
	var original = current;
	while(current && (!current.classList || !current.classList.contains("bz-box")))
		current = current.parentNode;
	if(current == null) {
		current = original;
		while(!current.parentNode.classList.contains("bz-module"))
			current = current.parentNode;
	}
	if(current == null) {
		current = document.querySelectorAll("#editor .bz-module .bz-box");
		if(current.length)
			current = current[current.length -1];
	}
	if(current == null)
		document.querySelector("#editor .bz-module").appendChild(box);
	else
		current.parentNode.insertBefore(box, current.nextSibling);

	h4.scrollIntoView();

	selectAll(textNode);
}

function load(id) {
	EditorApi.load(id).get(function(data) {
		loadObject(data, null);
	});
}

function loadObject(data, branch) {
	var e = document.getElementById('editor');
	e.innerHTML = data.rendered;
	wrapStuffForEditing(e);
	currentlyLoaded.id = data.id;
	currentlyLoaded.fileId = data.fileId;
	currentlyLoaded.branchPoint = data.basedOn;
	currentlyLoaded.branchName = branch;
}

var comparingAnchor = null;
function setCompare(id) {
	if(comparingAnchor) {
		document.getElementById('sidebar').innerHTML = 'Loading comparison...';
		EditorApi.diff(comparingAnchor, id).useToReplace('sidebar');
	}

	comparingAnchor = id;
}

var mergecomparingAnchor = null;
function setMerge(id) {
	if(mergecomparingAnchor) {
		document.getElementById('sidebar').innerHTML = 'Loading merge...';
		EditorApi.merge(mergecomparingAnchor, id).useToReplace('sidebar');
	}

	mergecomparingAnchor = id;
}

function getCurrentEditingHtml() {
	if(viewingHtml) {
		var node = document.getElementById('editor').cloneNode(true);
		unwrapStuffForEditing(node);
		return node.innerHTML;
	} else {
		var textarea = document.querySelector("#view-source textarea");
		return textarea.value;
	}
}

function wrapSelection() {
	if (window.getSelection) {
		var sel = window.getSelection();
		if (sel.rangeCount) {
			var element = document.createElement("span");
			element.className = "bz-has-tooltip";

			var range = sel.getRangeAt(0).cloneRange();
			range.surroundContents(element);

			selectAll(element.firstChild ? element.firstChild : element);

			var sb = document.querySelector("#sidebar dd input");
			if(sb)
				sb.focus();
		}
	}
}

function elementInEditor(ele) {
	while(ele) {
		if(ele.id == "editor")
			return true;
		ele = ele.parentNode;
	}
	return false;
}

function invokeEditorDialog(whichOne, callback) {

	var selection = window.getSelection();
	var currentFocus = selection.focusNode;

	var range = selection.getRangeAt(0);

	if(!elementInEditor(currentFocus)) {
		alert("click a spot in the editor content to put the thing first");
		return;
	}

	var sb = document.getElementById("sidebar");
	sb.innerHTML = document.getElementById(whichOne).innerHTML;

	var f = sb.querySelector("input, textarea");
	if(f)
		f.focus();

	var forms = sb.querySelectorAll("form");
	for(var i = 0; i < forms.length; i++) {
		let form = forms[i];
		form.addEventListener("submit", function(event) {
			var d = new FormData(form);

			d.append("envelopeFormat", "json");
			d.append("format", "json");

			if(!form.classList.contains("nosubmit")) {
				var r = new XMLHttpRequest();
				r.open(form.method, form.action, true);
				r.onload = function(ev) {
					if(r.status == 200) {
						var answer = JSON.parse(r.responseText);

						if(answer.errorMessage.length) {
							sb.textContent = answer.errorMessage;
						} else {
							callback(answer.result, range);
						}
					} else {
						console.log(r.status + ": " + r.responseText);
					}
				};

				r.send(d);
			} else {
				//callback(form.elements);
				var e = {};
				for(var i = 0; i < form.elements.length; i++)
					e[form.elements[i].name] = form.elements[i].value;
				callback(e, range);
			}
			event.preventDefault();
		});
	}
}

function htmlEscape(text) {
	var tn = document.createTextNode(text);
	var p = document.createElement('p');
	p.appendChild(tn);
	return p.innerHTML;
}

function insertUpload(result, range) {
	var code;
	var url = result.url;
	switch(result.contentType) {
		case "application/pdf":
			//code = "<iframe src=\""+url+"\"></iframe>";
			code = "<embed src=\"https://drive.google.com/viewerng/viewer?embedded=true&url="+encodeURIComponent(url)+"\" width=\"500\" height=\"375\">";
			var div = document.createElement("div");
			div.innerHTML = code;
			wrapStuffForEditing(div);
			code = div.innerHTML;
		break;
		case "image/png":
		case "image/jpeg":
			code = "<img src=\""+url+"\" alt=\""+htmlEscape(result.description)+"\" />";
		break;
		default:
			code = "<a href=\""+url+"\">" + url + "</a>";
	}
	insertHTML(code, range);
}

function insertEmbed(result, range) {
	var url = result.url;
	var code = "";

	var videoId;
	var provider;

	var idx = url.indexOf("http");
	if(idx != -1)
		url = url.substr(idx);

	idx = url.indexOf("\"");
	if(idx != -1)
		url = url.substr(0, idx);

	if(url.indexOf("youtu.be/") != -1) {
		idx = url.indexOf("?");
		if(idx != -1)
			url = url.substr(0, idx);
		idx = url.lastIndexOf("/");
		url = url.substr(idx + 1);

		videoId = url;
		provider = "youtube";
	} else if(url.indexOf("youtube.com/embed") != -1) {
		idx = url.indexOf("/embed/");
		if(idx != -1)
			url = url.substr(idx + 7);
		idx = url.lastIndexOf("?");
		if(idx != -1)
			url = url.substr(0, idx);

		videoId = url;
		provider = "youtube";

	} else if(url.indexOf("youtube.com/") != -1) {
		idx = url.indexOf("v=");
		if(idx != -1)
			url = url.substr(idx + 2);
		idx = url.indexOf("&");
		if(idx != -1)
			url = url.substr(0, idx);

		videoId = url;
		provider = "youtube";
	} else if(url.indexOf("vimeo.com") != -1) {
		idx = url.indexOf("?");
		if(idx != -1)
			url = url.substr(0, idx);
		idx = url.lastIndexOf("/");
		url = url.substr(idx + 1);

		videoId = url;
		provider = "vimeo";
	} else {
		alert("Couldn't find valid video url in the content.");
		return;
	}

	if(provider == "youtube")
		url = "https://www.youtube.com/embed/" + videoId + "?rel=0";
	else if(provider == "vimeo")
		url = "https://player.vimeo.com/video/" + videoId;
	else alert("unknown video provider");

	code = '<iframe width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen" allow="encrypted-media" src="'+htmlEscape(url)+'"></iframe>';

	var div = document.createElement("div");
	div.innerHTML = code;
	wrapStuffForEditing(div);

	insertHTML(div.innerHTML, range);
}

function insertHTML(html, rangePassed) {
	var div = document.createElement("div");
	div.innerHTML = html;
	var frag = document.createDocumentFragment();
	while(div.children.length)
		frag.appendChild(div.removeChild(div.firstChild));

	var range;
	if(rangePassed)
		range = rangePassed;
	else
		range = window.getSelection().getRangeAt(0);

	if (range) {
		range.collapse(true);
		range.insertNode(frag);
		/*
		range.setStartAfter(frag);
		range.collapse(true);
		sel.removeAllRanges();
		sel.addRange(range);
		*/
	}
}

function moveToEndOfBox() {
	var selection = window.getSelection();
	var currentFocus = selection.focusNode;
	var oldFocus = currentFocus;

	while(currentFocus && (!currentFocus.classList || !currentFocus.classList.contains("bz-box")))
		currentFocus = currentFocus.parentNode;

	if(!currentFocus)
		return;

	var range = document.createRange();
	range.setStartAfter(currentFocus.lastChild);
	range.setEndAfter(currentFocus.lastChild);
	selection.removeAllRanges();
	selection.addRange(range);

	document.getElementById("editor").focus();
	updateSelectionData();
}

function insertDoneButton() {
	var button = document.createElement("input");
	button.setAttribute("data-bz-retained", uuidv4());
	button.setAttribute("value", "Done");
	button.setAttribute("type", "button");
	button.setAttribute("class", "bz-toggle-all-next");

	var selection = window.getSelection();
	var currentFocus = selection.focusNode;
	var oldFocus = currentFocus;

	while(currentFocus && (!currentFocus.classList || !currentFocus.classList.contains("bz-box")))
		currentFocus = currentFocus.parentNode;

	if(!currentFocus)
		return;

	currentFocus.appendChild(button);

	range.selectNode(button);
	selection.removeAllRanges();
	selection.addRange(range);

	document.getElementById("editor").focus();
	updateSelectionData();

}
