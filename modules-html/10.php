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
$GLOBALS['namespace']='cskickoff';
?>
<div class="bz-module">
  <h2 id="why">Why is this important?</h2>
  <?php openbox('question','This is the intro'); ?>
    <?php
    $items = array(
      array('correctness' => 'correct', 'content' => 'Using a <span class="bz-has-tooltip" title="Methodical, using a plan">systemic</span> approach will lead to solutions that are less subjective and less impacted by biases or perceptions.'),
      array('correctness' => 'correct', 'content' => 'You will find it easier to present your solution to the rest of the team if it is backed by a clear rationale.'),
      array('correctness' => 'incorrect', 'content' => 'You will have to rely on luck to figure things out.'),
      array('correctness' => 'incorrect', 'content' => 'You will use process of elimination and try all sorts of things that don&rsquo;t work.')
    );
    ?>
    <?php makecrlist($items, 'checklist'); ?>
  <?php closebox(); ?>
  <?php openbox(); ?>
    <?php $items = array(
      array(
        'correctness' => 'correct', 
        'content' => 'A description of the logical, step-by-step framework he would follow to solve the problem', 
        'feedback' => 'Correct! You want to see how he wraps his head around problems and that he approaches them systematically.'
      ),
      array(
        'correctness' => 'incorrect', 
        'content' => 'He won&rsquo;t sleep until he solves the problem', 
        'feedback' => 'You want to know that he will work smart, not just work hard. Being well-rested is important for solving problems well!'
      ), 
      array(
        'correctness' => 'incorrect', 
        'content' => 'He will ask the appropriate person at the company for help', 
        'feedback' => 'You want to know how he would try to solve the problem before asking for help. Asking for help isn&rsquo;t a bad thing, but if he&rsquo;s always reliant on others to solve problems for him, he won&rsquo;t be an asset to the team.'
      ), 
      array(
        'correctness' => 'incorrect', 
        'content' => 'A list of all the possible solutions', 
        'feedback' => 'This might make you think he jumps to conclusions without any process, which could mean he a) will make a lot of mistakes, and b) will waste a lot of time until he finds the right solution (if he ever does).'
      ) 
    );
    ?>
    <?php makecrlist($items, 'radio-list'); ?>
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