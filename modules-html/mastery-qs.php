<!DOCTYPE HTML>
<?php
ini_set('error_reporting', E_ALL);
?>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mastery Questions Generator</title>
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
<link rel="stylesheet" type="text/css" href="ui.css">
</head>
<body>
<?php 
$ns = 'masteryq';
require('functions.php');
?>
<div class="bz-module">

<!-- Ace Interviews -->

<?php bz_open_box(); ?>
<p>It's a few minutes before your phone interview and you're ready to go. You have a notebook and pen to take notes on the questions the interviewer asks you. Your phone shows four bars of service and 97% battery. Perfect. You check your email one more time and confirm that the interviewer will be calling you. A glass of water is ready in front of you on the table in case you need it.</p> 
<p>What's missing from this picture?</p>
<?php
$items = array(
  'Headphones',
  'A place with good phone service',
  'A script of how you will answer questions',
  'A professional outfit',
);

bz_make_radio_list($items, null, null, true);
bz_close_box(); ?>

<?php
bz_open_box('answer', 'Headphones don&rsquo;t just provide better sound quality; They also free up your hands to take notes and to <span class="bz-has-tooltip" title="To make hand gestures especially while speaking, to emphasize what you&rsquo;re saying.">gesticulate</span>, which makes you sound more natural and engaging.');
?>
<?php bz_close_box(); ?>

<!-- x -->

<?php bz_open_box(); ?>
<p>Lauren was asked: "What kind of leader are you?" Her response:</p>
<blockquote>I'm a leader who stands up for what is right, even if it's the unpopular opinion. For example, I used to work at a restaurant as a server. I overheard some other servers talking about giving discounts to friends, even though our manager clearly said that wasn't allowed. I told them that they could get in trouble and it wasn't right, but they laughed at me and told me it was fine and that I should also give my friends discounts. A few days later, the manager asked me about some issues with discounts. It was challenging, because I didn't want to throw my colleagues under the bus, but I also knew that they had knowingly been cheating the restaurant.</blockquote>
<p>How could Lauren improve her response to the interview question?</p>
<?php 

$items = array(
  array(
    'content' => 'She could talk about the choice she made and the result of what she did.',
    'feedback' => 'Those would add the missing Y (<b>Y</b>our role) and R (<b>R</b>esults) of SYRCL.',
    'correctness' => 'correct',
  ),
  array(
    'content' => 'She could explain the situation in more detail.',
    'feedback' => 'Lauren did explain the situation in enough detail to give context, but she missed the opportunity to talk about the choice she ended up making (her role in the situation) and the results of that decision.',
    'correctness' => 'incorrect',
  ),
  array(
    'content' => 'She could explain the challenges she faced.',
    'feedback' => 'Lauren did explain the challenge and why her choice was hard, but she missed the opportunity to talk about the choice she ended up making (her role in the situation) and the results of that decision.',
    'correctness' => 'incorrect',
  ),
  array(
    'content' => 'She could explain the lesson she learned about what kind of leader she is.',
    'feedback' => 'Lauren actually opens with the lesson she had learned, but she missed the opportunity to talk about the choice she ended up making (her role in the situation) and the results of that decision.',
    'correctness' => 'incorrect',
  ),
);

bz_make_radio_list($items, null, null, true);
bz_close_box(); ?>

<?php bz_open_box('answer', 'Lauren&rsquo;s story is incomplete and therefore not as effective as it could be. It is missing two critical elements that could have demonstrated the kind of leader she is: the role she decided to take within the situation, and the results of her decision.'); ?>

<?php bz_close_box(false);
?>

<!-- x -->

<?php bz_open_box(); ?>
<p>At his interview, Jermaine was asked, "What's your greatest weakness?" Here's how he responded:</p>
<blockquote>My greatest weakness is that I'm a perfectionist. I care deeply about the quality of my work and others', but sometimes it means that I focus too much on the details and end up working long hours to get a project done.</blockquote>
<p><strong>What can Jermaine do to improve his response to this question?</strong></p>

<?php 
$items = array(
  array(
    'content' => 'He can explain what steps he&rsquo;s taking to improve.',
    'feedback' => 'Correct! When fielding this kind of question, it&rsquo;s important to explain how you&rsquo;re turning your weakness into a strength. One way to approach this question is to talk about a weakness you used to have and that you&rsquo;ve already improved upon.',
    'correctness' => 'correct',
  ),
  array(
    'content' => 'He can be more self-reflective.',
    'feedback' => 'Incorrect. Jermaine is being self-reflective in that he knows he&rsquo;s perfectionist and understands how this affects his work. ',
    'correctness' => 'incorrect',
  ),
  array(
    'content' => 'He can choose a different weakness.',
    'feedback' => 'Incorrect. Focusing on perfectionism is fine. What he needs to explain is how he is improving upon this weakness. ',
    'correctness' => 'incorrect',
  ),
  array(
    'content' => 'He can say he doesn&rsquo;t have any weaknesses.',
    'feedback' => 'Incorrect. Everyone has weaknesses, so it&rsquo;s not an option to say you don&rsquo;t have any. It also makes you seem like you lack self-awareness and are overly confident. ',
    'correctness' => 'incorrect',
  ),

);

bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', 'An experienced interviewer has probably heard the "perfectionist" answer many times before. Jermaine (and you) can stand out by demonstrating real self-improvement rather than just "checking the box".'); ?>
<?php bz_close_box(false); ?>

<!-- x -->

<?php bz_open_box(); ?>

<p>The following audio&nbsp;describes an applicant's preparation for a phone interview for an entry-level research role at Genentech. <strong>Which best practice for getting ready for an interview did this applicant miss</strong>?</p>
<p><iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/250748264%3Fsecret_token%3Ds-T0YHr&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false" width="100%" height="166" frameborder="no" scrolling="no"></iframe></p>

<?php 
$items = array(
  array(
    'content' => 'Reach out for connections with people who work at Genentech', 
    'feedback' => 'Correct. This was a major missed opportunity for this job applicant to prepare for their interview.<br />To make their interview prep even stronger, they should have searched the company on LinkedIn to look for common connections, or asked their Leadership Coach or Braven staff if they have connections. Getting connected and requesting an informational interview can help you learn more about the organization and get the inside scoop on lots of knowledge that might not be publicly known or shared. ',
    'correctness' => 'correct',
  ),
  array(
    'content' => 'Check Genentech&rsquo;s website', 
    'feedback' => 'Incorrect. This job applicant was thorough in their review of the company&rsquo;s website, as well as their social media profiles. They also took notes to review before the interview, which is strongly recommended.',
    'correctness' => 'incorrect',
  ),
  array(
    'content' => 'Have all the answers', 
    'feedback' => 'Incorrect. This job applicant was thorough in predicting the interview questions that they might be asked, and preparing their responses to each of those questions. That this job applicant also took the time to practice their interview with a peer is strongly recommended.',
    'correctness' => 'incorrect',
  ),
  array(
    'content' => 'Don&rsquo;t lose sight of the forest for the trees', 
    'feedback' => 'Incorrect. This job applicant spent the time to make sure that each response to an interview question told a clear story for your interviewers to illustrate their accomplishments. Employers don&rsquo;t just want to hear you answer a bunch of questions. They want to understand you as a character in your own story. This job applicant took a look their own your resume and thought about the connections and common themes that could explain the arc of their academics, extracurricular activities, and work/volunteer experiences.',
    'correctness' => 'incorrect',
  ),
);

bz_make_radio_list($items, null, null, true); 
echo PHP_EOL;
bz_close_box(); ?>

<?php 
bz_open_box('answer', 'This was a major missed opportunity for this job applicant to prepare for their interview.'); ?>

<?php bz_close_box(false); ?>

<!-- DTS -->

<?php bz_open_box(); ?>
<p>What was the purpose of the team's bell? </p>
<?php 
$items = array(
  'To call out when someone criticizes an idea.',
  'To call out when someone jumps to conclusions too quickly',
  'To signal the start and end of the brainstorm session',
  'To call out when someone is going off topic ',
);

bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', 'The bell gives instant and quick feedback, so team members don&rsquo;t have to stop the flow of ideas, but can still improve their brainstorming skills.'); ?>
<?php bz_close_box();?>

<!-- DTS 2 -->

<?php bz_open_box(); ?>
<p>How did they determine the final prototype to build?</p>
<?php 
$items = array(
  'They took the best elements of each of the shopping carts the teams built',
  'They voted on the best shopping cart that the teams built with sticky notes',
  'They voted on the best shopping cart that the teams build by a show of hands',
  'They prioritized the most surprising insights from their user research',
);

bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', 'The key to effective brainstorming is to explore promising ideas no matter where they came from.'  ); ?>
<?php bz_close_box(); ?>

<!-- solve a case: -->

<?php bz_open_box(); ?>
<p>Why did the cohort pivot away from the prototype of a mentorship program?</p>
<?php 
$items = array(
  'The logistics and coordination were too difficult',
  'Raising money was a better solution to the problem',
  'The Fellows didn&rsquo;t think it was a good idea',
  'The school didn&rsquo;t let them set up the program', 
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', ''); ?>
<?php bz_close_box(); ?>


<!-- x -->

<?php bz_open_box(); ?>
<p>In the average workplace, what percentage of employees' time is spent in collaborative, team activities?</p>
<?php 
$items = array(
  '50%',
  '10%',
  '25%',
  '75%',
  '90%',
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', ''); ?>
<?php bz_close_box(); ?>

<!-- x -->

<?php bz_open_box(); ?>
<p>What is true of how the team prepared for the Capstone Presentation?</p>
<?php 
$items = array(
  'Each Fellow was responsible for creating one slide each',
  'They rehearsed several times the days right before the presentations',
  'They practiced their transitions between sections',
  'They revised their presentation after practicing it a few times',
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', ''); ?>
<?php bz_close_box(); ?>

<!-- CC DEFINE -->

<?php bz_open_box(); ?>
<p>What is one piece of advice about meetings that Katy does NOT give?</p>
<?php 
$items = array(
  'Summarize key points at the beginning of the meeting',
  'Have a clear purpose for the meeting ',
  'Send an agenda to colleagues before the meeting',
  'Stay on time and on task ',
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', 'Summarizing key points and determining next steps are an important part of the end of a meeting.'); ?>
<?php bz_close_box(); ?>

<!-- PROTOTYPE/FEEDBACK -->

<?php bz_open_box(); ?>
<p>Which of the following examples of feedback is <strong>NOT</strong> delivered in the STAR format?</p>
<?php 
$items = array(
  "Yesterday we had our first Learning Lab to kickoff the Capstone. When you came to our team meeting, you hadn't completed the pre-work. That made me feel like you weren't invested in our team or our success as a group.",
  "Last week I asked you to complete a spreadsheet on resource allocation. While you provided all of the data I asked for, I received it two days after I requested, because other priorities came up. Because the report was late, I had to delay a resource planning meeting with our director, and we weren't able to complete our resource plan for next term. The next time you're faced with competing priorities, feel free to come to me for further direction. That way I'll know if you're having challenges completing a request and can help you prioritize your assignments.",
  "Thanks for helping me with my report when I had to rush to the meeting. I appreciate your delivering it to Sue so quickly and spending time answering her questions. I wanted you to know that she called me back and said she was really impressed with our responsiveness and your knowledge of the project. It looks like she’s going to recommend our department for the job.",
  "I’ve noticed that you have come in to work at 9:30 AM three times this week. Your shift starts at 8:00 AM. It’s in our team agreement that we are all on time in the morning. Because you came into work later it meant that someone else had to answer both your phone and theirs and open the mail. It was extremely busy and being ‘one person down’ put a lot of unnecessary pressure on the rest of the team.",
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', 'This feedback is given in the When you did X, I felt Y framework. '); ?>
<?php bz_close_box(); ?>

<!-- REHEARSE -->

<?php bz_open_box(); ?>
<p>What is the simplest and most effective structure of your Capstone presentation?</p>
<?php 
$items = array(
  'Beginning, middle, end',
  'Story of Self, Us and Now',
  'Oscillate between what is and what could be',
  'Challenge, choice, outcome',
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', ''); ?>
<?php bz_close_box(); ?>

<!-- PRESENT -->

<?php bz_open_box(); ?>
<p>Amy Cuddy suggests that you fake it until you...</p>
<?php 
$items = array(
  'become it',
  'make it ',
  'succeed',
  'win',
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', ''); ?>
<?php bz_close_box(); ?>

<!-- x -->

<?php bz_open_box(); ?>
<p>How long should you hold a power pose for so that it positively affects you during your Capstone Presentation?</p>
<?php 
$items = array(
  '2 minutes',
  '30 seconds',
  'An hour',
  '20 minutes',
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', ''); ?>
<?php bz_close_box(); ?>

<!-- x -->

<?php bz_open_box(); ?>
<p>What does a power pose look like?</p>
<?php 
$items = array(
  '[IMG]',
  '[IMG]',
  '[IMG]',
  '[IMG]',
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', ''); ?>
<?php bz_close_box(); ?>

<!-- LYL -->

<?php bz_open_box(); ?>
<p>Which of these is <strong>NOT</strong> one of the responsibilities of a Cohort Captain?</p>
<?php 
$items = array(
  "Serve as a member of the Braven E-Board",
  "Organize at least one cohort reunion per semester ",
  "Communicate on college and career outcomes of your cohort members to the Braven team",
  "Post about your cohort members' wins on your regional Facebook group ",
);
bz_make_radio_list($items, null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', 'The Cohort Captain partners with the E-Board and attends necessary events but does not need to be an E-Board member.'); ?>
<?php bz_close_box(); ?>

<!-- FEEDBACK -->

<?php bz_open_box(); ?>
<p>Jenni likens giving feedback to a(n)...(check all that apply):</p>
<?php 
$items = array(
  array(
    'content' => 'muscle',
    'correctness' => 'correct',
  ),
  array(
    'content' => 'gift',
    'correctness' => 'correct',
  ),
  array(
    'content' => 'chore',
    'correctness' => 'incorrect',
  ),
  array(
    'content' => 'performance review ',
    'correctness' => 'incorrect',
  ),
  array(
    'content' => 'ego boost ',
    'correctness' => 'incorrect',
  ),
);
bz_make_cr_list($items, 'checklist', null, null, true);
?>
<?php bz_close_box(); ?>
<?php bz_open_box('answer', ''); ?>
<?php bz_close_box(); ?>

<!-- x -->

</div>
<script src="ui.js"></script>
</body>
</html>