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
	if(document.querySelector(".user_content")) {
		console.log('running user content now');
		func();
	}
	// and schedule to handle future changes
	$.subscribe("userContent/change", function() {
		console.log('running user content on event');
		func();
	});
}

jQuery( document ).ready(function() {
	console.log("jQ working!");

	runOnUserContent(function() {
		// add script and style from magic divs
		var i;

		// style first just so it is applied before things
		// that block in the user script
		var styles = document.querySelectorAll(".bz-style");
		var styleString = "";
		for(i = 0; i < styles.length; i++) {
			var s = styles[i];
			styleString += s.textContent;
			s.parentNode.removeChild(s);
		}

		var styleElement = document.createElement("style");
		styleElement.textContent = styleString;
		document.body.appendChild(styleElement);

		var scripts = document.querySelectorAll(".bz-script");
		for(i = 0; i < scripts.length; i++) {
			var s = scripts[i];
			try {
				eval(s.textContent);
			} catch(e) {
				console.log("User content script error: " + s);
			}
			s.parentNode.removeChild(s);
		}
	});

	runOnUserContent(function() {
		/* Improve Priorities Quiz */  
		jQuery('.context-course_11 #question_482_question_text ol li, .context-course_15 #question_619_question_text ol li, .context-course_23 #question_1918_question_text ol li, .context-course_25 #question_2260_question_text ol li').prepend('<span class="dynamic"></span>');
		jQuery('.context-course_11 #question_481_question_text input, .context-course_15 #question_618_question_text input, .context-course_23 #question_1917_question_text input, .context-course_25 #question_2259_question_text input').each(function(i){
			jQuery(this).change(function(){
				//console.log('changing big rock');
				var t = jQuery(this).val()+': '; console.log(t);
				jQuery('.context-course_11 #question_482_question_text ol li, .context-course_15 #question_619_question_text ol li, .context-course_23 #question_1918_question_text ol li, .context-course_25 #question_2260_question_text ol li').eq(i).children('.dynamic').text(t);
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
		/* Local Navigation UI enhancements */
		bzLocalNavUI();
		
		// Init local selector (hides/shows content based on user's choice of location
		jQuery('.locale').hide(); 
		jQuery('.locale-chooser').click(function(e){
			e.preventDefault();
			var target = jQuery(this).attr('href');
			jQuery('.locale').hide(1,function(){
				jQuery(target).show();
			});
		});
		
		// Create auto table of contents
		jQuery('#bz-auto-toc').each(function(){bzAutoTOC()});
	
		// Enable jQuery UI tooltips that override browser styling/interaction: 
		jQuery(document).tooltip();
	
		// Add character counting tool to pagemapper
		//jQuery('#page-mapper-container').each(function(){bzPageMapperPageCharCount()}).parents('body').addClass('bz-page-mapper-body');
	
		/* In modules view, add a class to items with "after learning lab" in their titles, so we can style them differently: */
		bzAfterLL();
		
		/* Load rubric criteria into content */
		bzAjaxLoad();
		
		/* Scrape assignment due date and insert it into assignment text: */
		jQuery('.bz-dynamic-due-date').text(function(){
			var dueDateText = jQuery('.student-assignment-overview .date_text').text();
			if (dueDateText) {
				return dueDateText;
			} else {
				return jQuery(this).text();
			}
		})
		
	});

});

runOnUserContent(function() {
  
	/* START NEW UI STUFF: */
	
	// Score a checklist question:
	jQuery('.for-checklist').click(function(){
		var checklist = jQuery(this).attr('data-bz-for-checklist');
		var maxScore = jQuery(checklist).attr('data-bz-max-score');
		var checklistScore = 0;
		var falsePositives = 0;
		jQuery(checklist).children().each(function(){
			if( jQuery(this).children('input').is(':checked') ) {
				jQuery(this).addClass('show-answers').find('.feedback').show();
				if (jQuery(this).is('.correct')) {
					checklistScore++;
				} else {
					falsePositives++;
					jQuery(this).find('.feedback').slideDown();
				}
			} 
			if ( jQuery(this).children('input').not(':checked') ) {
				jQuery(this).addClass('unchecked');
			}
		});
		var finalScore = (checklistScore-falsePositives)/maxScore;
		var feedbackClass = "";
		var answerSpace = jQuery(this).parents('.question').next('.answer');
		var feedback = "You got " + checklistScore + " out of " + maxScore + " right";
		if ( 0 < falsePositives ) {
			feedback += ", but you also got " + falsePositives + " incorrect answer";
			if ( 1 < falsePositives ) {
				feedback += "s";
			}
		}
		feedback += ". ";
		if ( 1 <= finalScore ) {
			feedback += "Perfect!";
			feedbackClass = 'correct';
		} else if ( 1 > finalScore && 0.75 <= finalScore ) {
			feedback += "Very good!";
			feedbackClass = 'correct';
		} else if ( 0 >= finalScore ) {
			feedback = "Oops! " + feedback;
			feedbackClass = 'wrong';
		}
		bzGiveFeedback(feedback, answerSpace, feedbackClass);
	});	

	// Display current value of a range question:
	jQuery ('[data-bz-range-answer]').change(function() {
		var currentVal = jQuery(this).val();
		jQuery(this).parent().find('.current-value').text(currentVal);
	}).change();

	// Score a range question:
	jQuery ('.for-range').click(function() {
		var range = jQuery(this).parents('.question').find('[data-bz-range-answer]');
		var falsePositives = 0;
		var currentVal = jQuery(range ).val();
		var correctVal = jQuery(range ).attr('data-bz-range-answer');
		var min = jQuery(range).attr('min');
		var max = jQuery(range).attr('max');
		var feedback = "";
		var feedbackClass = "";
		// The following calculates the relative distance between the user's choice and the correct answer, and returns a rounded down value between 0 and max score.
		var rangeScore = max - (max * Math.abs(correctVal - currentVal) / (max - min));
		console.log(rangeScore);
		if ( max <= rangeScore) {
			feedback = "Amazing! You got it exactly right!";
			feedbackClass = 'correct';
		} else if ( (0.95*max) <= rangeScore ) {
			feedback = "Very close!";
			feedbackClass = 'correct';
		} else if ( (0.85*max) < rangeScore ) {
			feedback = "Close!";
			feedbackClass = '';
		} else {
			feedback = "Not quite.";
			feedbackClass = 'wrong';
		}
		var answerSpace = jQuery(this).parents('.question').next('.answer');
		bzGiveFeedback(feedback, answerSpace, feedbackClass);
	});

	// Show feedback in an answer following a question:
	function bzGiveFeedback(feedback, answerSpace, feedbackClass) {
		jQuery(answerSpace).addClass(feedbackClass);
		if(jQuery(answerSpace).find('.box-title')){
			jQuery('.box-title').text(feedback);
		} else {
			feedback = '<p class="box-title">'+feedback+'</p>';
			jQuery(this).prepend(feedback);
		}
	}

  // Add checkboxes to multi-checklist lists, and provide feedback when any are checked:
	jQuery('.multi-checklist').find('li').each(function(){
		jQuery(this).wrapInner('<label></label>').prepend('<input type="checkbox" />');
	}).change(function(){
			jQuery(this).find('.feedback').slideToggle();
	});
	
	jQuery('.radio-list').find('input').each(function(){
		jQuery(this).change(function(){
			jQuery(this).closest('li').find('.feedback').slideToggle();
		});
	});
	// Reveal hidden content immediately following a hint button:
	jQuery('.reveal-next').click(function(e){
		e.preventDefault();
		var target = jQuery(this).attr('href');
		jQuery(target).slideToggle();
	});
	
	// Allow users to add a Magic Field text input for "other" answers:
	jQuery('.add-other-field').val('+ Add another text field').click(function(){
		jQuery(this).closest('.add-fields-here').append(function(){
  		var newField = '<p><input type="text" data-bz-retained="blah" /></p>';
	  	return newField;
  	});
	});
	
	// Add share relesse checkbox where applicable:
	jQuery('[data-bz-share-release]').after(function(){
		var shareRelease = '<div class="share-release"><input type="checkbox" checked />I agree to share this with others</div>';
		return shareRelease;
	});
	
	// Show answers based on what's checked:
	jQuery('.selective-feedback').click(function(){
		//var choicesSource = jQuery(this).attr('data-bz-for-checklist');
		//var userChoices = jQuery(choicesSource).find(':checked');
		jQuery(this).parents('.question').next('.answer').find('[data-bz-reference]').each(function(){
			var ref = jQuery(this).attr('data-bz-reference');
			var refCheckbox = jQuery('[data-bz-retained="'+ref+'"]');
			console.log(jQuery(this).parent().html());
			if( jQuery(refCheckbox).is(':checked') ) {
				jQuery(this).show();
			} else {
				jQuery(this).hide();
			}
		});
	});
	
	// 
	jQuery(".selectable-cells td").click(function(){ 
		// console.log('matrix cell clicked '+jQuery(this).text());
		jQuery(this).toggleClass("v-selected"); 
	});
	
	// Allow sorting to match elements in a table (apply .sortable to the row, sorting is done by moving cells sideways:
	jQuery(".sortable").sortable({
    disableSelection: true,
		items : ':not(th):not(.unsortable)'
	});
	
	// Check a user-sorted table and give feedback:
	jQuery('.for-match').click(function(){
		var feedback, feedbackClass;
		var valuesToMatch = jQuery(this).parents('.question').find('.match-to [data-bz-matching]');
		var valuesToTest = jQuery(this).parents('.question').find('.sortable [data-bz-matching]');
		valuesToMatch.each(function(){
			var valueToMatch = jQuery(this).attr('data-bz-matching');
			var matchingValue = jQuery(valuesToTest).find('[data-bz-matching="'+valueToMatch+'"]');
			console.log(matchingValue.parents('li').text());
			
		});
		var answerSpace = jQuery(this).parents('.question').next('.answer');
		bzGiveFeedback(feedback, answerSpace, feedbackClass);
	});
	// Mix up checklists 
	/* TBD */
	
	// Load user-added magic fields if they already have input
	/* TBD */
	
	// Referenced sources numbering:
	/* TBD */
	
	// Automatically generate a navigable table of contents for a h2-level section out of its nested h3 elements
	/* TBD */
	
	
	/* END NEW UI STUFF */
	
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

/* instant survey */

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
	jQuery('#bz-module-nav .has-children').not('#bz-module-nav > li').append('<div class="bz-nav-ui">+</div>');
	jQuery('.bz-nav-ui').addClass(function(){
		// add a class based on whether this is already expanded or collapsed
		if(jQuery(this).siblings('.children').children('li').css('display') == 'none'){
			return 'collapsed';
		} else {
			return 'expanded';
		} 
	}).click(function(e){
		console.log('clicked');
		jQuery(this).toggleClass('expanded collapsed').siblings('.children').children().slideToggle();
	});
	jQuery('#bz-module-nav ul.active-parent').parent().siblings('li').addClass('active-uncles').show();
}

/* Load a rubric criterion (bypassing sanitizer): */
function bzAjaxLoad() {
	jQuery('.bz-ajax-replace').each(function(e){
		var el = jQuery(this);
		var replaceURL = jQuery(this).attr('href');
		if (replaceURL.indexOf('#')){
			var rb = replaceURL.split('#');
			replaceURL = rb[0]+' #'+rb[1];
		}
		if (replaceURL.indexOf('rubric')) {

			console.log('Loading ' + replaceURL + ' into ' + jQuery(this).attr('class'));
			el.replaceWith(jQuery('<table />').load(replaceURL, function() {
				jQuery(this).addClass('bz-ajax-loaded-rubric bz-ajax-loaded');
			}));
			
		}
		
		//jQuery('#wiki_page_show').replaceWith(jQuery('table').load('/courses/10/rubrics/9 #criterion_9_7861'));
		
	}).click(function(e){
		e.preventDefault();
	});
};

// the Canvas built in thing strips scripts out of the editor, but
// leaves it in the ENV. this hack will put it back. The timer is because
// I don't have a good event to use right now.
var scriptHackAlreadyRun = false;
setTimeout(function() {
	if(scriptHackAlreadyRun) return;
	scriptHackAlreadyRun = true;
	var e = document.getElementById('wiki_page_body');
	if(e && ENV && ENV["WIKI_PAGE"] && ENV["WIKI_PAGE"]["body"])
		e.value = ENV["WIKI_PAGE"]["body"];
}, 1000);


// try hiding the assignment link a bit sooner so the button doesn't
// flash as long.
runOnUserContent(function() { $("#assignment_show:has(input[data-bz-retained]) .submit_assignment_link").hide(); });


/* Display disaggregated assignment scores by criteria section */
function bzDisagScoresForCopying() {
	var scoresClass = 'bz-score-totals-for-copying';
	var copyableScores = '<table class="'+scoresClass+'"><caption>Copy these into the tracker:</caption><tbody><tr>';
	var sectionScores = {};
	jQuery('.rubric_summary .rubric_table .criterion').not('.blank').each(function(){
		var desc = jQuery(this).find('.criterion_description .description_title').html();
		var section = desc.substring(0,desc.indexOf("."));
		var val = jQuery(this).find('.criterion_points').text();
		var outOf = jQuery(this).find('.criterion_points_possible').text();
		if (jQuery.isEmptyObject(sectionScores[section]) || sectionScores[section] == "undefined") {
			// set up an object to contain actual score and max score:
			sectionScores[section] = {v:0,o:0};
		}
		sectionScores[section]['v'] += Number(val);
		sectionScores[section]['o'] += Number(outOf);
	});
	
	for (var key in sectionScores) {
		// skip loop if the property is from prototype
		if (!sectionScores.hasOwnProperty(key)) continue;
		var obj = sectionScores[key];
		if (!isNaN(obj.v) && !isNaN(obj.o)) {
			var score = (obj.v/obj.o)*100;
			copyableScores += '<td>' + String(score) + '%</td>';
		}
	}
	copyableScores += '</tr></tbody></table>';
	jQuery('.'+scoresClass).remove();
	jQuery('.rubric_summary tr.summary td').append(copyableScores);
	console.log(copyableScores);
}

window.onSpeedGraderLoaded = bzDisagScoresForCopying;

function collectStuffAfterBox(button) {
  /*
    It needs to hide the parent box and everything after
    it in the entire page. A page looks like this

    <div class="show-content">
      <div wrappers>
        <div class="bz-box">
          // stuff
          <button here>
        </div>
        // more stuff - should be hidden (1)
      </div>
      // more stuff - should be hidden (2)
    </div>
  */

  var box = button;
  while(!box.classList.contains('bz-box')) {
    box = box.parentNode;
  }

  var after = [];
  while(!box.classList.contains('show-content')) {
    var next = box.nextElementSibling;
    while(next) {
      after.push(next);
      next = next.nextElementSibling;
    }
    box = box.parentNode;
  }

  return after;
}

runOnUserContent(function(){
  function unhideNext(obj) {
    var n = collectStuffAfterBox(obj);
    for(var i = 0; i < n.length; i++) {
      $(n[i]).slideDown();
      if(n[i].querySelector(".bz-toggle-all-next"))
        break;
    }
  }

  var first = document.querySelector(".bz-toggle-all-next");
  var list = collectStuffAfterBox(first);
  for(var i = 0; i < list.length; i++)
    $(list[i]).hide();

  jQuery('.bz-toggle-all-next').click(function(e){
    unhideNext(this);
  }).parents('.bz-box').addClass('bz-has-toggle-btn');
});
