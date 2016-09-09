/**
 *  Add your custom beyondz Javascript for the Canvas LMS in this file.
 *  This is configured on the Canvas admin as a Global Javascript include.
 *  See this for more info: https://guides.instructure.com/m/4214/l/41896-how-do-i-add-custom-javascript-and-

css-files-to-my-account
 *
 * */


/*
	Use this like document.ready to call a function when user
	content is loaded. Since wiki pages load after document.ready,
	you can't use it directly.

	You may call this from inside scripts on wiki pages, it will handle
	both cases well.
*/
function runOnUserContent(func) {
	// if it is already there, run it now
	if(document.querySelector(".user_content"))
		func();
	// and schedule to handle future changes
	$.subscribe("userContent/change", function() { func(); });
}

jQuery( document ).ready(function() {
	console.log("jQ working");

	runOnUserContent(function() {
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
	});
		

	// run this in case js loads first:
	jQuery('#bz-auto-toc').each(function(){bzAutoTOC()});

	// enable jQuery UI tooltips that override browser styling/interaction: 
	jQuery(document).tooltip();

	// Add character counting tool to pagemapper
	jQuery('#page-mapper-container').each(function(){bzPageMapperPageCharCount()}).parents('body').addClass('bz-page-mapper-body');

	/* In modules view, add a class to items with "after learning lab" in their titles, so we can style them differently: */
	bzAfterLL();
	
	/* Add some interactivity to local modules nav UI: */
	bzLocalNavUI();
	
});


// this is the entry point of the table of contents - it will queue up a handler on
// the event to handle it when it comes in. Actual impl in bzAutoTOCImpl
function bzAutoTOC() {
	bzAutoTOCImpl(); // call now in case it is already there
	$.subscribe("userContent/change", function() { bzAutoTOCImpl(); }); // and schedule a call in the future
}

// this is the actual implementation of the auto table of contents
function bzAutoTOCImpl() { 
	var toc = document.getElementById("bz-auto-toc"); 
	if(toc == null) return; 

	if(toc.className == "bz-already-loaded")
		return;

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
	toc.className = "bz-already-loaded";
} 


function bzAfterLL(){
	jQuery('#context_modules .context_module_item').each(function(){
		if( jQuery(this).text().toLowerCase().indexOf("after learning lab") > -1 || jQuery(this).text().toLowerCase().indexOf("take a break") > -1) {
			jQuery(this).addClass('bz-mid-module-break');
		}
	});
}
function bzPageMapperPageCharCount() {
	// Counts characters on pagemapper pages, and displays other interesting stats.
	var pageLengths = [];
	var pageTotal = 0;
	jQuery('.page-mapper-page').each(function(){
		var pageLength = jQuery(this).text().length;
		pageLengths.push(pageLength);
		pageTotal += pageLength;
		jQuery(this).attr('charcount', pageLength);
		jQuery(this).append('<div class="bz-pm-pl">'+pageLength+'</div>');
	});
	var maxLength = Math.max.apply(Math,pageLengths);
	var avgLength = pageTotal/pageLengths.length;
	jQuery('.bz-pm-pl').each(function(){
		var pageLength = jQuery(this).parent().text().length;
		jQuery(this).css('background', 'rgba(255,0,0,'+((pageLength/avgLength)-1)+')').attr({
			// using *100 below because we want it displayed as percentage)
			deltaavg: Math.floor(pageLength/avgLength * 100),
			deltamax: maxLength-pageLength
		}); 
	});
}
function bzLocalNavUI() {
	jQuery('#bz-module-nav > li > ul > li:not(.active-parent) > ul li').parent('ul').addClass('non-active-list collapsed').hide().find('li').show();
	jQuery('#bz-module-nav .non-active-list').siblings('a').click(function(e){
		e.preventDefault();
		// traversing to siblings because $(this) is the clickable <a> element.  
		// Using .css('display') because is(':visible') didn't work consistently.
		if($(this).siblings('.non-active-list').css('display') != 'none') {
			$(this).siblings('.non-active-list').toggleClass('expanded collapsed').slideUp();
		} else {
			$(this).siblings('.non-active-list').toggleClass('expanded collapsed').slideDown();
		}
	});
}