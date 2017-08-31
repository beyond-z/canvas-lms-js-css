/**
 *  Add your custom beyondz Javascript for the Canvas LMS in this file.
 *  This is configured on the Canvas admin as a Global Javascript include.
 *  See this for more info: https://guides.instructure.com/m/4214/l/41896-how-do-i-add-custom-javascript-and-

css-files-to-my-account
 *
 * */

/*
  For stuff that depends on the magic field value, use:
  addOnMagicFieldsLoaded(function() {
    // stuff here
  });
*/


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
        var t = jQuery(this).val()+': '; 
        console.log(t);
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
    
    /* Load load any dynamic content, such as rubric criteria or LinkedIn API return URLs */
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


// Show feedback in an answer following a question:
function bzGiveVerboseFeedback(feedback, answerSpace, feedbackClass) {
  jQuery(answerSpace).addClass(feedbackClass).find('.box-title').text(feedback);
}

/*
    For the new UI stuff, if it is an on-click handler for a next button, put it
    on this object instead of direct via event handlers. This allows me to process it
    independently of other click activities when showing the reloaded page.

    The syntax is:

    'some_selector' : function() {
      // handler
    },

    The `this` variable will be assigned for an event handler (it will be the element, NOT
    the bzNewUiHandlers object).

    Note that the selector must be a legal CSS selector according to standard and browser
    implementation reality. So you can use like :not(xxx) but not :has (standard, but not
    implemented), or other jquery extensions here. Basically KISS to be safe.


    For other stuff like change events, set them up below in the bzInitializeNewUi function.
*/
var bzNewUiHandlers = {  
  // Score a checklist question:
  '.for-checklist' : function(){
    var checklist = jQuery(this).parents('.question').find('.checklist');
    var maxScore = checklist.find('.correct').length;
    var checklistScore = 0;
    var falsePositives = 0;
    checklist.children().each(function(){
      jQuery(this).addClass('show-answers')
      if( jQuery(this).children('input').is(':checked') ) {
        jQuery(this).addClass('checked')
        if ( jQuery(this).is('.correct') || jQuery(this).parents('li').is('.correct') ) {
          checklistScore++;
        } else {
          falsePositives++;
        }
      } 
    });
    var finalScore = (checklistScore-falsePositives)/maxScore;
    var feedbackClass = "";
    var answerSpace = checklist.parents('.question').next('.answer');
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
      feedbackClass = 'incorrect';
    }
    bzGiveVerboseFeedback(feedback, answerSpace, feedbackClass);
  },

  // Score a radio-list question and return feedback:
  '.for-radio-list' : function(){
    var list = jQuery(this).parents('.question').find('.radio-list');
    var feedback = "";
    var feedbackClass = "";
    var answerSpace = list.parents('.question').next('.answer');
    list.children().each(function(){
      jQuery(this).addClass('show-answers');
      if( jQuery(this).children('input').is(':checked') ) {
        jQuery(this).addClass('checked')
        if ( jQuery(this).is('.correct') || jQuery(this).parents('li').is('.correct') ) {
          feedback = "Good job!";
          feedbackClass = 'correct';
        } else {
          feedback = "Oops!";
          feedbackClass = 'incorrect';
        }
      } 
    });
    bzGiveVerboseFeedback(feedback, answerSpace, feedbackClass);    
  },

  // Score a range question:
  '.for-range' : function() {
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
      feedbackClass = 'incorrect';
    }
    var answerSpace = jQuery(this).parents('.question').next('.answer');
    bzGiveVerboseFeedback(feedback, answerSpace, feedbackClass);
  },

  // Show feedback on sort-to-match questions:
  '.for-match' : function(){
    jQuery(this).parents('.bz-box').find('.sort-to-match').addClass('show-answers');
  },
};

function matchesSelector(element, selector) {
    if(element.matches)
        return element.matches(selector);
    else {
        var all = document.querySelectorAll(selector);
        for(var i = 0; i < all.length; i++)
            if(all[i] == element)
                return true;
        return false;
    }
}

function triggerBzNewUiHandler(element) {
    for(var i in bzNewUiHandlers) {
        if(bzNewUiHandlers.hasOwnProperty(i)) {
            if(matchesSelector(element, i)) {
                bzNewUiHandlers[i].apply(element);
            }
        }
    }
}

function bzInitializeNewUi() {
    // FIXME

  // Display current value of a range question:
  jQuery ('[type="range"]').change(function() {
    var currentVal = jQuery(this).val();
    jQuery(this).parents('.question').find('.display-value .current-value').text(currentVal);
    jQuery(this).parents('td').siblings('.current-value').text(currentVal);
  }).change();

  // Provide instant feedback when any input on a list is checked:
  jQuery('.instant-feedback').find('input').change(function(){
    if ( jQuery(this).is('[type="radio"]') || jQuery(this).is('[type="checkbox"]') ) {
      if(this.checked) {
        var liParent = jQuery(this).parents('li, td').addClass('show-answers');
        if ( jQuery(this).is('[type="radio"]') ) {
          liParent.siblings().removeClass('show-answers');
        }
      } else {
        jQuery(this).parents('li, td').removeClass('show-answers');
      }
    } else {
      var liParent = jQuery(this).parents('li, td').addClass('show-answers');
    }
  });

  // Reveal hidden content immediately following a hint button:
  jQuery('.reveal-next').click(function(){
    jQuery(this).parent().next().slideToggle();
  });
  
  // Check/uncheck boxes by clicking surrounding table cell
	/* Disabling this for now. Interferes with magic checkboxes.
  jQuery(".selectable-cells td").click(function(){ 
    jQuery(this).toggleClass('inner-checked').find('input').each(function(){
      // toggle the input inside the cell:
      jQuery(this).prop('checked', !jQuery(this).prop('checked')); 
    });
  });
  */
 
  // Mix up checklists:
  jQuery('.checklist, .radio-list').not('.dont-mix').each(function(){
    var itemsToMix = jQuery(this).children();
    for (var i = itemsToMix.length; i >= 0; i--) {
      jQuery(this).append(itemsToMix[Math.random() * i | 0]);
    }
  });
  
  // Instant feedback when sliding range input about "how are you feeling":
  jQuery('[data-bz-range-flr]').each(function() {
    var feedback = jQuery(this);
    var fbFlr = jQuery(this).data('bz-range-flr');
    var fbClg = jQuery(this).data('bz-range-clg');
    // Listen to changes in the associated input and toggle display as needed:
    feedback.parents('tr').prev().find('input').change(function(){
      var rangeValue = jQuery(this).val();
      if ( fbFlr < rangeValue && rangeValue <= fbClg ) {
        feedback.slideDown().siblings().slideUp();          
      }
    });
  });

}

runOnUserContent(function() {
  
  /* START NEW UI STUFF: */

  bzInitializeNewUi();

  // Referenced sources numbering:
  /* TBD */
  
  // Automatically generate a navigable table of contents for the top level out of h2 elements, 
  // and a h2-level section out of its nested h3 elements
  jQuery('.bz-module').prepend(function(){
    var tocBox = jQuery('<div class="main-toc"><p class="match-heading-style">The big picture:</p></div>');
    var mainToc = jQuery('<ol></ol>');
    var mainHasKids = false;
    // this level will gather h2 headings into a table of contents:
    jQuery('.bz-module h2').each(function(){
      mainHasKids = true;
      // this level generates tables of contents under each h2:
      var innerToc = '<ol class="inner-toc">';
      var innerHasKids = false;
      var nextLevelDown = jQuery(this).nextUntil('h2');
      nextLevelDown.each(function(){
        var current = jQuery(this);
        if (current.is('h3')) {
          innerHasKids = true;
          innerToc += '<li>' + current.text() + '</li>';
        }
      });
      var mainListObj = jQuery('<li>' + jQuery(this).text() + '</li>');

      if (innerHasKids) {
        jQuery(this).after(innerToc);
        mainListObj.append(innerToc);
      }

       mainToc.append(mainListObj);
      
    });
    tocBox.append(mainToc);
    if (mainHasKids) return tocBox;
  });

  // Create years 
  jQuery('[data-bz-insert-offset-year]').each(function(){
    var offset = +(jQuery(this).attr('data-bz-insert-offset-year'));
    if( jQuery(this).is('input') && ( '' === jQuery(this).val() ) ){
      jQuery(this).attr('placeholder', function(){
        return (new Date().getFullYear()+offset);
      });
    } else {
      jQuery(this).text(function(){
        return (new Date().getFullYear()+offset);
      });
    }
  });
  
  // Automatically check the "other" box if text input or textarea is filled, uncheck if cleared:
  jQuery('.checklist-other').bind("keyup blur", function(e) {
    jQuery(this).siblings('[type="checkbox"], [type="radio"]').prop('checked', ( ( jQuery(this).val() ) ? true : false ) );
  }).parent('p').addClass('bz-has-other');
  
  // Create a button to toggle transcripts for videos
  jQuery('.transcript').hide().before(function(){
    var transcript = jQuery(this);
    var btn = '<span class="toggle-transcript">Transcript<span>';
    return jQuery(btn).click(function(){
      transcript.slideToggle();
    });;
  });
  
  // Show parent only if the child's bz-retained is populated:
  jQuery('.conditional-show-source').find('input').each(function(){ 
    // init when the page loads:
    showIfMagicIsPopulated(jQuery(this));
  }).change(function(){
    // keep updating if user makes changes:
    showIfMagicIsPopulated(jQuery(this));
  });

  function showIfMagicIsPopulated(magicInput) {
    addOnMagicFieldsLoaded(function() {
      jQuery('.conditional-show [data-bz-retained='+magicInput.data('bz-retained')+'], [data-bz-reference="'+magicInput.data('bz-retained')+'"]').each(function(){
        if( magicInput.prop('checked') || ( !magicInput.is('[type="checkbox"], [type="radio"]') && magicInput.val() != "" ) ) {
          // If it's a checkbox that's checked, or if it's any other type of field that's not empty:
          jQuery(this).parents('.conditional-show').show();
        } else {
          // if it's unckecked or empty, hide the whole row:        
          jQuery(this).parents('.conditional-show').hide();
        }
      });
    });
  }


	// Add "back to top" widget:
	setupBTT();
	function setupBTT() {
		// Create a button to allow scrolling up in one click:
		var btt= jQuery('<div id="bz-back-to-top" class="match-heading-style">Back to top</div>').click(function(){
			jQuery('body').scrollTop(0);
		});
		jQuery('.bz-module').append(btt);

		// Hide the button until you've scrolled down a bit:
		$(window).scroll( function(){
			if ( $(this).scrollTop() > 1080 ) {
				$('#bz-back-to-top').fadeIn();
			} else {
				$('#bz-back-to-top').fadeOut();
			}		
		});

		
	}
	

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

/* Ajax Load dynamic content, like rubric criterion (bypassing sanitizer) and LinkedIn API URLs */
function bzAjaxLoad() {
  jQuery('.bz-ajax-replace').each(function(e){
    var el = jQuery(this);
    var replaceURL = jQuery(this).attr('href');
    if (replaceURL.indexOf('rubric') >= 0){

      // This will replace elements like this with a <table> holding that part of the rubric:
      // <a class="bz-ajax-replace" href="/courses/1/rubrics/55#criterion_43_153" target="_blank">Click to open 4.8.</a>
      if (replaceURL.indexOf('#')){
        var rb = replaceURL.split('#');
        replaceURL = rb[0]+' #'+rb[1];
      }
      console.log('Loading ' + replaceURL + ' into ' + jQuery(this).attr('class'));
      el.replaceWith(jQuery('<table />').load(replaceURL, function() {
        jQuery(this).addClass('bz-ajax-loaded-rubric bz-ajax-loaded');
      }));
      //jQuery('#wiki_page_show').replaceWith(jQuery('table').load('/courses/10/rubrics/9 #criterion_9_7861'));

      jQuery(this).click(function(e){
        e.preventDefault();
      });
    }
    else if (replaceURL.indexOf('service=linked_in') >= 0){

      // This will replace the RETURN_TO_TOKEN with the current URLin an element like this:
      // <a class="bj-ajax-replace btn btn-primary"
      //    href="/oauth?service=linked_in&amp;return_to=RETURN_TO_TOKEN">
      //   Authorize
      // </a>
      var currentPath = window.location.href;
      if (ENV["WIKI_PAGE"] || ENV["ASSIGNMENT_ID"]){
        this.href = replaceURL.replace(/RETURN_TO_TOKEN/, encodeURIComponent(currentPath));
        console.log('Dynamically replaced RETURN_TO_TOKEN in this LinkedIn Authorize button URL: ' + replaceURL + ' with: ' + this.href);
      } else {
        console.log('LinkedIn API authorization only works on assignments and wiki pages.  Returning.');
        return;
      }
      jQuery(this).removeClass('bz-ajax-replace');
      jQuery(this).addClass('bz-ajax-loaded-linkedin bz-ajax-loaded');
    }
    else if (replaceURL.indexOf('LOCAL_COURSE_ID_TOKEN')){

      // This will replace the LOCAL_COURSE_ID_TOKEN added by the server for links from one
      // page or assignment to another in things that are cloned from the Content Library
      if (ENV["WIKI_PAGE"] || ENV["ASSIGNMENT_ID"]){
        var course_id = ENV["COURSE_ID"];
        this.href = replaceURL.replace(/LOCAL_COURSE_ID_TOKEN/, course_id);
        var dataApiEndpointReplace = jQuery(this).attr('data-api-endpoint');
        if (dataApiEndpointReplace){
          jQuery(this).attr('data-api-endpoint', dataApiEndpointReplace.replace(/LOCAL_COURSE_ID_TOKEN/, course_id));
        }
        console.log('Fixed the following link to point to the local course: ' + this.href);
      } else {
        console.log('Fixing up Content Library links only works for pages and assignments. Returning.');
        return;
      }
      jQuery(this).removeClass('bz-ajax-replace');
      jQuery(this).addClass('bz-ajax-loaded-content-lib-link bz-ajax-loaded');
    }
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

  if(button == null)
    return [];

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

if (!String.prototype.startsWith) {
    String.prototype.startsWith = function(searchString, position){
      return this.substr(position || 0, searchString.length) === searchString;
  };
}

function collectBoxesBeforeBox(button) {
  /*
  	Everything up to the box containing the current button.
  */

  if(button == null)
    return [];

  var box = button;
  while(!box.classList.contains('bz-box')) {
    box = box.parentNode;
  }

  var after = [];
  while(!box.classList.contains('show-content')) {
    var next = box;
    next = next.previousElementSibling;
    while(next) {
      after.push(next);
      next = next.previousElementSibling;
    }
    box = box.parentNode;
  }

  return after;
}


// call this BEFORE the function that hides
// bz-boxes, but after everything else is loaded!
function createBzProgressBar() {
  var input = document.createElement("progress");
  input.setAttribute("max", "100");
  input.setAttribute("id", "bz-progress-bar");
  document.body.appendChild(input);

  var height = document.body.scrollHeight;

  var ticking = false;

  window.addEventListener('scroll', function(e) {
    last_known_scroll_position = window.scrollY;
    if (!ticking) {
      window.requestAnimationFrame(function() {
        var pos = last_known_scroll_position + window.innerHeight;
        input.value = Math.ceil(pos / height * 100);
        ticking = false;
      });
    }
    ticking = true;
  });

  input.value = Math.ceil((window.scrollY + window.innerHeight) / height * 100);
}


// Logic to unlock all content that has already been unlocked on this Wiki Page and 
// scroll to where you left off.

// NOTE: this should remain near the bottom of the file; it ought to be the
// second-to-last thing we run so everything else is already set up.
//
// Only thing that should be after it
runOnUserContent(function(){

  var isWikiPage = (ENV && ENV["WIKI_PAGE"]);
  if (!isWikiPage) return;

  createBzProgressBar();

  var position_magic_field_name = window.position_magic_field_name ? window.position_magic_field_name : ("module_position_" + ENV["WIKI_PAGE"].page_id);

  var openPosition = 0;

  /*
  // if we ever want a url override for direct linking, we can keep
  // this, but I think it is actually a slight negative right now
  if(window.location.hash.startsWith("#box-")) {
    openPosition = Number(window.location.hash.substr("#box-".length));
  } else if(window.openBzBoxPosition) {
    openPosition = window.openBzBoxPosition;
  }
  */
  openPosition = Number(window.openBzBoxPosition);

  function unhideNext(obj) {
    var n = collectStuffAfterBox(obj);
    for(var i = 0; i < n.length; i++) {
      $(n[i]).slideDown();
      if(n[i].querySelector(".bz-toggle-all-next"))
        break;
    }
  }

  var allBoxesWithStoppingPoints = [];
  // only ones with a button are actually stopping points
  var start = document.querySelectorAll(".bz-box");
  for(var a = 0; a < start.length; a++)
    if(start[a].querySelector(".bz-toggle-all-next"))
        allBoxesWithStoppingPoints.push(start[a]);

  if(allBoxesWithStoppingPoints.length < openPosition)
    openPosition = allBoxesWithStoppingPoints.length;

  for(var a = 0; a < allBoxesWithStoppingPoints.length; a++) {
    allBoxesWithStoppingPoints[a].setAttribute("id", "box-" + a);
    allBoxesWithStoppingPoints[a].setAttribute("data-box-sequence", a);
  }

  // anything before this, already open, should show the feedback from
  // last time a nd not shuffle, etc.
  var first = openPosition == allBoxesWithStoppingPoints.length ? null : allBoxesWithStoppingPoints[openPosition].querySelector(".bz-toggle-all-next");
  var listOfShowingBoxes = first == null ? allBoxesWithStoppingPoints : collectBoxesBeforeBox(first);
  for(var i = 0; i < listOfShowingBoxes.length; i++) {
    listOfShowingBoxes[i].className += ' has-preshowing-box';
  }
  addOnMagicFieldsLoaded(function() {
    var list = listOfShowingBoxes;
    for(var i = 0; i < list.length; i++) {
      if(list[i].classList.contains("bz-box")) {
          // simulate the click of old buttons in order to catch up on display
          console.log(list[i]);
          var button = list[i].querySelector(".bz-toggle-all-next");
          if(button)
            triggerBzNewUiHandler(button);

        var magic = list[i].querySelectorAll("[data-bz-retained]");
        for(var a = 0; a < magic.length; a++) {
            // I want to run ehud's jquery handlers, but not any native
            // handlers (especially i do NOT want to run the events I set
            // which do plumbing.. and i use the native api too). this should
            // do it
            $(magic[a]).triggerHandler("change");
        }
      }
    }
  });
  var list = first == null ? [] : collectStuffAfterBox(first);
  for(var i = 0; i < list.length; i++) {
    $(list[i]).hide();
  }

  jQuery('.bz-toggle-all-next').click(function(e){
    unhideNext(this);

    triggerBzNewUiHandler(this);

    var pos = $(this).parents('.bz-box').attr("data-box-sequence");
    pos |= 0;
    pos += 1; // they just advanced!

    if(pos < openPosition)
        return; // no need to update if they clicked done again on a previous button; keep them at the advanced position

    var http = new XMLHttpRequest();
    http.open("POST", "/bz/user_retained_data", true);
    var data = "optional=1&name="+encodeURIComponent(position_magic_field_name)+"&value=" + encodeURIComponent(pos) + "&from=" + encodeURIComponent(location.href);
    http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    http.send(data);

  }).parents('.bz-box').addClass('bz-has-toggle-btn');

  if(openPosition < allBoxesWithStoppingPoints.length && allBoxesWithStoppingPoints.length > 0)
    allBoxesWithStoppingPoints[openPosition].scrollIntoView();
});

// This needs to come AFTER the show box setup so it knows what is already showing
runOnUserContent(function() {
  // Sort to match:
    function sortToMatchSetup() {
      // on chrome, it doesn't allow getData in anything but the drop event
      // so i use this helper variable instead...
      var currentlyDragging = null;
      function isValidDropTarget(event, dropping) {
        var dragging = currentlyDragging;
        if(!dragging)
          return false;
        if(dragging.getAttribute("data-column-number") == dropping.getAttribute("data-column-number"))
          return true;
        return false;
      }

    // skip the first column as it is a label column
    var sortToMatch = document.querySelectorAll(".sort-to-match td:not(:first-child)");
    for(var i = 0; i < sortToMatch.length; i++) {
      var td = sortToMatch[i];

      // wrap the contents in the draggable div so
      // it moves rather than the table cell itself
      var wrapper = document.createElement("div");
      wrapper.innerHTML = td.innerHTML;
      wrapper.id = "draggable-" + i;
      wrapper.setAttribute("draggable", "true");
      td.id = "droppable-" + i;
      td.className += " droppable";
      td.innerHTML = "";
      td.appendChild(wrapper);

      // make it draggable
      wrapper.addEventListener("dragstart", function(event) {
        event.dataTransfer.setData("text/id", this.getAttribute("id"));
        currentlyDragging = this; // need for a chrome hack
      });

      // make the tds valid drop targets
      td.addEventListener("dragenter", function(event) {
        if(!isValidDropTarget(event, this)) return true;
        event.preventDefault();
        this.className += " inside-dragging";
      });
      td.addEventListener("dragleave", function(event) {
        this.className = this.className.replace(" inside-dragging", "");
      });
      td.addEventListener("dragover", function(event) {
        if(!isValidDropTarget(event, this)) return true;
        event.preventDefault();
      });
      td.addEventListener("drop", function(event) {
        event.preventDefault();
        event.stopPropagation();

        var dragging = document.getElementById(event.dataTransfer.getData("text/id"));
        if(dragging.parentNode) {
          // swap our existing contents for the draggable one
          var from = dragging.parentNode;
          dragging.parentNode.removeChild(dragging);
          var existing = this.querySelector("[draggable]");
          if(existing) {
            this.removeChild(existing);
            from.appendChild(existing);
          }
        }
        this.appendChild(dragging);


        this.className = this.className.replace(" inside-dragging", "");
        currentlyDragging = null;

        // delete these next few lines if you don't
        // want instant feedback (prolly don't)
        var parentTable = this;
        while(parentTable.tagName != "TABLE")
          parentTable = parentTable.parentNode;
        sortToMatchCheck(parentTable); // instant feedback update
      });
    }

    // and now that drag&drop is set up, shuffle the contents so the
    // user gets to have fun sorting them back
    var sortToMatch = document.querySelectorAll(".sort-to-match");
    for(var i = 0; i < sortToMatch.length; i++) {
      var table = sortToMatch[i];

      var parentBox = table.parentNode;
      while(parentBox) {
        if(parentBox.classList.contains("bz-box"))
            break;
        parentBox = parentBox.parentNode;
      }

      if(parentBox && parentBox.classList.contains("has-preshowing-box")) {
        // sortToMatchCheck(table); // do show feedback on reload...
        table.className += " bz-locked-table";
        continue; // ...but don't shuffle things that are already showing from previous loads
      }

      // NOTE: this may break with colspan, so don't do that
      var firstRow = table.querySelector("tr");
      var columns = firstRow.children;
      // always skipping the first column as it is likely a header
      for(var col = 1; col < columns.length; col++) {
        // nth-child uses 1-based indexing
        var draggablesDom = table.querySelectorAll("td:nth-child("+(col+1)+").droppable > [draggable]");
        var droppables = table.querySelectorAll("td:nth-child("+(col+1)+").droppable");
        // I have to copy the node list to a regular array
        // since modifying a node list is non-standard
        var draggables = [];
        for(var a = 0; a < draggablesDom.length; a++)
          draggables.push(draggablesDom[a]);

        // then create an array which we will propagate in
        // random order to achieve best randomness...
        var shuffled = [];
        shuffled.length = draggables.length;
        var pos = 0;
        while(draggables.length) {
          var random = Math.floor(Math.random() * draggables.length);
          var d = draggables[random];
          d.parentNode.removeChild(d);

          shuffled[pos] = d;
          pos += 1;

          draggables[random] = draggables[draggables.length - 1];
          draggables.length -= 1;
        }

        // then put the random stuff back in the table.
        var allInOrder = true; // in order is a legit shuffle, but we don't want it....
        for(var a = 0; a < shuffled.length; a++) {
          if(shuffled[a].id.replace("draggable", "droppable") == droppables[a].id) {
            // we shuffled but randomly ended up with all in order...
            // so we'll swap the final item so the user has to do something
            if(allInOrder && a == shuffled.length - 2) {
              var tmp = shuffled[a];
              shuffled[a] = shuffled[a + 1];
              shuffled[a + 1] = tmp;
            }
          } else {
            allInOrder = false;
          }
          droppables[a].appendChild(shuffled[a]);
          shuffled[a].setAttribute("data-column-number", col);
          droppables[a].setAttribute("data-column-number", col);
        }
      }

      sortToMatchCheck(table); // do show feedback for initial, untouched table...
    }
  }

  sortToMatchSetup();

  function sortToMatchCheck(sortToMatchTable) {
    var rows = sortToMatchTable.querySelectorAll("tr");
    for(var row = 0; row < rows.length; row++) {
      var tr = rows[row];
      var all = tr.querySelectorAll("[draggable]");
      var allCorrect = true;
      for(var a = 0; a < all.length; a++) {
        var d = all[a];
        // since I set the ID to be the same above with the wrapper
        // except draggable vs droppable, a simple string replace will
        // tell us if they are back where they are supposed to be!
        var thisOneCorrect = (d.parentNode.id == d.id.replace("draggable", "droppable"));

        if(!thisOneCorrect) {
          allCorrect = false;
          break;
        }
      }

      if(all.length)
        tr.className = allCorrect ? "correct" : "incorrect";
    }
  }
});

// if we ever want a url to auto update, this script will
// do it, but the code above does a better job with explicit
// clicks right now imo
if(0)
runOnUserContent(function() {
  var last_known_scroll_position = 0;
  var ticking = false;

  var sections = document.querySelectorAll(".bz-box");
  if(sections.length == 0)
    return;

  var activeSection = -1;

  function getWindowOffset(ele) {
    var a = 0;
    var e = ele;
    while(e) {
      a += e.offsetTop;
      e = e.offsetParent;
    }
    return a;
  }

  function doSomething(scroll_pos) {
    var start = activeSection + 1;
    if(start >= sections.length)
      return;
    for(var a = sections.length - 1; a >= start; a--) {
      if(getWindowOffset(sections[a]) < scroll_pos) {
        activeSection = a;
        window.location.hash = sections[a].id;
        //alert('changed');
        break;
      }
    }
  }

  window.addEventListener('scroll', function(e) {
    last_known_scroll_position = window.scrollY;
    if (!ticking) {
      window.requestAnimationFrame(function() {
        doSomething(last_known_scroll_position);
        ticking = false;
      });
    }
    ticking = true;
  });
});


// To see the ENV variables, you can use:
/* 
for (var key in ENV) {
  console.log('ENV["' + key + '"] = ' + ENV[key]);
}
*/
