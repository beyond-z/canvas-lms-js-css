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
/* Automatic Table of Contents for module section partitions: */
function bzAutoTOC(){
	console.log('running auto TOC');
	jQuery('#bz-auto-toc').load('/courses/'+window.location.pathname.split('/')[2]+'/modules #context_modules', function(responseTxt, statusTxt, xhr){
	        if(statusTxt == "success" || statusTxt == "notmodified") {
				jQuery('a[title="'+jQuery('h1.page-title').text()+'"]').addClass('bz-toc-current').parents('li.context_module_item.wiki_page').addClass('bz-toc-current-wrapper').parents('div.context_module').siblings().remove();
				bzAfterLL();
	          	//jQuery('#bz-auto-toc a').click(function(e){e.preventDefault();return;});
	        }
	        if(statusTxt == "error") {
	        	console.log("Error: " + xhr.status + ": " + xhr.statusText);
		}
	});
}	
function bzAfterLL(){
	jQuery('#context_modules .context_module_item').each(function(){
		if( jQuery(this).text().toLowerCase().indexOf("after learning lab") > -1) {
			jQuery(this).addClass('bz-after-ll');
		}
	});
}