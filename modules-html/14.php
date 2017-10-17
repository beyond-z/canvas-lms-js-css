<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Module 14 CAPSTONE CHALLENGE PRESENTATIONS</title>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>
<script
src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
crossorigin="anonymous">
</script>
<style>
@font-face {
 font-family: "TradeGothicNo.20-CondBold";
 src: url('../TradeGothicLTStd-BdCn20.otf');
}
</style>
<link rel="stylesheet" type="text/css" href="../bz_newui.css">
</head>
<body>
<?php 
$ns = 'cspr';
require('functions.php');
?>
<div class="bz-module">
  <p>This is the last module before Capstone presentations, and it focuses on getting in the right mental state before you present.</p>
  <h2>Why is this important?</h2>
  <?php 
  bz_open_box('pulse','How confident are you feeling about your upcoming Capstone Presentation, on a scale from 1 (very nervous) to 10 (extremely confident and prepared)?'); ?>

    <table class="no-zebra instant-range-feedback" style="table-layout: fixed;">
      <tbody>
        <tr>
          <td style="font-size: 0.8em; text-align: center; width: 34%;">&nbsp;</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">n/a</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">1</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">2</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">3</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">4</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">5</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">6</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">7</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">8</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">9</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">10</td>
        </tr>
        <tr class="inputs-row">
          <td>My confidence level is...</td>
          <td colspan="11">
            <input max="10" min="0" step="1" value="0" type="range" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id(); ?>" />
            <div class="display-value"><span class="current-value">&nbsp;</span></div>
          </td>
        </tr>
        <tr>
          <td colspan="12">
            <div class="feedback" data-bz-range-flr="0" data-bz-range-clg="7">
              <p>It's extremely common for even the most experienced presenters to get a bit jittery before showtime. Keep reading for some advice on preparing for the presentations and being calm and confident on stage.</p>
            </div>
            <div class="feedback" data-bz-range-flr="7" data-bz-range-clg="10"><p>Good for you! This means your team can rely on you to be their rock.</p></div>
          </td>
        </tr>
      </tbody>
    </table>
  <?php
  bz_close_box();
  ?>
  <blockquote>
    <p>To prepare for our Capstone Presentation, my cohort met up daily. We would practice all of our lines together and give constructive feedback when needed. By the time the presentation came, we all felt ready.</p>
    <p class="quote-source">Kenny Doan, a former Braven Fellow</p>
  </blockquote>
  <h2 id="how">How do I do this?</h2>
  <h3>How do I prepare for the Capstone Challenge presentation?</h3>
  <?php
  bz_open_box('video','Watch this video of a past Capstone Presentation from a previous Braven Accelerator course and then use the rubrics to assess their presentation.','Learn from past experiences');
    $transcript = '
      <p>Good evening everyone. We are team Kraken and this is our Capstone Presentation. My name is Sandy, and I’m the Project Manager. </p>
      <p>I’m Katie; I’m the Lead Researcher. </p>
      <p>My name is Dave,</p>
      <p>and I’m Ciara, and we’re the Lead Oral Presenters. </p>
      <p>I’m Alex,</p>
      <p>and I’m Sandra and we’re the Lead Written Reporters. </p>
      <p>I’m Michael,</p>
      <p>and I’m Christina, and we were the Lead Prototypers. </p>
      <p>First and foremost, we’d like to take the time to thank you all for being here and taking time out of your busy lives. We all know how precious a commodity time is. So when we were looking at our research, we discovered that 82% of the users we interviewed, which was over 25 of them, were transitional professionals, students, or a combination thereof, and they have a lot going on in their lives. According to a 2015 study from the Bureau of Labor Statistics, people who are ages 18-30 years old will go through 12 different jobs. That’s an average of one job a year. That’s a lot. A lot to handle. And this led us to the problem statement, that 18-35 year olds, they need an email platform that is easy to use, simple, something that is time efficient and that they’re not going to experience information overload with. And so that is what we focused our concept to do. Now, I’m not going to walk you through how our design is going to positively impact every single person in this room’s life, because that would take way too much time and we only have seven minutes, but we’re going to walk you through a little story and that’s Charlie, and we’re going to show how it positively impacted his life.   </p>
      <p>So, here’s our friend Charlie. Charlie just graduated from high school and he’s transitioning into college. What Charlie didn’t know is that he would have to balance his home life, where he has to contact his parents and grandparents every so often, with his school work, to arrange his exams and update his daily homework and whatnot. Along with these responsibilities, Charlie may be involved in club activities, work experience, travels, and social life. So why we’re here today is so that we can show you how we can help Charlie and others in his situation.  </p>
      <p>So, what is Charlie’s situation? Because of his daily responsibilities because of his transition from a high school to college student, Charlie’s having trouble with [inaudible]. Receiving unread emails, there’s no way for Charlie to [inaudible]. How can we help Charlie? Well, we have the solution for you. Throughout our presentation we will go in depth with our situation, which contains Customizable Inboxes and Personal Assistant, which will help Charlie start organized and stay organized. </p>
      <p>Through our customizable inboxes, users will have the ability to add as many inboxes as they desire. These inboxes can be named to reflect any way in which they wish to categorize, and they will be automatically categorized upon first manually importing keywords. Additionally, a main inbox will contain all emails, sorted and unsorted. </p>
      <p>So here we have the first layout, one of two. The first one shows the customizable tabs stacked on top of one another, and the second one here shows the tabs side by side one another to utilize more space. Now your emails are sorted out through your main mailbox and into these customizable tabs by manually entering keywords or specific emails when you initially create a new account or update your email. Now, relating it back to Charlie’s case, he has to manually input his coach’s email or keywords concerning his social, work, or school life in order for him to have a better transition to college. However, he does not have to do this alone. </p>
      <p>Charlie now has his own guide to assist him through Yahoo’s new features. Introducing: YoYahoo!, Yahoo’s new in-app mobile feature that allows users to easily navigate and organize their emails by saying YoYahoo!. This gives users the power to [inaudible]. And through speech recognition they will be able to have their own personal assistant at their hands. </p>
      <p>So our main target were users 18-35 years old and these new features and changes were specifically designed to help these users. But we want to make sure that we’re thinking about previous users who have been loyal. The majority of Yahoo users are older generations and they have been with Yahoo for ten plus years. So our main concern is making sure that they know they don’t have to use these new features. So if they’re not comfortable, then they just stick with the old design and don’t even have to worry about it. So when you log, or you don’t have to be a user, you can be a non-user or user, and when you go onto the Yahoo! homepage, there will be informational boxes that describe the customizable inbox and the customizable email colors and pictures and then YoYahoo. And there will be a video describing all of these new features and give you a little tutorial about each one. </p>
      <p>So all in all, how did we help Charlie? Through the customizable inboxes, now Charlie has a way of organizing and checking through his emails efficiently and effectively. But, through our refinement process, we were talking to the Braven alumni, we found this did not go far enough. It doesn’t allow for customizability. That’s why we added the YoYahoo assistant. So when Charlie’s hands are full, he can still call upon and search and sort his emails without having to have his [inaudible]. And as Ciara said, we do have a lot of users who are loyal, and they’re from the older generation that may not want to change. As you said on the homepage, there will be an option describing each of the new features and allowing for users to turn on these features. Thank you! Now we’ll open it up for questions.</p>

    ';
    bz_embed_video('vimeo','231612558','6:50',null,$transcript);
  bz_close_box(false);
  //
  bz_open_box('question', null, 'Rate this cohort&rsquo;s solution using the actual rubric your group will be evaluated by:', 'Rate the Solution');
  ?>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_7499" class="criterion" style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">1.1. Presenters identify users’ needs based in their own empathy research.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_blank" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_4629" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Connection between needs and research is vague.</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_7254" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Needs identified are not those of the users (e.g. the company’s needs).</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_blank_2" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Does not address.</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr>
                <?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_8812" class="criterion" style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">1.2. Presenters clearly define the problem and explain why it is important to address the problem.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_2872" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_7206" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Could be clearer in defining the problem.</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_5186" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Does not explain importance of addressing problem.</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_6361" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Does not address.</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_3125" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">1.3. Presenters pitch their top design solution and explain how their prototype solves the given problem.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_2825" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_2122" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Could be clearer in connecting the solution to the problem.</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_2653" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Doesn't explain how solution solves problem.</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_9209" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Does not address.</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_9006" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">1.4. Presenters describe the feedback they received when testing their prototype and how they iterated to improve the prototype.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_9543" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_3417" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Could be clearer in connecting improvements to feedback.</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_6743" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Describes testing but not improvements.</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_7978" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Does not address.</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_661" class="criterion" style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">1.5. Design solution is original and provides a unique value-add unlike other solutions that have been built.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_938" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_5921" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Solution is somewhat unique.</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_2562" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Solution is similar to many other solutions.</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_1708" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Solution seems to copy other solutions.</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <?php
    $GLOBALS['for'] = 'for-eval-sum';
  bz_close_box();
  //
  bz_open_box('answer',null,'Total score for this rubric section');
  ?>
  <p>You gave: <span class="bz-show-eval-sum">0</span> points out of a possible <span class="bz-show-eval-max">&nbsp;</span>.</p>
  <p>Here's how the Braven team would have scored this solution:</p>
  <ul>
    <li><p>1.1. Presenters identify users’ needs based in their own empathy research.</p>
      <p><strong>10</strong> Meets or exceeds</p></li>

    <li><p>1.2. Presenters clearly define the problem and explain why it is important to address the problem.</p>
      <p><strong>8</strong> Could be clearer in defining the problem</p></li>
    
    <li><p>1.3. Presenters pitch their top design solution and explain how their prototype solves the given problem.</p>
      <p><strong>8</strong> Could be clearer in connecting the solution to the problem</p></li>
    
    <li><p>1.4. Presenters describe the feedback they received when testing their prototype and how they iterated to improve the prototype.</p>
      <p><strong>8</strong> Could be clearer in connecting improvements to feedback</p></li>
    
    <li><p>1.5. Design solution is original and provides a unique value-add unlike other solutions that have been built.</p>
      <p><strong>6</strong> Solution is similar to many other solutions</p></li>

    <li>1.6. (Skipped in this exercise)</li>
  </ul>
  <p>Total: 40 points out of a possible <span class="bz-show-eval-max">&nbsp;</span>.</p>
  <?php
  bz_close_box();
  //
  bz_open_box('question','Now rate their oral presentation using the actual rubric your group will be evaluated by:','Rate the Oral Presentation');
  ?>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_6267" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.1. Language and posture match the level of formality and demonstrate positivity, curiosity, respect and humility.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_4638" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_1571" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">1 presenter does not meet expectation</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_4741" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">2-3 presenters do not meet</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_2620" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">4+ presenters do not meet</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_8825" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.2. Presentation opens with a team introduction, including names, Braven cohort, and closes by thanking the audience and evaluators.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_8207" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_7258" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Includes introduction AND closing, but incomplete</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_5223" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Includes introduction OR closing</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_8047" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Does not include either</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>     
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_2744" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.3. All presenters are dressed appropriately in business casual attire (no jeans).</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_2760" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_2222" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">1 presenter dressed inappropriately</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_7562" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">2 presenters dressed inappropriately</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_1786" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">3+ presenters dressed inappropriately</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_7642" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.4. All cohort members contribute to the presentation (e.g. Clearly planned roles).</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_6130" class="rating edge_rating">
                <div class="container">
                  <div class="description rating_description_value">Meets or exceeds</div>
                  <span class="nobr"><span class="points">10</span> pts</span>
                </div>
              </td>
              <td id="rating_45_4806" class="rating ">
                <div class="container">
                  <div class="description rating_description_value">All members contribute, but  Planned roles are not apparent</div>
                  <span class="nobr"><span class="points">8</span> pts</span>
                </div>
              </td>
              <td id="rating_45_8400" class="rating ">
                <div class="container">
                  <div class="description rating_description_value">1 member does not contribute, planned roles may not be apparent</div>
                  <span class="nobr"><span class="points">6</span> pts</span>
                </div>
              </td>
              <td id="rating_45_8410" class="rating edge_rating">
                <div class="container">
                  <div class="description rating_description_value">2+ members do not contribute, planned roles may not be apparent</div>
                  <span class="nobr"><span class="points">0</span> pts</span>
                </div>
              </td>
            </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
          </tbody>
        </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_4690" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.5. Presenters speak with minimal verbal ticks and fillers.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_8392" class="rating edge_rating">
                <div class="container">
                  <div class="description rating_description_value">Meets or exceeds</div>
                  <span class="nobr"><span class="points">10</span> pts</span>
                </div>
              </td>
              <td id="rating_45_9453" class="rating ">
                <div class="container">
                  <div class="description rating_description_value">1 presenter noticeably has ticks and fillers</div>
                  <span class="nobr"><span class="points">8</span> pts</span>
                </div>
              </td>
              <td id="rating_45_434" class="rating ">
                <div class="container">
                  <div class="description rating_description_value">2-3 presenters noticeably have ticks and fillers</div>
                  <span class="nobr"><span class="points">6</span> pts</span>
                </div>
              </td>
              <td id="rating_45_2623" class="rating edge_rating">
                <div class="container">
                  <div class="description rating_description_value">4+ presenters noticeably have ticks and fillers</div>
                  <span class="nobr"><span class="points">0</span> pts</span>
                </div>
              </td>
            </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
          </tbody>
        </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_1407" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.6. The presentation concludes with a clear, final summary of the main points.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_9177" class="rating edge_rating">
                <div class="container">
                  <div class="description rating_description_value">Meets or exceeds</div>
                  <span class="nobr"><span class="points">10</span> pts</span>
                </div>
              </td>
              <td id="rating_45_1193" class="rating ">
                <div class="container">
                  <div class="description rating_description_value">Includes a  Final summary of main points, but could be clearer</div>
                  <span class="nobr"><span class="points">8</span> pts</span>
                </div>
              </td>
              <td id="rating_45_6213" class="rating ">
                <div class="container">
                  <div class="description rating_description_value">Includes a final summary, but does not focus on most important points</div>
                  <span class="nobr"><span class="points">6</span> pts</span>
                </div>
              </td>
              <td id="rating_45_6668" class="rating edge_rating">
                <div class="container">
                  <div class="description rating_description_value">Does not include a final summary</div>
                  <span class="nobr"><span class="points">0</span> pts</span>
                </div>
              </td>
            </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
          </tbody>
        </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_6333" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.7. The presentation does not go on past 7 minutes.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_8542" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_9492" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Between 7 mins and 7 mins 30 secs</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_5059" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Between 7 mins 30 secs and 8 mins</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_5292" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Over 8 mins</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_8493" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.8. Fellows do not read from slides/notes or sound robotic.</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_6850" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Meets or exceeds</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_2613" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">1 presenter reads or sounds robotic</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_9040" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">2-3 presenters read or sound robotic</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_228" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">4+ presenters read or sound robotic</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="bz-rubric-self-eval bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr id="criterion_45_6885" class="criterion   " style="">
          <td class="criterion_description hover-container">
            <div class="container">
              <span class="description criterion_description_value">2.9. I feel connected to the presenters and/or the content (e.g., through compelling data, use of story, or other techniques to connect to the audience).</span>
            </div>
          </td>
          <td style="padding: 0;">
            <table class="ratings" style="">
              <tbody>
                <tr>
                  <td id="rating_45_4316" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Includes compelling data and/or use of story to connect</div>
                      <span class="nobr"><span class="points">10</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_2774" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">I feel generally connected</div>
                      <span class="nobr"><span class="points">8</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_5506" class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">I feel somewhat connected</div>
                      <span class="nobr"><span class="points">6</span> pts</span>
                    </div>
                  </td>
                  <td id="rating_45_8868" class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">I don't feel connected</div>
                      <span class="nobr"><span class="points">0</span> pts</span>
                    </div>
                  </td>
                </tr><?php bz_make_inputs_for_self_eval_rubrics(); ?>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying">
              <span style="white-space: nowrap;">=
                <span class="display_criterion_points">10</span> pts<br>
              </span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


 <?php
  $GLOBALS['for'] = 'for-eval-sum';
  bz_close_box();
  ?>
  <?php 
  bz_open_box('answer');
  ?>
  <p>You gave: <span class="bz-show-eval-sum">0</span> points out of a possible <span class="bz-show-eval-max">&nbsp;</span>.</p>
  <p>Here's how the Braven team would have scored this oral presentation:</p>
  <ul>
    <li><p>2.1. Language and posture match the level of formality and demonstrate positivity, curiosity, respect and humility.</p>
      <p><strong>10</strong> Meets or exceeds</p></li>

    <li><p>2.2. Presentation opens with a team introduction, including names, Braven cohort, and closes by thanking the audience and evaluators.</p>
      <p><strong>10</strong> Meets or exceeds</p></li>
    
    <li><p>2.3. All presenters are dressed appropriately in business casual attire (no jeans). </p>
      <p><strong>10</strong> Meets or exceeds</p></li>
    
    <li><p>2.4. All cohort members contribute to the presentation (e.g. clearly planned roles).</p>
      <p><strong>10</strong> Meets or exceeds</p></li>
    
    <li><p>2.5. Presenters speak with minimal verbal ticks and fillers.</p>
      <p><strong>8</strong> One presenter noticeably has ticks and fillers</p></li>

    <li><p>2.6. The presentation concludes with a clear, final summary of the main points.</p>
      <p><strong>10</strong> Meets or exceeds</p></li>

    <li><p>2.7. The presentation does not go on past 7 minutes.</p>
      <p><strong>10</strong> Meets or exceeds</p></li>

    <li><p>2.8. Fellows do not read from slides/notes or sound robotic.</p>
      <p><strong>10</strong> Meets or exceeds</p></li>

    <li><p>2.9. I feel connected to the presenters and/or the content (e.g., through compelling data, use of story, or other techniques to connect to the audience).</p>
      <p><strong>8</strong> I feel generally connected</p></li>
  </ul>
  <p>Total: 86 points out of a possible <span class="bz-show-eval-max">&nbsp;</span>.</p>
  <?php
  bz_close_box();
  //
  bz_open_box('action','Your own cohort will also be assessed on your presentation deck, but because it’s a bit hard to see in the video, you don’t have to assess this cohort on their deck.', 'Assessing the presentation deck');
  bz_close_box(false);
  //
  bz_open_box('pulse','After watching this presentation and evaluating it, what does it make you think about your own cohort’s presentation?');
    $items = array(
      array(
        'content'=>'We have a lot more work to do.',
        'feedback' => 'Try to map out where your group needs the most improvement and focus your rehersals on these areas',
      ),
      array(
        'content'=>'We should work out some last-minute kinks. ',
        'feedback' => 'Very good idea!',
      ),
      array(
        'content'=>'We’re going to win thing thing! ',
        'feedback' => 'It&rsquo;s good to have confidence! Just make sure you&rsquo;re not being recklessly overconfident, and keep rehersing and polishing your presentation until you go on stage.',
      ),
    );
    bz_make_cr_list($items, 'radio-list');
    bz_make_textarea( array('other'=>true) );
  bz_close_box();
  //
  bz_open_box('question','For the Capstone Presentations, you’ll need to be professionally dressed. This means an appropriate outfit would be… (check all that apply)');
  ?>
  <table class="no-zebra instant-feedback equal-column-widths">
    <tbody>
      <tr>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12744/preview" alt="a man in a business suit and tie" /></td>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12745/preview" alt="a woman in a business suit" /></td>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12752/preview" alt="a woman in a sleeveless summer dress" /></td>
      </tr>
      <tr>
        <td class="correct"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
        <td class="correct"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
        <td class="incorrect"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
      </tr>
      <tr>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12748/preview" alt="a man in a bright green t-shirt and sweatpants" /></td>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12747/preview" alt="a man in a light blue button shirt and dark pants with a brown belt" /></td>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12749/preview" alt="a man in a plaid button shirt and jeans" /></td>        
      </tr>
      <tr>
        <td class="incorrect"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
        <td class="correct"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
        <td class="incorrect"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
      </tr>
      <tr>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12750/preview" alt="a woman in a short denim skirt and black sweater" /></td>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12751/preview" alt="a woman in a sleeveless shirt and gray skinny jeans" /></td>
        <td><img style="width:100%; height: auto;" src="/courses/1/files/12746/preview" alt="a woman in an understated elegant knee-high, short sleeve dress and beige high heel shoes" /></td>
      </tr>
      <tr>
        <td class="incorrect"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
        <td class="incorrect"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
        <td class="correct"><input type="checkbox" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" /></td>
      </tr>
    </tbody>
  </table>
  <?php
  bz_close_box();
  ?>
  <blockquote>If you have any remaining questions about whether your presentation outfit is professional, ask your Leadership Coach.</blockquote>
  <?php
  bz_open_box('reflection','Whatever you can’t check off now, be sure you can by the time you present! ','Are you and your cohort prepared to present?');
    $items = array(
      'I know where the presentations are happening (e.g. building and room number)',
      'I know what I’m going to wear ',
      'I know that each member of my cohort will participate in the presentation ',
      'I’ve practiced my speaking part in the presentation and feel confident ',
      'My cohort has rehearsed the entire presentation and it’s under 7 minutes ',
      'Everyone in my cohort knows their talking points and when they speak',
      'My cohort has completed a final edit of the presentation deck ',
      'My cohort’s Lead Deck Designer has submitted the presentation deck on the Portal',
    );
    bz_make_simple_checklist($items);
  bz_close_box();
  ?>
  <h3>How do I calm my nerves before a big presentation?</h3>
  <?php 
  bz_open_box('pulse','How nervous do you get before a big presentation, on a scale from 1 (not nervous at all) to 10 (very nervous)?'); ?>

    <table class="no-zebra instant-range-feedback" style="table-layout: fixed;">
      <tbody>
        <tr>
          <td style="font-size: 0.8em; text-align: center; width: 34%;">&nbsp;</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">n/a</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">1</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">2</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">3</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">4</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">5</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">6</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">7</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">8</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">9</td>
          <td style="font-size: 0.8em; text-align: center; width: 6%;">10</td>
        </tr>
        <tr class="inputs-row">
          <td>My confidence level is...</td>
          <td colspan="11">
            <input max="10" min="0" step="1" type="range" value="0" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id(); ?>" />
            <div class="display-value"><span class="current-value">&nbsp;</span></div>
          </td>
        </tr>
        <tr>
          <td colspan="12">
            <div class="feedback" data-bz-range-flr="0" data-bz-range-clg="8">
              <p>You’re not alone. As you learned in the previous module, people are often more scared of public speaking than their own death. Thankfully, tried and true strategies can help, and we'll look at some of those now.</p>
            </div>
            <div class="feedback" data-bz-range-flr="8" data-bz-range-clg="10"><p>Nerves of steel! Try to share some of your tips and reassure any team mates who are not as confident.</p></div>
          </td>
        </tr>
      </tbody>
    </table>
  <?php
  bz_close_box();
  //
  bz_open_box('action','These tips help some people calm their nerves before public speaking. Which ones will you try before the Capstone Presentation? (check all that apply)');
    $items = array(
      'Practice a ton so that you don’t even need to think once you get up to present; it will just flow.',
      'Visualize your success. Close your eyes and actually imagine yourself giving an effective presentation. Athletes do this all the time. ',
      'Take deep breaths. Inhale through your nose for three slow counts and exhale through your mouth for three slow counts. Deep breathing gives your brain more oxygen. ',
      'Exercise lightly right before the presentation by walking up and down the hall or doing some stretches. It will help you release excess energy. ',
      'Remember the three “audience truths”: 1) They believe you’re the expert, 2) They want you to succeed, and 3) They won’t know when you make a mistake.',
      'Smile sincerely. It releases chemicals in your brain that calm nerves and promote well-being.' ,
      'Remember you don’t look as nervous as you feel. It’s true - the audience only sees how you act, not what you’re feeling on the inside! ',
    );
    bz_make_simple_checklist($items);
  bz_close_box();
  //
  bz_open_box('video','One more strategy you can use is called a Power Pose. Braven Fellows in the past have cited this video as one of their favorites!');
    bz_embed_video('yt','Ks-_Mh1QhMc?start=600','21 minutes, but you can skip to the 10 minute mark','Amy Cuddy, Associate Professor at Harvard Business School, explains how the Power Pose idea works in presentations and interviews, and shares her moving personal story.',null,'Closed captions available in several languages');
  bz_close_box();
  //
  ?>
  <h2 id="wrap-up">Wrap-up</h2>
  <p>In this module we looked at a few final things to prepare for the Capstone presentation:</p>
  <ul>
    <li>We got a closer look at Capstone Challenge rubrics by rating a past cohort's solution and presentation.</li>
    <li>We played a game of What Not to Wear to understand what the expected dress code is at the Capstone presentations (and the mainstream dress code in many work places).</li>
    <li>We considered some ideas for calming the nerves and getting mentally prepared for presenting in front of the judges.</li>
  </ul>
  <h3>Next Steps</h3>
  <p>Remember that your cohort <strong>must <a href="/courses/1/assignments/684">submit your final Capstone Presentation deck</a></strong> (as a PDF <strong>and</strong> as a link) before Learning Lab begins!</p>
  <blockquote>Good luck on your Capstone Presentation! See you on the other side...</blockquote>
</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>