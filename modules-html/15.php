<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Module 15 Live your Legacy</title>
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
$ns = 'lyl';
require('functions.php');
?>
<div class="bz-module">
  <p>This module is all about reflecting on your Braven exeprience and where you're going from here.</p>
  <h2 id="why">Why is this important?</h2>
  <?php
  bz_open_box('question', 'You’re interviewing a candidate to join your team at work. Which impression would you prefer to get from him?');
    $items = array(
      'He knows what he’s accomplished, how he still needs to grow, and what he wants to do with his life',
      'He’s not sure yet what he wants to do, but this job will help him find out',
      'He has no flaws and his purpose is clear ',
      'He’s made a lot of mistakes in his life ',
    );
    bz_make_radio_list($items);
  bz_close_box();
  //
  bz_open_box('answer','Being able to articulate the legacy you want to live not only helps you get clearer on who you are what you want to do, but helps others understand you too.');
  //
  bz_open_box('read','Every other Braven Fellow who has come before you has reflected on how they will Live their Legacy at the end of the Braven Accelerator. Here are some of their Facebook posts:','What are other Fellows thinking?');

  bz_close_box();
  ?>
  <h2 id="how">How do I do this?</h2>
  <h3>How do I Live my Legacy?</h3>
  <?php
  bz_open_box('question','As you know by now, one of Braven’s core values is Live Your Legacy. What does it mean to live your legacy?');
    $items = array(
      'Your everyday actions align with your purpose ',
      'You live the way others expect you to ',
      'You succeed at everything you set out to do ',
      'Everything you do is for the good of others ',
    );
    bz_make_radio_list($items);
  bz_close_box();
  //
  bz_open_box('answer',null,'One definition to consider');
  ?>
    <p>This is how entrepreneur Glenn Llopis defines living your legacy:</p>
    <div class="bz-example">
      <blockquote>
        “Legacy represents your body of work at each stage of your career as you establish the foundational building blocks and accumulate the required wisdom to contribute to growth, innovation and opportunity both in and outside of the workplace. Your legacy grows with each new experience, with each previously untested idea and bold ideal that you are courageous enough to deploy, and each time you inspire others to see something through to fruition. For many, leaving a legacy is associated with the end rather than the beginning or the next phase in one’s career. Your leadership is not shaped and your legacy is not defined at the end of the road but rather by the moments shared, the decisions made, the actions taken, and even the mistakes overcome throughout the many phases of your career.”
      </blockquote>
    </div>
    <p><small>You can read a full article he wrote on legacy here: <a href="https://webcache.googleusercontent.com/search?q=cache:MGdpJMjPV_IJ:https://www.forbes.com/sites/glennllopis/2014/02/20/5-ways-a-legacy-driven-mindset-will-define-your-leadership/+&cd=1&hl=en&ct=clnk&gl=us">part 1</a> <a href="https://webcache.googleusercontent.com/search?q=cache:XJZLTS2uPBgJ:https://www.forbes.com/sites/glennllopis/2014/02/20/5-ways-a-legacy-driven-mindset-will-define-your-leadership/2+&cd=3&hl=en&ct=clnk&gl=us">part 2</a>.</small></p>

  <?php
  bz_close_box();
  ?>


Know who you are and what is important to you
  Can you articulate who you are now, your values, your skills, and ways of being that make you distinctly you?
  What enduring beliefs guide your leadership?
  What is the tone of your leadership?
  What have you accomplished or what are you accomplishing and why?
  What is your purpose?
Identify the kind of impact you want to have on others
  What skills or knowledge have you gained that you want to share with others? 
  What have you learned from others or through your experiences that you will you pass onto others?
Determine what you will do and do it
  What still remains to be accomplished? 
  What do you want to do in your life? 
  What are the very next thing you will do?


  <h3>How do I write my Legacy Reflection?</h3>
  <h3>How do I stay involved with Braven?</h3>


</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>