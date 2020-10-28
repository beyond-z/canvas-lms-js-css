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
  if($.subscribe)
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
    /* Improve navigability of assignment content by collapsing/expanding parts: */
    jQuery('.bz-toggle-collapse').parent().addClass('collapsed'); //.append('<span class="bz-toggle-collapse icon">&#10005;</span>');
    jQuery('.bz-toggle-collapse').parent().children().not('.bz-toggle-collapse').hide();
    jQuery('.bz-toggle-collapse').click(function(e){
      e.preventDefault();
      jQuery(this).parent().toggleClass('collapsed').children().not('.bz-toggle-collapse').slideToggle();
    });

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
    jQuery('#bz-auto-toc').each(function(){bzAutoTOC();});
	  
    // Counting H tags
    var indices = [];

    function addIndex() {
    // jQuery will give all the HNs in document order
      $('h2:not(".box-title"),h3:not(".box-title"),h4:not(".box-title")', $('.bz-module:not(.lc-module)')).each(function(i,e) {
        var hIndex = parseInt(this.nodeName.substring(1)) - 2;
        // just found a levelUp event
        if (indices.length - 1 > hIndex) {
          indices= indices.slice(0, hIndex + 1 );
        }

        // just found a levelDown event
        if (indices[hIndex] == undefined) {
          indices[hIndex] = 0;
        }

        // count + 1 at current level
        indices[hIndex]++;

        // display the full position in the hierarchy
        jQuery(this).prepend(indices.join(".")+". ");

      });
    }

    addIndex();

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
    });

    /* Application Ritual functionality: */
    // Update table when new value is added
    let isRitualGoalRendered = false;
    jQuery('.bz-app-ritual tbody').on('change', '.bz-app-ritual-my-week-value', function (e) {
      if (!e.currentTarget.value) {
        e.currentTarget.value = 0
      }

      let sum = 0
      let $modules = jQuery(e.delegateTarget).find('tr.bz-app-ritual-module')
      $modules.each(function (i, week) {
        let $week = jQuery(week)
        let $weekValue = $week.find('.bz-app-ritual-my-week-value')
        let $semesterInput = $week.find('.bz-app-ritual-my-semester')
        let $goalInput = $week.find('.bz-app-ritual-check')
        let $ritualGoal = $week.find('.bz-app-ritual-goal')
        sum += parseInt($weekValue.val() || 0)
        $semesterInput.val(sum)
        if(!isRitualGoalRendered){
          $ritualGoal.append(`<div id="ritual-report-progress-${i}" aria-live="polite" class="sr-only"></div>`);
        }
        var ritualReportProgress = jQuery(`#ritual-report-progress-${i}`);
        BZ_SaveMagicField($semesterInput.attr('data-bz-retained'), $semesterInput.val());
        if ($weekValue.val() == "") {
          $goalInput.val('')
        } else if (sum >= parseInt($week.find('.bz-app-ritual-goal').text())) {
          $goalInput.val('✓')
          $goalInput.removeClass('bz-app-ritual-check-unmet')
          $goalInput.addClass('bz-app-ritual-check-validated')
          ritualReportProgress.text('goal met');
        } else {
          $goalInput.val('X')
          $goalInput.addClass('bz-app-ritual-check-unmet')
          $goalInput.addClass('bz-app-ritual-check-validated')
          ritualReportProgress.text('goal not met');
        }
        BZ_SaveMagicField($goalInput.attr('data-bz-retained'), $goalInput.val());
      })
      isRitualGoalRendered = true;
    })


    // Toggles display of opportunities
    // Commenting out for the time being until we decide what to do
    // jQuery('.bz-app-ritual-secured').on('click', function() {
    //   jQuery('.bz-app-ritual-opportunity-container').toggle()
    // })

    // Displays second opportunity
    // Commenting out for the time being until we decide what to do
    // jQuery('#bz-app-ritual-add-opportunity').on('click', function() {
    //   jQuery("#bz-app-ritual-add-opportiunity").hide()
    // })

    //hide the score input field and add score text
    jQuery(".bz-app-ritual-score").hide()
    jQuery(".bz-app-ritual-score").after('<span class="bz-app-ritual-score-text">40</span>')

    // Displays scorecard modal
    var lastFocus;
    jQuery('.bz-app-ritual-calculate-link').on('click', function() {
      lastFocus = document.activeElement;
      jQuery(".bz-app-ritual .modal").show();
      jQuery("#career-accelerating-opportunity-scorecard").attr("tabindex","0");
      jQuery('#career-accelerating-opportunity-scorecard').focus();
    });

    // Closes scorecard modal
    jQuery('.bz-app-ritual span.close').on('click', function() {
        lastFocus.focus(); // place focus on the saved element
        jQuery(".bz-app-ritual .modal").hide();
    });

    // add all the elements inside modal which you want to make focusable
    const focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    const modal = document.querySelector(".bz-app-ritual .modal"); // select the modal

    const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
    const focusableContent = modal.querySelectorAll(focusableElements);
    const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal

    document.addEventListener('keydown', function(e) {
      let isTabPressed = e.key === 'Tab' || e.keyCode === 9;
    
      if (!isTabPressed) {
        return;
      }
    
      if (e.shiftKey) { // if shift key pressed for shift + tab combination
        if (document.activeElement === firstFocusableElement) {
          lastFocusableElement.focus(); // add focus for the last focusable element
          e.preventDefault();
        }
      } else { // if tab key is pressed
        if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
          firstFocusableElement.focus(); // add focus for the first focusable element
          e.preventDefault();
        }
      }
    });
    
    firstFocusableElement.focus();


    // Update total when slider value is updated
    jQuery('.modal').on('change', '.slider', function(e) {
      let $modal = jQuery(e.delegateTarget)
      let sliders = $modal.find('.slider').toArray()
      let $totalScore = $modal.find('.bz-app-ritual-score')
      let sum = sliders.reduce(function (total, slider) {
        return total += parseInt(slider.value)
      }, 0)
      $totalScore.val(sum)
      jQuery('.bz-app-ritual-score-text').text(sum)
      BZ_SaveMagicField($totalScore.attr('data-bz-retained'), $totalScore.val());
    })

    // Apply score from scorecard into opportunity score 
    jQuery('.bz-app-ritual-scorecard-apply').on('click', function() {
      let score = jQuery('.bz-app-ritual-score').val()
      let $scoreField = jQuery("#bz-app-ritual-score-1")
      $scoreField.val(score)
      BZ_SaveMagicField($scoreField.attr('data-bz-retained'), $scoreField.val());
      jQuery(".bz-app-ritual .modal").hide()
    })

    // Displays confirmation text when saving opportunity
    jQuery('.bz-app-ritual-opportunity-save').on('click', function () {
      jQuery(this).siblings('.bz-app-ritual-confirm').show()
    })

    // Prevent decimals, negative values, and invalid inputs
    // Conditions are in conjunction with filters when using input type number
    // Reference: https://css-tricks.com/snippets/javascript/javascript-keycodes/
    jQuery('.bz-app-ritual-applications').on('keydown', 'input.bz-app-ritual-my-week-value', function (e) {
      let validKeys = [8, 9, 35, 36, 46];
      let isNumberKey = e.keyCode > 47 && e.keyCode < 58;
      let isNumpadKey = e.keyCode > 95 && e.keyCode < 106;
      let isArrowKey = e.keyCode > 36 && e.keyCode < 41;
      if (!(validKeys.indexOf(e.keyCode) > -1 || isNumberKey || isNumpadKey || isArrowKey)) {
        e.preventDefault();
        return;
      }
    })

    // Force value for input to be between 0 - 99
    jQuery('.bz-app-ritual-applications').on('keyup', 'input.bz-app-ritual-my-week-value', function (e) {
      let value = parseInt(e.currentTarget.value) || 0;
      if (value < 0) {
        e.currentTarget.value = 0;
      } else if (value > 99) {
        e.currentTarget.value = 99;
      }
    })

    // Add CSS validation to checks after BZ Retained Data is loaded
    addOnMagicFieldsLoaded(function() {
      jQuery('input.bz-app-ritual-check').not('[value=""]').each(function (i, c) {
        $c = jQuery(c)
        if($c.val() == '✓') {
          $c.addClass('bz-app-ritual-check-validated')
        } else if($c.val() == 'X') {
          $c.addClass('bz-app-ritual-check-unmet')
          $c.addClass('bz-app-ritual-check-validated')
        }
      })
    });

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
    if(maxScore == 0)
    	return;
    var checklistScore = 0;
    var falsePositives = 0;
    checklist.children().each(function(){
      jQuery(this).addClass('show-answers');
      if( jQuery(this).children('input').is(':checked') ) {
        jQuery(this).addClass('checked');
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
        jQuery(this).addClass('checked');
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
    //console.log(rangeScore);
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

    // Generate self-evaluation results list:
  '.for-eval' : function(){
    var evalarray = [];
    var results = "<ul>";
    // collect all checked inputs' values into an array:
    jQuery(this).parents('.bz-box').find('input:checked').each(function(){
      evalarray.push(jQuery(this).val());
    });
    // Now let's sort and count what we've collected:
    evalarray.sort();
    var current = null;
    var count = 0;
    for (var i = 0; i < evalarray.length; i++) {
        if (evalarray[i] != current) {
            if (count > 0) {
                results+= '<li>'+ current + ': ' + count + '</li>';
            }
            current = evalarray[i];
            count = 1;
        } else {
            count++;
        }
    }
    //finish last iteration:
    if (count > 0) {
      results+= '<li>'+ current + ': ' + count + '</li>';
    }
    //close the list:
    results+= '</ul>';
    jQuery(this).parents('.bz-box').next().children('.box-title').after(results);
  },

  '.for-eval-sum' : function(){
    var results = 0;
    // sum all checked inputs' values
    jQuery(this).parents('.bz-box').find('input:checked').each(function(){
      results+= Number(jQuery(this).val());
    });
    // calculate max assuming 10 is high score per rubric criterion:
    var max = 10 * jQuery(this).parents('.bz-box').find('.criterion').length;
    // return results
    jQuery(this).parents('.bz-box').next().find('.bz-show-eval-sum').text(String(results));
    jQuery(this).parents('.bz-box').next().find('.bz-show-eval-max').text(String(max));
  },

  '.for-compare-scores'  : function(){
    // add '.show-answers' to the table, then run through each row where there's a spot to display comparison results:
    jQuery(this).parents('.bz-box').next('.bz-box').find('.bz-compare-scores-result').text(function(){
      var row = jQuery(this).parents('tr');
      var after = 0;
      var before = 0;
      after = Number( jQuery(row).find('.bz-compare-scores-after').text() );
      before = Number( jQuery(row).find('.bz-compare-scores-before').text() );
      var result = (after - before);
      // color the row based on comparison
      if (0 > result) {
        jQuery(row).children('td').addClass('show-answers incorrect');
      } else if (0 < result) {
        jQuery(row).children('td').addClass('show-answers correct');
      }
      return result;
    });
  },

};

function shuffleChildren(element) {
  var children = Array.prototype.slice.call(element.children);
  var shuffled = [];
  shuffled.length = children.length;
  var pos = 0;
  while(children.length) {
    var random = Math.floor(Math.random() * children.length);
    var d = children[random];
    d.parentNode.removeChild(d);

    shuffled[pos] = d;
    pos += 1;

    children[random] = children[children.length - 1];
    children.length -= 1;
  }

  for(var i = 0; i < shuffled.length; i++)
    element.appendChild(shuffled[i]);

  return element;
}

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

function currentRangeVal(e) {
  var currentVal = jQuery(e).val();
  jQuery(e).parents('.question').find('.display-value .current-value').text(currentVal);
  jQuery(e).parents('td').siblings('.current-value').text(currentVal);
  jQuery(e).parents('td').find('.current-value').text(currentVal);
};

addOnMagicFieldsLoaded(function() {
  $( '[type="range"]' ).each(function() {
    currentRangeVal(this);
  });
});

function bzInitializeNewUi() {
    // FIXME

  // Show an asterisk indicating which questions are counted towards your mastery grade
  jQuery('.bz-check-answers').parents('.bz-box').find('.box-title').next().addClass('bz-graded-question');


  // Display current value of a range question:
  jQuery ('[type="range"]').change(function() {
    currentRangeVal(this);
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
    shuffleChildren(this);
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

  function collectStuffUntilNextH2(startElement) {
    var all = document.getElementsByTagName("*"); // ask the browser to flatten the tree
    var start = 0;
    var end = all.length;
    // cut everything before the start
    for(var i = 0; i < all.length; i++)
      if(all[i] == startElement) {
        start = i + 1; // exclude the starting element
        break;
      }
    // cut everything after the end
    for(var i = start; i < all.length; i++)
      if(all[i].tagName == "H2") {
        end = i; // no need to include the ending element
        break;
      }

    return Array.prototype.slice.call(all, start, end);
  }


  // Automatically generate a table of contents (TOC) for the top level out of h2 elements,
  // and a h2-level TOC out of its nested h3 elements
  jQuery('.bz-module:not(.lc-module)').prepend(function(){
    var tocBox = jQuery('<div class="main-toc"><p class="match-heading-style">The big picture:</p></div>');
    var mainToc = jQuery('<ol></ol>');
    var mainHasKids = false;
    // this level will gather h2 headings into a table of contents:
    jQuery('.bz-module h2').each(function(){
      mainHasKids = true;
      // this level generates tables of contents under each h2:
      var innerToc = '<ol class="inner-toc">';
      var innerHasKids = false;
      var isWrapUp = false;
      if ( jQuery(this).is('#wrap-up') ) {
        isWrapUp = true;
      }
      var nextLevelDown = collectStuffUntilNextH2(this);
      nextLevelDown.forEach(function(c){
        var current = jQuery(c);
        if (current.is('h3') && !current.hasClass('box-title')) {
          innerHasKids = true;
          if(typeof current.attr('id') !== "undefined") {
            innerToc += '<li><a href="#' + current.attr('id') + '">' + current.text() + '</a></li>';
          } else {
            innerToc += '<li>' + current.text() + '</li>';
          }
        }
      });
      var mainListObj = jQuery('<li><a href="#' + jQuery(this).attr('id') + '">' + jQuery(this).text() + '</a></li>');

      if (innerHasKids && !isWrapUp) {
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
    });
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
        if( magicInput.prop('checked') || ( !magicInput.is('[type="checkbox"], [type="radio"]') && magicInput.val() !== "" ) ) {
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
			jQuery(window).scrollTop(0);
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

/* 
  Replace elements like: <a class="bz-ajax-replace" href="/courses/1/rubrics/55#criterion_43_153" target="_blank">Click to open 4.8.</a>
  with inline rubrics. This has to run after the full rubric table has been ajax requested and returned AND
  after the existing magic field values for those that are clickable have been retrieved.
  Sample params: 
   - queuedInlineRubricsToReplace = [ jQuery('.bz-ajax-replace'), '/courses/1/rubrics/55', '#criterion_43_153'] 
   - loadedFullRubricTables = { '/courses/1/rubrics/55' : jQuery('<html>...<tr id="criterion_43_153"/>...</html>') }
   - loadedMagicFieldValues = JSON.parse('{"key1":"value1","key2":"value2"}')
*/
function bzReplaceInlineRubrics(queuedInlineRubricsToReplace, loadedFullRubricTables, loadedMagicFieldValues){

  while (queuedInlineRubricsToReplace.length > 0){
    let val = queuedInlineRubricsToReplace.shift();
    let el = val[0];
    let rubricURL = val[1];
    let criterion_selector = val[2];
    console.log('Replacing <a class="bz-ajax-replace" href="' + rubricURL + criterion_selector + '">' + el.html() + '</a> with inline rubric');
    
    let fullRubricTable = loadedFullRubricTables[rubricURL];
    if (!fullRubricTable) {
      // If there are multiple rubrics inlined on this page, we may be calling this when one is 
      // loaded but not the other. The logic here should be queue it up again and move on. FIXME.
      console.log('Error: replacing rubric. It hasnt been fetched yet. Maybe there is a mix and match of rubrics on this page?');  
      continue;
    }

    let tableEl = jQuery('<table class="bz-ajax-loaded-rubric bz-ajax-loaded" />').html(fullRubricTable.find(criterion_selector));
    //console.log('pulled the following rubric row out of the full table: ' + tableEl.html());

    // If the inline rubric looks something like the following, set it up as a magic field backed table where the selected
    // cell is remembered:
    // <a class="bz-ajax-replace" href="/courses/1/rubrics/55#criterion_43_153" data-bz-retained="h2cb-rubric-43_153">Click to open 4.8.</a>
    let magicFieldName= el.attr('data-bz-retained');
    let isOptionalMagicField = el.hasClass('bz-optional-magic-field');
    if (magicFieldName){
      // Wire up magic field backed rubrics. The <table> initially looks something like this:
      //
      //<table><tbody><tr id="criterion_43_4821" class="criterion">
      //  <td class="criterion_description hover-container">...description of criterion...</td>
      //  <td>
      //    <table class="ratings">
      //      <tbody><tr>
      //        <td id="rating_43_1347" class="rating edge_rating">...rating description and point value...</td>
      //        <td id="rating_43_627" class="rating ">...rating description and point value...</td>
      //        <td id="rating_43_7871" class="rating ">...rating description and point value...</td>
      //      </tr></tbody>
      //    </table>
      //  </td>
      //</tr></tbody></table>
      //
      let ratingsTable = tableEl.find('.ratings');
      if (ratingsTable){
        tableEl.addClass('bz-clickable-rubric');
        ratingsTable.on('click', 'td', function(){
          let ratingsCell = jQuery(this);
          ratingsTable.find('td').removeClass('selected');
          ratingsCell.addClass('selected');
          let selectedvalue = ratingsCell.attr('id');
          let inputEl = jQuery('#'+magicFieldName);
          //console.log('Setting input value to: ' + selectedvalue + ' for input element: ' + inputEl.attr('id'));
          inputEl.val(selectedvalue);
          // Tried triggering the change event to let the normal magic field logic in bz_support.js run,
          // but it wasn't working so just save it directly here.
          BZ_SaveMagicField(magicFieldName, selectedvalue, isOptionalMagicField, "hidden");
       });
      } else {
         console.log('Error: Failed finding <table class="ratings"/> for magic rubric: ' + magicFieldName);
      }
      
      // insert hidden <input> element that we'll setup as a magic field and change
      // the value when the table cells are clicked
      // We give the element a bz-retained-field-setup class to prevent the magic field
      // setup logic in public/bz_support.js from running on these since we just save the values
      // directly here (b/c i couldn't get it wired up and working properly from there)
      let classes = "bz-clickable-rubric-data bz-retained-field-setup";
      if (isOptionalMagicField){
        classes += ' bz-optional-magic-field';
      }
      let hiddenInputEl = $('<input type="hidden" id='+magicFieldName+' class="'+classes+'" value="" data-bz-retained="'+magicFieldName+'" />').insertAfter(el);
      // Note: this commit changed to the returned objects per name to be: {value: val, timestamp: ts} instead of just the value.
      // I *should* fix it up to be a bit cleaner: https://github.com/beyond-z/canvas-lms/commit/8c25d9687ba405cacd5c9ea9f02834bbf302d782#diff-e37ca7733a2b3082659beb7b71fe4e6f
      let obj = loadedMagicFieldValues[magicFieldName];
      if (obj && obj.value && obj.value != 'undefined'){ // On first load, there may not be a value set yet.
        let magicValue = obj.value;
        hiddenInputEl.val(magicValue);
        let selectedCell = tableEl.find('td#' + magicValue);
        if (selectedCell) selectedCell.addClass('selected');
        else console.log('Error: Failed finding td#' + magicValue + ' to set as selected cell for magic rubric');
      }
    }

    el.replaceWith(tableEl);

    el.click(function(e){
      e.preventDefault();
    });
  }
}

/* Ajax Load dynamic content, like rubric criterion (bypassing sanitizer) and LinkedIn API URLs */
function bzAjaxLoad() {
  console.log("bzAjaxLoad() begin");
  // For each clickable rubric, we need to load the existing value of the clicked cell. 
  // Will be set to return value of JSON.parse('{"key1":"value1","key2":"value2"}')
  let loadedExistingRubricValues = {}; 
  let queuedExistingRubricValues = [];
  let loadedFullRubricTables = {}; // For each rubric, load the whole table once and store it here.
  let queuedFullRubricTables = new Set(); // Each time we encounter a new rubric not already loaded, queue it here when we ajax request it and remove once loaded
  let queuedInlineRubricsToReplace = []; // Queue up individual <a class="bz-ajax-replace" href="/courses/1/rubrics/55#criterion_43_153"/> elements to process once everything is loaded.

  jQuery('.bz-ajax-replace').each(function(e){
    var el = jQuery(this);
    let replaceURL = jQuery(this).attr('href');

    if (replaceURL.indexOf('rubric') >= 0){
      // This will replace elements like this with a <table> holding that part of the rubric:
      // <a class="bz-ajax-replace" href="/courses/1/rubrics/55#criterion_43_153" target="_blank">Click to open 4.8.</a>
      //
      // Overview of the logic:
      // 1) Loop through each inline rubric and queue it up to be replaced. 
      // 2) If the full rubric table hasn't been ajax requested yet, queue that up.
      // 3) If the inline rubric is clickable, add the magic field to the list to be fetched.
      // 4) When the full rubric table AND the list of magic field values come back, go through and
      //    actually do the replace
      let rubricURL = '';
      let criterion_selector = '';

      if (replaceURL.indexOf('#')){
        let rb = replaceURL.split('#');
        criterion_selector = '#'+rb[1];
        rubricURL = rb[0];
      }

      queuedInlineRubricsToReplace.push([el, rubricURL, criterion_selector]);

      let magicFieldName= el.attr('data-bz-retained');
      if (magicFieldName){
        queuedExistingRubricValues.push(magicFieldName);
      }

      if (!queuedFullRubricTables.has(rubricURL) && !loadedFullRubricTables.hasOwnProperty(rubricURL)) {
        queuedFullRubricTables.add(rubricURL); 
        console.log('Loading full rubric table (one time): ' + rubricURL);
        $.ajax({
          url: rubricURL,
          success: function (data) { 
            console.log('Done loading full rubric table for: ' + rubricURL);
            var loadedFullRubricTable = $(data);
            //console.dir(loadedFullRubricTable);
            loadedFullRubricTables[rubricURL] = loadedFullRubricTable;
            queuedFullRubricTables.delete(rubricURL);
            // Race condition with magic fields being loaded. Second to finish actually runs the replace.
            if (queuedExistingRubricValues.length <= 0) {
              bzReplaceInlineRubrics(queuedInlineRubricsToReplace, loadedFullRubricTables, loadedExistingRubricValues);
            }
          }
        });
      }
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

  // If there are clickable rubrics, go load their clicked values.
  if (queuedExistingRubricValues.length > 0) {
    BZ_LoadMagicFields(queuedExistingRubricValues, function(retrievedFieldValues) {
      console.log("Retreived list of existing magic values for inline rubrics");
      loadedExistingRubricValues = retrievedFieldValues;
      queuedExistingRubricValues.length = 0;
      // Race condition b/n this callback and the ajax callback to fetch and replace the rubric
      // Second one to be called actually runs.
      if (queuedFullRubricTables.size <= 0) {
       bzReplaceInlineRubrics(queuedInlineRubricsToReplace, loadedFullRubricTables, loadedExistingRubricValues);
      }
    });
  }
}

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


// just leaving the comment to remember we have this for later if needed
// window.onSpeedGraderLoaded = bzDisagScoresForCopying;

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

// the magic fields must be loaded for this to work!
function createBzProgressBar() {
  var div = document.createElement("div");
  div.setAttribute("id", "bz-progress-bar");
  div.setAttribute("aria-live", "polite");

  // progress
  var allContentSavedDiv = document.createElement("div");
  div.appendChild(allContentSavedDiv);

  var savedContainer = document.createElement("p");
  savedContainer.textContent = "";
  allContentSavedDiv.appendChild(savedContainer);

  window.addEventListener("magic_fields_saving", function(event) {
    savedContainer.textContent = "Saving...";
  });

  window.addEventListener("magic_fields_saved", function(event) {
    // the artificial delay here is to ensure they actually get to see
    // the change before it is overwritten on quick changes; to give the
    // user the feeling of something actually happening, even if the server
    // is legit fast.
    setTimeout(function() {
      savedContainer.textContent = "All progress saved.";
    }, 500);
  });

  var doneButtonCount = document.querySelectorAll(".bz-toggle-all-next").length;
  if(doneButtonCount == 0)
    return; // no progress to report!

  var progress = document.createElement("progress");
  progress.value = window.openBzBoxPosition;
  progress.max = doneButtonCount;
  allContentSavedDiv.appendChild(progress);

  var participationScore = document.createElement("h4");
  var participationScoreContext = document.createElement("p");
  allContentSavedDiv.appendChild(participationScore);
  allContentSavedDiv.appendChild(participationScoreContext);

  function setParticipationScore(score) {
    participationScore.textContent = "Score so far: " + Math.round(100 * score) / 100 + " / 10";
	participationScoreContext.textContent = "This score is a combination of how you do on Mastery Questions and your full participation in the module.";
  }

  if(typeof window.startingBzParticipationScore != "undefined")
    setParticipationScore(window.startingBzParticipationScore);

  window.addEventListener("participation_score_changed", function(event) {
    setParticipationScore(event.detail);
  });

  // mastery
  var masteryContainer = document.createElement("div");
  div.appendChild(masteryContainer);
  masteryContainer.classList.add("bz-graded-question");

  var list = document.createElement("ol");

  function redrawMastery() {
      list.innerHTML = "";

      masteryContainer.appendChild(list);

      // the idea here is to just flatten the dom so we can easily count the boxes...
      var possibilities = document.querySelectorAll("*");
      var lastBox;
      var lastName;
      var li;
      var boxPosition = 0;
      for(var i = 0; i < possibilities.length; i++) {
        let e = possibilities[i];

        if(e.matches(".bz-toggle-all-next"))
          boxPosition++;

        if(!e.matches("[data-bz-answer]"))
          continue;

        var box = e;

        if(e.type == "radio" && e.getAttribute("data-bz-answer") != e.value)
          continue; // skip the wrong answers on radio boxes to simplify the check below

        if(e.dataset.bzRetained == lastName)
          continue;

        while(box && !box.classList.contains("bz-box"))
          box = box.parentNode;
        if(!box) continue;
        if(box != lastBox) {
          lastBox = box;

          lastName = e.dataset.bzRetained;
          li = document.createElement("li");
          list.appendChild(li);
        }

        if(!li) continue; // this shouldn't happen but meh

        lastName = e.dataset.bzRetained;

        let answered = false;
        let correct = false;

        if(boxPosition < window.openBzBoxPosition) {
          // it is available to be possibly answered...
          answered = true;
          if(
            (e.type == "radio" && e.checked)
            ||
            (e.type == "checkbox" && e.getAttribute("data-bz-answer") == "yes" && e.checked)
            ||
            // in some cases we used yes, in some we used on, allow either as correct
            (e.type == "checkbox" && e.getAttribute("data-bz-answer") == "on" && e.checked)
            ||
            (e.type == "checkbox" && e.getAttribute("data-bz-answer") == "" && !e.checked)
            ||
            (e.type != "radio" && e.type != "checkbox" && e.value == e.getAttribute("data-bz-answer"))
          ) {
            correct = true;
          } else {
            correct = false;
          }
        }

        var item = document.createElement("span");
        li.appendChild(item);
        item.addEventListener("click", function() {
          e.scrollIntoView();
        });
        if(answered) {
          if(correct) {
              item.setAttribute("title", "Correct");
              item.textContent = "C ";
              item.className = "correct-mastery-item";
          } else {
              item.setAttribute("title", "Incorrect");
              item.textContent = "X ";
              item.className = "incorrect-mastery-item";
          }
        } else {
          item.setAttribute("title", "Unanswered");
          item.textContent = "U ";
          item.className = "unanswered-mastery-item";
        }
      }
  }

  redrawMastery();

  window.addEventListener("next_button_pressed", function(event) {
    progress.value = event.detail;
    window.openBzBoxPosition = event.detail;
    redrawMastery();
  });

  /* the ordered list is just the mastery thing possible, each thing next to it is the number of checklist items actually correct; number of points out of points possible in that section */

  var where = document.querySelector("#module-container h1, .user_content h1");
  if(where) {
    // I insert it here because then it takes a nice position below the header,
    // staying with us thanks to css, while never covering anything up
    where.parentNode.insertBefore(div, where.nextElementSibling);
  } else {
    // actually gonna skip it.
  }
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

  var nextButton = document.querySelector(".bz-toggle-all-next");
  if(nextButton) {
  	// if we have a next (aka Done) button in the content, we want to hide the
	  // default canvas next button b/c this is a module for Fellows using the interactive one page flow.
    // TAs and others who use modules without this flow want to see Canvas's built-in Next/Prev button.
	  document.body.classList.add("hide-next-module-button");
  }

  addOnMagicFieldsLoaded(function() {
    createBzProgressBar();
    /* Hide Mastery Questions Progress Sidebar when there aren't any questions on the page */
    if ($(".bz-graded-question ol li").length === 0){
      jQuery("#bz-progress-bar .bz-graded-question").hide();
    }
  });

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

  // no boxes on page, nothing else to do (old content or edit page perhaps)
  if(allBoxesWithStoppingPoints.length == 0 || isNaN(openPosition))
    return;

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
    var parentBox = this;
    while(parentBox && !parentBox.classList.contains("bz-box"))
    	parentBox = parentBox.parentNode;
    // make sure instant feedback is actually showing before we next on those.
    // want to ensure the users actually interact somehow
    if(parentBox.querySelector(".instant-feedback") && !parentBox.querySelector(".show-answers")) {
    	if(!parentBox.classList.contains("clicked-at-least-once")) {
          alert("Please interact with the module before you advance.");
	  // if you double click the next button, it goes easy on you and lets you advance
	  // the idea here is just to ensure they try, but not really *lock* them because there
	  // might be some other bug (currently, instant-feedback will only do anything with show-answers
	  // but I worry we might get that wrong with changes) and it isn't essential for them to actually do it.
	  parentBox.classList.add("clicked-at-least-once");
          return;
        }
    }
    unhideNext(this);

    triggerBzNewUiHandler(this);

    var pos = $(this).parents('.bz-box').attr("data-box-sequence");
    pos |= 0;
    pos += 1; // they just advanced!

    if(pos < openPosition)
        return; // no need to update if they clicked done again on a previous button; keep them at the advanced position

    var ce = new CustomEvent("next_button_pressed", {detail: pos});
    window.dispatchEvent(ce);

    var http = new XMLHttpRequest();
    http.open("POST", "/bz/user_retained_data", true);
    var data = "optional=1&name="+encodeURIComponent(position_magic_field_name)+"&value=" + encodeURIComponent(pos) + "&from=" + encodeURIComponent(location.href);
    http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    http.send(data);

  }).parents('.bz-box').addClass('bz-has-toggle-btn');

  if(location.hash.length) {
    var where = document.getElementById(location.hash.substring(1));
    if(where)
    	where.scrollIntoView();
  } else if(openPosition != 0 && openPosition < allBoxesWithStoppingPoints.length && allBoxesWithStoppingPoints.length > 0)
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
    var currentParentTable = null;
    var currentParentTableDraggableCount = 0;
    var sortToMatch = document.querySelectorAll(".sort-to-match td:not(:first-child)");
    for(var i = 0; i < sortToMatch.length; i++) {
      var td = sortToMatch[i];

      var p = td.parentNode;
      while(p.tagName != "TABLE")
      	p = p.parentNode;

      if(p != currentParentTable) {
        currentParentTable = p;
	currentParentTableDraggableCount = 0;
      } else {
        currentParentTableDraggableCount++;
      }

      // wrap the contents in the draggable div so
      // it moves rather than the table cell itself
      var wrapper = document.createElement("div");
      wrapper.innerHTML = td.innerHTML;
      wrapper.id = "draggable-" + i;
      wrapper.setAttribute("draggable", "true");
      wrapper.setAttribute("data-table-cell-id", currentParentTableDraggableCount);
      td.id = "droppable-" + i;
      td.className += " droppable";
      td.innerHTML = "";
      td.appendChild(wrapper);

      function performDrop(dragging, dropping) {
	if(!dragging) return;
        if(dragging.parentNode) {
          // swap our existing contents for the draggable one
          var from = dragging.parentNode;
          dragging.parentNode.removeChild(dragging);
          var existing = dropping.querySelector("[draggable]");
          if(existing) {
            dropping.removeChild(existing);
            from.appendChild(existing);
          }
        }
        dropping.appendChild(dragging);

        dropping.className = dropping.className.replace(" inside-dragging", "");

        // delete these next few lines if you don't
        // want instant feedback (prolly don't)
        var parentTable = dropping;
        while(parentTable.tagName != "TABLE")
          parentTable = parentTable.parentNode;
        sortToMatchCheck(parentTable); // instant feedback update
      }

      // keyboard control {
      wrapper.setAttribute("tabindex", "0"); // make it focusable for keyboard control
      wrapper.setAttribute("aria-grabbed", "false");
      var pickedUpViaKeyboard = null;
      var dropTargetViaKeyboard = null;
      function changeDropTarget(to) {
	if(dropTargetViaKeyboard) {
		dropTargetViaKeyboard.setAttribute("aria-dropeffect", "move");
		dropTargetViaKeyboard.className = dropTargetViaKeyboard.className.replace(" inside-dragging", "");
	}
	dropTargetViaKeyboard = to;
	if(dropTargetViaKeyboard) {
        	dropTargetViaKeyboard.className += " inside-dragging";
		dropTargetViaKeyboard.setAttribute("aria-dropeffect", "move");
	}
      }
      wrapper.addEventListener("blur", function() {
	changeDropTarget(null);
	if(pickedUpViaKeyboard) {
          pickedUpViaKeyboard.setAttribute("aria-grabbed", "false");
	  pickedUpViaKeyboard = null;
	}
      });
      wrapper.addEventListener("keydown", function(event) {


	function iterateDropTarget(parentTag, selector, change) {
		var tbl = dropTargetViaKeyboard;
		if(!tbl)
			return;
		while(tbl.tagName != parentTag)
			tbl = tbl.parentNode;
		var allTgts = tbl.querySelectorAll(selector);
		for(var loopVar = 0; loopVar < allTgts.length; loopVar++)
			if(allTgts[loopVar] == dropTargetViaKeyboard)
				break;
		loopVar += change;
		// wraparound behavior
		if(loopVar < 0)
			loopVar += allTgts.length;
		else if(loopVar >= allTgts.length)
			loopVar -= allTgts.length;
		changeDropTarget(allTgts[loopVar]);

		var rect = dropTargetViaKeyboard.getBoundingClientRect();
		// the +40 here is for Back to Top
		if(rect.top < 0 || (rect.bottom + 40) > window.innerHeight) {
			dropTargetViaKeyboard.scrollIntoView(change < 0); // if moving up, align to top so the window scrolls the least (less disorientating)
			if(change > 0)
				window.scrollBy(0, 40); // scroll a bit more when doing down so the "Back to Top" doesn't overlap any text
		}
	}

        switch(event.keyCode) {
	  case 32: // space
	  if(event.target.getAttribute("aria-grabbed") == "true") {
		// drop it
          	event.target.setAttribute("aria-grabbed", "false");
	  	event.preventDefault();

		var returnFocusTo = pickedUpViaKeyboard;
		performDrop(pickedUpViaKeyboard, dropTargetViaKeyboard);
		returnFocusTo.focus();
	  } else {
	  	// pick it up
          	event.target.setAttribute("aria-grabbed", "true");
	  	event.preventDefault();
		pickedUpViaKeyboard = this;
		changeDropTarget(this.parentNode);
	  }
	  break;
	  case 9: // tab
	  if(event.target.getAttribute("aria-grabbed") == "true") {
	  	event.preventDefault();
		iterateDropTarget("TABLE", ".droppable", event.shiftKey ? -1 : 1);
	  }
	  break;
	  case 37: // left arrow
	  if(event.target.getAttribute("aria-grabbed") == "true") {
	  	event.preventDefault();
		iterateDropTarget("TR", ".droppable", -1);
	  }
	  break;
	  case 38: // up arrow
	  if(event.target.getAttribute("aria-grabbed") == "true") {
	  	event.preventDefault();
		iterateDropTarget("TABLE", ".droppable[data-column-number=\""+dropTargetViaKeyboard.getAttribute("data-column-number")+"\"]", -1);
	  }
	  break;
	  case 39: // right arrow
	  if(event.target.getAttribute("aria-grabbed") == "true") {
	  	event.preventDefault();
		iterateDropTarget("TR", ".droppable", 1);
	  }
	  break;
	  case 40: // down arrow
	  if(event.target.getAttribute("aria-grabbed") == "true") {
	  	event.preventDefault();
		iterateDropTarget("TABLE", ".droppable[data-column-number=\""+dropTargetViaKeyboard.getAttribute("data-column-number")+"\"]", 1);
	  }
	  break;
	}
      });
      // } end keyboard control

      // make it draggable
      wrapper.addEventListener("dragstart", function(event) {
	try {
          event.dataTransfer.setData("text/plain", event.target.getAttribute("id"));
       } catch(e) {
	  // IE 9 fallback
          event.dataTransfer.setData("Text", event.target.getAttribute("id"));
       }
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

        var dragging;
	try {
		dragging = document.getElementById(event.dataTransfer.getData("text/plain"));
	} catch(e) {
		// IE 9 fallback
		dragging = document.getElementById(event.dataTransfer.getData("Text"));
        }
        if(dragging.parentNode) {
            performDrop(dragging, this);
            currentlyDragging = null;

            // delete these next few lines if you don't
            // want instant feedback (prolly don't)
            var parentTable = this;
            while(parentTable.tagName != "TABLE")
              parentTable = parentTable.parentNode;
            sortToMatchCheck(parentTable, true); // instant feedback update
        }
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

      var performShuffle = true;

      if(parentBox && parentBox.classList.contains("has-preshowing-box")) {
        // sortToMatchCheck(table); // do show feedback on reload...
        table.className += " bz-locked-table";
        performShuffle = false; // ...but don't shuffle things that are already showing from previous loads
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

        for(var a = 0; a < draggables.length; a++) {
          draggables[a].setAttribute("data-column-number", col);
          droppables[a].setAttribute("data-column-number", col);
	}

	if(!performShuffle)
          continue;

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
        }
      }

      sortToMatchCheck(table, false); // do show feedback for initial, untouched table...
    }
  }

  sortToMatchSetup();

  function sortToMatchCheck(sortToMatchTable, updateMagicField) {
    var magicFieldSequence = "";
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

	// for the magic field, we want them all to be alphabet so it is single char A-Z that we string together
	var magicFieldName = String.fromCharCode(65 + Number(d.getAttribute("data-table-cell-id")));
	magicFieldSequence += magicFieldName;

        var thisOneCorrect = (d.parentNode.id == d.id.replace("draggable", "droppable"));

        if(!thisOneCorrect) {
          allCorrect = false;
        }
      }

      if(all.length)
        tr.className = allCorrect ? "correct" : "incorrect";
    }

    if(updateMagicField) {
        var magicField = sortToMatchTable.querySelector("[data-bz-retained]");
        if(magicField) {
            magicField.value = magicFieldSequence;
            var e = new Event('change');
	    magicField.dispatchEvent(e);
        }
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

/*
	For resume module thing - a modal popup thing by attribute
*/
(function() {

var activeModal = null;

document.body.addEventListener("click", function(event) {
	var ele = event.target;
	if(ele.getAttribute("data-toggle") == "modal" && ele.hasAttribute("data-target")) {
		if(activeModal) {
			activeModal.style.display = "none";
			activeModal = null;
		}

		var thing = document.querySelector(ele.getAttribute("data-target"));
		if(thing) {
			thing.style.display = "";
			activeModal = thing;
		}
	} else if(ele.classList.contains("modal")) {
		if(activeModal) {
			activeModal.style.display = "none";
			activeModal = null;
		}
	}
});
})();
