/**
 *  Add your custom beyondz Javascript for the Canvas LMS in this file.
 *  This is configured on the Canvas admin as a Global Javascript include.
 *  See this for more info: https://guides.instructure.com/m/4214/l/41896-how-do-i-add-custom-javascript-and-

css-files-to-my-account
 *
 * */

jQuery( document ).ready(function() {
	//console.log("jQ working");
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
	
	// run this in case js loads first:
	jQuery('#bz-auto-toc').each(function(){bzAutoTOC()});


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
		a.href = item.url ? item.url : ("/courses/" + item.context_id + "/items/" + item.id); 
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
