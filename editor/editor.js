// note that .classList is null on text nodes...
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

function getIfPresent(list, options) {
	for(var i = 0; i < options.length; i++)
		if(list.contains(options[i]))
			return options[i];
	return "";
}

function getSidebarBox(ele) {
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
				if(isDefault)
					header.textContent = opt.defaultTitle;
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

		return div;
	} else if(ele.tagName == "LI" && (isChecklist(ele.parentNode) || isRadioList(ele.parentNode))) {
		var div = document.createElement("div");
		var h3 = document.createElement("h3");
		h3.textContent = isChecklist(ele.parentNode) ? "Checklist Item" : "Radio List Item";
		div.appendChild(h3);
		div.appendChild(makeSelect("Correctness:", function(opt) {
			ele.className = opt;
		}, ["", "correct", "incorrect", "maybe"], ele.className));
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
		return div;

	}
	return null;
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
	labelElement.appendChild(document.createTextNode(label + " "));
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
	while(current) {
		var editorElement = getSidebarBox(current);
		if(editorElement)
			sidebar.appendChild(editorElement);
		current = current.parentNode;
		if(!current || (current.classList && current.classList.contains("bz-module")))
			break;
	}

	showingSidebarFor = ele;
}

function insertChecklistBox(f) {
	if(!f.querySelector("input[type=checkbpx]")) {
		var i = document.createElement("input");
		i.setAttribute("type", "checkbox");
		i.setAttribute("data-bz-retained", "REPLACE_ME");
		f.insertBefore(i, f.firstChild);
	}
}

function updateSelectionData() {
	var f = window.getSelection().focusNode;
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

window.onload = function() {
	document.execCommand("enableObjectResizing", false, false);
	document.execCommand("styleWithCSS", false, false);

	document.onselectionchange = updateSelectionData;
	document.getElementById("editor").addEventListener("click", function(event) {
		/*
		var selection = window.getSelection();
		var at = selection.focusNode;
		*/
		var at = event.target;

		var sidebar = document.getElementById("sidebar");
		//sidebar.innerHTML = "";

		var dl = document.createElement("dl");
		sidebar.appendChild(dl);

		if(event.target.getAttribute("data-bz-retained")) {
			var dt = document.createElement("dt");
			if(event.target.classList.contains("bz-optional-magic-field"))
				dt.textContent = "Optional Magic Field Name"
			else
				dt.textContent = "Magic Field Name";
			dl.appendChild(dt);
			var dd = document.createElement("dd");
			dd.textContent = event.target.getAttribute("data-bz-retained");
			dl.appendChild(dd);
		}

		if(event.target.classList.contains("bz-has-tooltip")) {
			var dt = document.createElement("dt");
			dt.textContent = "Tooltip";
			dl.appendChild(dt);
			var dd = document.createElement("dd");
			dd.textContent = event.target.getAttribute("title");
			dl.appendChild(dd);
		}

		if(event.target.tagName == "A" && event.target.href) {
			var dt = document.createElement("dt");
			dt.textContent = "Links To";
			dl.appendChild(dt);
			var dd = document.createElement("dd");
			dd.textContent = event.target.getAttribute("href");
			dl.appendChild(dd);
		}

		if(event.target.tagName == "IMG") {
			var dt = document.createElement("dt");
			dt.textContent = "Image Source";
			dl.appendChild(dt);
			var dd = document.createElement("dd");
			dd.textContent = event.target.getAttribute("src");
			dl.appendChild(dd);

			var dt = document.createElement("dt");
			dt.textContent = "Alt Text";
			dl.appendChild(dt);
			var dd = document.createElement("dd");
			dd.textContent = event.target.getAttribute("alt");
			dl.appendChild(dd);
		}



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
			if(at.getAttribute("id") == "editor")
				break;
		}
	});

	var viewingHtml = true;
	document.addEventListener("keydown", function(event) {
		var key = event.keyCode || event.which;
		if(key == 13 && event.shiftKey) {
			//event.preventDefault();
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
	var list = parent.querySelectorAll("input[type=checkbox], input[type=radio]");
	list.forEach(function(e) {
		var wrapper = document.createElement("span");
		wrapper.className = "hacky-wrapper";
		wrapper.setAttribute("contenteditable", "false");
		e.parentNode.insertBefore(wrapper, e);
		e.parentNode.removeChild(e);
		wrapper.appendChild(e);
		e.addEventListener("click", function(event) {
			event.preventDefault();
		});
	});
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
	while(current && (!current.classList || !current.classList.contains("bz-box")))
		current = current.parentNode;
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

	var range = document.createRange();
	var selection = window.getSelection();
	range.selectNode(textNode);
	selection.removeAllRanges();
	selection.addRange(range);

	document.getElementById("editor").focus();
	updateSelectionData();
}

