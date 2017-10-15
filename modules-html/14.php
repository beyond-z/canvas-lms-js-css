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
            <input max="10" min="0" step="1" type="range" value="0" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id(); ?>" />
            <div class="display-value"><span class="current-value">&nbsp;</span></div>
          </td>
        </tr>
        <tr>
          <td colspan="12">
            <div class="feedback" data-bz-range-flr="0" data-bz-range-clg="8">
              <p>It's extremely common for even the most experienced presenters to get a bit jittery before showtime. Keep reading for some advice on preparing for the presentations and being calm and confident on stage.</p>
            </div>
            <div class="feedback" data-bz-range-flr="8" data-bz-range-clg="10"><p>Good for you! This means your team can rely on you to be their rock.</p></div>
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
  bz_open_box('question', null, 'Now rate the presentation using the actual rubrics');
  ?>
  <div>
    <table class="bz-ajax-loaded-rubric bz-ajax-loaded">
      <tbody>
        <tr class="criterion">
          <td class="criterion_description hover-container">
            <div class="container"><span class="description criterion_description_value"> 1.3. Fellow writes a compelling Reflected Best-Self Portrait grounded in examples. </span></div>
          </td>
          <td>
            <table class="ratings">
              <tbody>
                <tr>
                  <td class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Writes a narrative built on 3 strengths AND Includes specific examples from own life for each.</div>
                      <span class="nobr"> <span class="points">10.0</span> pts</span> <span class="rating_id" style="display: none;">42_133</span>
                    </div>
                  </td>
                  <td class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Writes a narrative built on 3 strengths AND Includes specific examples from own life for 1-2.</div>
                      <span class="nobr"> <span class="points">8.0</span> pts </span>
                    </div>
                  </td>
                  <td class="rating ">
                    <div class="container">
                      <div class="description rating_description_value">Writes a narrative built on 1-2 strengths OR Does not include specific examples from own life.</div>
                      <span class="nobr"> <span class="points">6.0</span> pts </span>
                    </div>
                  </td>
                  <td class="rating edge_rating">
                    <div class="container">
                      <div class="description rating_description_value">Does not complete a portrait.</div>
                      <span class="nobr"><span class="points">0.0</span> pts</span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
          <td class="nobr points_form">
            <div class="displaying"><span style="white-space: nowrap;"> <span class="display_criterion_points"> 10.0 </span> pts<br> </span></div>
            <div class="ignoring">--</div>
          </td>
          <td class="editing">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
  bz_close_box();
  ?>
  <h3>How do I calm my nerves before a big presentation?</h3>

 
')
  ?>
</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>