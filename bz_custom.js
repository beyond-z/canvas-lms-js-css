/**
 *  Add your custom beyondz Javascript for the Canvas LMS in this file.
 *  This is configured on the Canvas admin as a Global Javascript include.
 *  See this for more info: https://guides.instructure.com/m/4214/l/41896-how-do-i-add-custom-javascript-and-css-files-to-my-account
 *
 * */
 
 //testing js:
 //console.log("js working");
 
 //testing jquery
$.noConflict();
jQuery( document ).ready(function( $ ) {
	//console.log("jQ working");
	
	/* Improve Priorities Quiz for staging (question IDs are different for prod) */
	/*$('.context-course_11 #question_389_question_text ol li').prepend('<span class="dynamic"></span>');
	$('.context-course_11 #question_434_question_text input').each(function(i){
		$(this).change(function(){
			var t = $(this).val()+': '; console.log(t);
			$('.context-course_11 #question_389_question_text ol li').eq(i).children('.dynamic').text(t);
			//
		});
	});*/
	
	/* Improve Priorities Quiz for prod   */
	$('.context-course_11 #question_482_question_text ol li').prepend('<span class="dynamic"></span>');
	$('.context-course_11 #question_481_question_text input').each(function(i){
		$(this).change(function(){
			var t = $(this).val()+': '; console.log(t);
			$('.context-course_11 #question_482_question_text ol li').eq(i).children('.dynamic').text(t);
			//
		});
	});

}); jQuery


/**/
