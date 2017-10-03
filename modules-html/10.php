<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Module 10 Capstone Kickoff</title>
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
//$ns = 'csk';
require('functions.php');


?>
<div class="bz-module">
  <h2 id="why">Why is this important?</h2>
  <?php openbox('question','Why do employers look to hire good team players?'); ?>
    <?php
    $items = array(
      array('correctness' => 'correct', 'content' => 'Because a team&rsquo;s dynamics are more important to the success of a project than the talents of the individuals who make it up'),
      array('correctness' => 'incorrect', 'content' => 'Because having that competitive edge means you&rsquo;ll be successful no matter what role you’re in'),
      array('correctness' => 'incorrect', 'content' => 'Because there is no “I” in “team”'),
      array('correctness' => 'incorrect', 'content' => 'Because good team players are generally more persistent, motivated, and reliable')
    );
    ?>
    <?php makecrlist($items, 'radio-list'); ?>
  <?php closebox(); ?>
  <?php openbox('answer','A group of Google&rsquo;s <span class="bz-has-tooltip" title="Similar to Human Resources (HR)">People Operations</span> employees spent two years interviewing more than 200 Googlers across more than 180 teams to find out what distinguishes the most successful teams at Google, and their main finding was just that: a team&rsquo;s dynamics are more important to the success of a project than the talents of the individuals who make it up.'); ?>
  </div>
  <blockquote>
    "Never doubt that a small group of thoughtful, committed citizens can change the world; indeed, it's the only thing that ever has."<p class="quote-source">Margaret Mead</p>
  </blockquote>
  <h2 id="how">How do I do this?</h2>
  <h3>How do I build an effective team?</h3>
  <h4>Traits of effective teams</h4>
  <?php $$GLOBALS['hlevel'] = 5; ?>
  <?php openbox('question', 'That same Google study found that effective teams share five main characteristics. Select the 5 from this list:'); ?>
    <?php 
    $items = array(
      array(
        'correctness' => 'correct',
        'content' => 'Teams establish psychological safety'
      ),
      array(
        'correctness' => 'correct',
        'content' => 'Team members commit to being dependable '
      ),
      array(
        'correctness' => 'correct',
        'content' => 'Teams establish structure and clarity '
      ),
      array(
        'correctness' => 'correct',
        'content' => 'Teams must have a clear purpose '
      ),
      array(
        'correctness' => 'correct',
        'content' => 'Team members communicate frequently '
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'Team members commit to doing the same tasks '
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'Team members are good friends outside of work '
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'Team members all work out of the same office '
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'Teams are made up of the company&rsquo;s most talented individual contributors '
      ),
    );

    makecrlist($items) ?>
  <?php closebox();?>
  <h2 id="wrap-up">Wrap-up</h2>
  <div>
    <p>In this module we looked at </p>
    <ol>
      <li></li>
    </ol>
    <h3>Next Steps:</h3>
    <ul>
      <li></li>
    </ul>
  </div>
</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>