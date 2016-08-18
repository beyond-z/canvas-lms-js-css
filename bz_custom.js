/**
 *  Add your custom beyondz Javascript for the Canvas LMS in this file.
 *  This is configured on the Canvas admin as a Global Javascript include.
 *  See this for more info: https://guides.instructure.com/m/4214/l/41896-how-do-i-add-custom-javascript-and-

css-files-to-my-account
 *
 * */

jQuery( document ).ready(function() {
	console.log("jQ working");
	/* Improve Priorities Quiz */  
	jQuery('.context-course_11 #question_482_question_text ol li, .context-course_15 #question_619_question_text ol li').prepend('<span class="dynamic"></span>');
	jQuery('.context-course_11 #question_481_question_text input, .context-course_15 #question_618_question_text input').each(function(i){
		jQuery(this).change(function(){
			//console.log('changing big rock');
			var t = jQuery(this).val()+': '; console.log(t);
			jQuery('.context-course_11 #question_482_question_text ol li, .context-course_15 #question_619_question_text ol li').eq(i).children('.dynamic').text(t);
		});
	});
	/**/
	/* Improve SMART Goals quiz: */
	jQuery('#bz-smart-quiz input').css('width', '95%');
	/**/	
	/* In modules view, add a class to items with "after learning lab" in their titles, so we can style them differently: */
	bzAfterLL();

	/* Quick Quiz functionality: */
	
	jQuery('.bz-quick-quiz input[type=radio]').change(function() {
		console.log(this.value);
		if (this.value == "correct") {
			jQuery(this).parents('ul').children('li').removeClass('fail');
			jQuery(this).parents('li').addClass('success');
		} else {
			jQuery(this).parents('ul').children('li').removeClass('fail, success');
			jQuery(this).parents('li').addClass('fail');
		}
	});
	

	// run this in case js loads first:
	jQuery('#bz-auto-toc').each(function(){bzAutoTOC()});

	// enable jQuery UI tooltips that override browser styling/interaction: 
	jQuery( '.has-tooltip' ).tooltip();


});

function bzAutoTOC() { 
	var toc = document.getElementById("bz-auto-toc"); 
	if(toc == null) return; 
	var data = ENV["module_listing_data"]; 
	if(data == null) return; 
	var mid = location.search; 
	if(mid && mid.length) { 
		mid = mid.substring(1); 
		var parts = mid.split("&"); 
		for(var i = 0; i < parts.length; i++) { 
			var idx = parts[i].indexOf("="); 
			if(idx == -1) 
				idx = parts[i].length; 
			var name = parts[i].substring(0, idx); 
			if(name == "module_item_id") { 
				mid = parts[i].substring(idx + 1)|0; 
				break; 
			} 
		} 
	} 
	toc.innerHTML = ""; 
	var ol = document.createElement("ol"); 
	for(var i = 0; i < data.length; i++) { 
		var item = data[i].content_tag; 
		if(item.indent > 0) 
			continue; 
		var li = document.createElement("li"); 
		if(mid == item.id) 
			li.className = "bz-toc-current"; 
		var a = document.createElement("a"); 
		a.textContent = item.title; 
		a.href = item.url ? item.url : ("/courses/" + item.context_id + "/modules/items/" + item.id); 
		li.appendChild(a); 
		ol.appendChild(li); 
	} 
	toc.appendChild(ol); 
} 


function bzAfterLL(){
	jQuery('#context_modules .context_module_item').each(function(){
		if( jQuery(this).text().toLowerCase().indexOf("after learning lab") > -1 || jQuery(this).text().toLowerCase().indexOf("take a break") > -1) {
			jQuery(this).addClass('bz-mid-module-break');
		}
	});
}



function checkInstantSurvey() {
	var f = document.getElementById("instant-survey");
	if(!f)
		return true;

	// if we ever want to make the survey *required*, we can
	// change this return to do false if it isn't filled in.
	//
	// but for now, next is visually discouraged, but not actually
	// disabled per the mock.
	return true;
}

function bzActivateInstantSurvey(magic_field_name) {
	// adjust styles of the container to make room  (see CSS)
	var msf = document.querySelector(".module-sequence-footer");
	msf.className += ' has-instant-survey';

	// discourage clicking of next without answering first...
	var nb = document.querySelector(".bz-next-button");
	var originalNextButtonClass = nb.className;
	nb.className += ' discouraged';

	// move the survey from the hidden body to the visible footer
        var i = document.getElementById("instant-survey");
        if(i) {
          var h = document.getElementById("instant-survey-holder");
          h.innerHTML = "";
          h.appendChild(i.parentNode.removeChild(i));
        }

	// react to survey click - save and encourage hitting the next button.

	var save = function(value) {
		var http = new XMLHttpRequest();
		http.open("POST", "/bz/user_retained_data", true);
		var data = "name=" + encodeURIComponent(magic_field_name) + "&value=" + encodeURIComponent(value);
		http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		// encourage next clicking again once they are saved
		http.onload = function() {
			nb.className = originalNextButtonClass;
          		var h = document.getElementById("instant-survey-holder");
			$(h).hide("slow");
		};

		http.send(data);
	};

	var inputs = i.querySelectorAll("input");
	for(var a = 0; a < inputs.length; a++) {
		inputs[a].onchange = function() {
			save(this.value);
		};
	}
}

function bzInitializeInstantSurvey() {
	// only valid on wiki pages
	if(ENV == null || ENV["WIKI_PAGE"] == null || ENV["WIKI_PAGE"].page_id == null)
		return;

	// our key in the user magic field data where responses are stored
	var name = "instant-survey-" + ENV["WIKI_PAGE"].page_id;

	// load the value first. If it is already set, no need to show -
	// instant survey is supposed to only be done once.

	var http = new XMLHttpRequest();
	// cut off json p stuff
	http.onload = function() {
		var value = http.responseText.substring(9);
		if(value == null || value == "")
			bzActivateInstantSurvey(name);
	};
	http.open("GET", "/bz/user_retained_data?name=" + encodeURIComponent(name), true);
	http.send();

}
