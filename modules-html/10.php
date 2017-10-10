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
$ns = 'csk';
require('functions.php');


?>
<div class="bz-module">
  <p>This module focuses on team working skills, ahead of your team project kick off in the upcoming Learning Lab.</p>
  <h2 id="why">Why are team working skills important?</h2>
  <?php bz_open_box('question','Why do employers look to hire good team players?'); ?>
    <?php
    $items = array(
      array('correctness' => 'correct', 'content' => 'Because a team&rsquo;s dynamics are more important to the success of a project than the talents of the individuals who make it up'),
      array('correctness' => 'incorrect', 'content' => 'Because having that competitive edge means you&rsquo;ll be successful no matter what role you’re in'),
      array('correctness' => 'incorrect', 'content' => 'Because there is no “I” in “team”'),
      array('correctness' => 'incorrect', 'content' => 'Because good team players are generally more persistent, motivated, and reliable')
    );
    ?>
    <?php bz_make_cr_list($items, 'radio-list'); ?>
  <?php bz_close_box(); ?>
  <?php bz_open_box('answer','A group of Google&rsquo;s <span class="bz-has-tooltip" title="Similar to Human Resources (HR)">People Operations</span> employees spent two years interviewing more than 200 Googlers across more than 180 teams to find out what distinguishes the most successful teams at Google, and their main finding was just that: a team&rsquo;s dynamics are more important to the success of a project than the talents of the individuals who make it up.'); ?>
  </div>
  <blockquote>
    "Never doubt that a small group of thoughtful, committed citizens can change the world; indeed, it's the only thing that ever has."<p class="quote-source">Margaret Mead</p>
  </blockquote>
  <h2 id="how">How do I do this?</h2>
  <h3>How do I build an effective team?</h3>
  <h4>Traits of effective teams</h4>
  <?php $GLOBALS['hlevel'] = 5; ?>
  <?php bz_open_box('question', 'That same Google study found that effective teams share five main characteristics. Select the 5 from this list:'); ?>
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

    bz_make_cr_list($items) ?>
  <?php bz_close_box();?>
  <?php bz_open_box('answer', 'Let&rsquo;s take a closer look at these five elements:');?>
  <table class="no-zebra">
    <tbody>
      <tr>
        <td style="width: 25%;"><img style="width: 100%; height: auto;" src="/courses/1/files/11821/preview" alt="" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/1/files/11821" data-api-returntype="File" /></td>
        <td style="width: 50%;" colspan="2">
          <h6>1. Teams establish psychological safety.&nbsp;</h6>
          <p>Psychological safety - or the shared belief that the team is safe for interpersonal risk taking - was far and away the most important of the five dynamics Google&nbsp;found.&nbsp;It sounds simple, but establishing an environment where teammates feel safe to&nbsp;ask&nbsp;questions, give suggestions, or share open and honest feedback&nbsp;requires work.&nbsp;Individuals on teams with higher psychological safety are more likely to harness the power of diverse ideas from their teammates and operate twice as&nbsp;effectively as other teams.</p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <h6>2. Team members commit to being&nbsp;dependable.&nbsp;</h6>
          <p>When team members get things done on time and meet a shared&nbsp;high bar of excellence, teams will operate more effectively.&nbsp;It takes an average of six weeks to gel as a team, and&nbsp;as soon as members&nbsp;become&nbsp;lax with their demanding responsibilities, the entire team suffers.</p>
        </td>
        <td style="width: 25%;"><img style="width: 100%; height: auto;" src="/courses/1/files/11822/preview" alt="" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/1/files/11822" data-api-returntype="File" /></td>
      </tr>
      <tr>
        <td><img style="width: 100%; height: auto;" src="/courses/1/files/11823/preview" alt="" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/1/files/11823" data-api-returntype="File" /></td>
        <td colspan="2">
          <h6>3. Teams establish&nbsp;structure and clarity.&nbsp;</h6>
          <p>Trust is built by agreeing on clear roles, plans, and goals. These roles, plans, and goals need to personally resonate with each of the teammates, or else they will not be working to their full potential and pushing themselves to new limits.</p>
          <p>It is a team manager's responsibility to ensure that no team member starts phoning&nbsp;it in. However, it also is essential that team managers monitor their employees without micromanaging.</p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <h6>4. teams must have a clear purpose.</h6>
          <p>Every team needs to ask itself, "Do we fundamentally believe that what we're doing matters?" Seeking consensus on the problem that you will solve is step one. Then make sure your team is all rowing in the same direction to make sure that you all are invested in making a tangible&nbsp;impact.</p>
        </td>
        <td><img style="width: 100%; height: auto;" src="/courses/1/files/11824/preview" alt="" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/1/files/11824" data-api-returntype="File" /></td>
      </tr>
      <tr>
        <td><img style="width: 100%; height: auto;" src="/courses/1/files/11825/preview" alt="" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/1/files/11825" data-api-returntype="File" /></td>
        <td colspan="2">
          <h6>5. Team members communicate frequently.&nbsp;</h6>
          <p>On a typical team,&nbsp;a dozen or so communication exchanges per working week&nbsp;may turn out to be optimum. It's also critical that teams&nbsp;spend&nbsp;time communicating outside of formal meetings, as increasing opportunities for informal communication tends to increase team performance. However, it's critical that team members talk and listen with equal measure. Lower performing teams have dominant members, teams within teams, and members who talk or listen but don&rsquo;t do both.&nbsp;</p>
        </td>
      </tr>
    </tbody>
  </table>
  <?php bz_close_box();?>
  <?php bz_open_box('reflection', 'Think about your own cohort as a team. You’ve been working as a team all semester, and you’re about to begin an intense project, the Capstone Challenge, as a team. Rate your cohort on the five effective team characteristics: (1=poor, 5=excellent)');?>
    <?php 
      $items = array(
        'Your cohort feels safe',
        'Your cohort members are dependable',
        'Your cohort has an established structure',
        'Your cohort has a clear purpose and believes what you’re doing matters',
        'Your cohort members communicate frequently ',
      );
    ?>
    <?php bz_make_multi_radios($items); ?>
  <?php bz_close_box();?>
  <?php bz_open_box('answer','You may have ranked your cohort low on some of these characteristics, and that’s okay. Embrace the journey! Teamwork is hard stuff. You will have the time in the upcoming Learning Lab to set expectations and define leadership roles to work effectively as a team throughout the Capstone Challenge. And you will have the space to reflect on your cohort’s teamwork during weekly Retrospectives with the purpose of always improving', 'What does this mean?'); ?>
  <?php bz_close_box(false);?>
  <h4>Troubelshooting</h4>
  <?php bz_open_box('read');?>
    <div class="bz-example">
      <p>The team was working on a project to launch a new website for the company. This team had been working together for quite some time and felt psychologically safe with one another. The team came up with a project plan, and everyone was following through on their assigned tasks. </p>
      <p>On website launch day, the team realized the site had some bugs making it not work properly. Someone had dropped the ball on making sure the website had been tested. Everyone started to feel nervous about the implications of this error. </p>
      <p>The team got together for an emergency meeting to discuss what happened and what to do next. Becca spoke first, admitting her fault for not doing the appropriate tests on the website, and apologizing to the team. Daniel spoke next, saying it was also his fault as the Project Manager that he wasn’t clearer up front about what tests needed to be done. Becca asked for help from Sheila, a senior web developer, to see if they could make the bug fixes they needed to today. Sheila agreed to help.</p>
    </div>
    <p>Do you think this is an effective team?</p>
    <?php 
    $items = array(
      array(
        'content' => 'Yes',
        'correctness' => 'correct',
      ),
      array(
        'content' => 'No',
        'correctness' => 'incorrect',
      ),
      

    );
    
    ?>
    <?php bz_make_cr_list($items, 'radio-list');?>
  <?php bz_close_box();?>
  <blockquote>Even the most effective teams have conflicts. It’s how you deal with those challenges that reveals the strength of the team.</blockquote>
  <?php bz_open_box('question', 'Every team goes through the stages of group development: forming &rArr; storming &rArr; norming &rArr; performing. Each of the four phases are necessary and inevitable in order for the team to grow, to face up to challenges, to tackle problems, to find solutions, to plan work, and to deliver results. Read the descriptions of each of the stages (they’re currently not in the correct order), and match the names to the stages.'); ?>
    <table class="sort-to-match">
      <?php $GLOBALS['for'] = 'for-match'; ?>
      <tr>
        <td><p>By this time, team members are motivated and knowledgeable, competent and autonomous, and able to handle the decision-making process without supervision. Teams at this stage often reach an unexpectedly high level of success. However, even the most high-performing teams will go through the earlier stages, and even revert back to them in certain circumstances.</p></td>
        <td><h6>PERFORMING</h6></td>
      </tr>
      <tr>
        <td><p>Don't be surprised (or worried!) if your team encounters some difficulties as you work together. In this stage team members may encounter disagreements and personality clashes. Team members may feel compelled to voice these opinions if they find someone shirking responsibility or attempting to dominate. Even some of the best teams get stuck in the &quot;storming&quot; phase, however these issues must be resolved before the team can progress.</p></td>
        <td><h6>STORMING</h6></td>
      </tr>
      <tr>
        <td><p>The team meets and learns about the opportunities and challenges, and then agrees on goals and begins to tackle the tasks.</p></td>
        <td><h6>FORMING</h6></td>
      </tr>
      <tr>
        <td><p>Resolving disagreements results in greater intimacy and a spirit of cooperation. All team members must share the responsibility and have the ambition to work for the success of the team's common goals.</p></td>
        <td><h6>NORMING</h6></td>
      </tr>
    </table>
  <?php bz_close_box();?>
  <?php bz_open_box('question', 'There are five common team dysfunctions that often get in the way of “rowing together.” Match each team pitfall to what it causes in the team dynamic.'); ?>
    <table class="sort-to-match">
      <?php $GLOBALS['for'] = 'for-match'; ?>
      <tr>
        <th><p>Pitfall</p></th>
        <th><p>Resulting Team Dynamic</p></th>
      </tr>
      <tr>
        <td><p>Lack of trust between team members</p></td>
        <td><p>Invulnerability: not being able to admit mistakes to one another </p></td>
      </tr>
      <tr>
        <td><p>Fear of conflict</p></td>
        <td><p>Artificial harmony </p></td>
      </tr>
      <tr>
        <td><p>Lack of commitment</p></td>
        <td><p>Ambiguity of who is in charge of what</p></td>
      </tr>
      <tr>
        <td><p>Avoidance of accountability</p></td>
        <td><p>Low standards: hesitate to call out behavior that&rsquo;s not good for the team &nbsp;</p></td>
      </tr>
      <tr>
        <td><p>Inattention to results</p></td>
        <td><p>Seeking status and ego: put individual recognition above the goals of the team </p></td>
      </tr>
    </table>
  <?php bz_close_box(); ?>
  <?php bz_open_box('answer', 'Counter to conventional wisdom, the causes of dysfunction are both identifiable and curable. Here&rsquo;s how to combat each dysfunction:', 'Fear not!'); ?>
    <table class="dont-mix">
      <tr>
        <td><p>Lack of trust between team members</p></td>
        <td><h6>TRUST ONE ANOTHER</h6>
          <ul>
          <li>
            <p>Share your weaknesses and mistakes with one another</p>
          </li>
          <li>
            <p>Don't hesitate to ask for help or provide constructive feedback</p>
          </li>
          <li>
            <p>Don't hesitate to offer help outside of your own area of responsibility</p>
          </li>
          <li>
            <p>Don't jump to conclusions about the intentions and aptitudes of others without attempting to clarify them first</p>
          </li>
          <li>
            <p>Recognize and tap into one another&rsquo;s skills and experiences</p>
          </li>
          <li>
            <p>Don't waste time and energy holding grudges, dreading meetings, or looking for reasons to avoid spending time together</p></li></ul>
        </td>
      </tr>
      <tr>
        <td><p>Fear of conflict</p></td>
        <td><h6>DO NOT FEAR CONFLICT</h6>
          <ul>
          <li>
            <p>Do not prioritize your desire to preserve artificial harmony in the face of productive ideological conflict</p>
          </li>
          <li>
            <p>Create environments where politics and personal attacks are snuffed out</p>
          </li>
          <li>
            <p>Do not ignore controversial topics that are critical to team success</p>
          </li>
          <li>
            <p>Do not fail to tap into all the opinions and perspectives of team members</p>
          </li>
          <li>
            <p>Do not waste time and energy with posturing and interpersonal risk management</p></li></ul>
        </td>
      </tr>
      <tr>
        <td><p>Lack of commitment</p></td>
        <td><h6>COMMIT TO ONE ANOTHER AND YOUR END GOALS</h6>
          <ul>
          <li>
            <p>Create clear direction and priorities</p>
          </li>
          <li>
            <p>Be clear about what needs to get done, by whom, and invest one another in decisions that you will stick to</p>
          </li>
          <li>
            <p>Seize windows of opportunity when they arise</p>
          </li>
          <li>
            <p>Breed confidence in one another and look for opportunities to fail forward </p>
          </li>
          <li>
            <p>Do not revisit discussions and decisions again and again; trust in your collective efforts</p>
          </li>
          <li>
            <p>Do not encourage second-guessing among team members</p></li></ul>
        </td>
      </tr>
      <tr>
        <td><p>Avoidance of accountability</p></td>
        <td><h6>STAY ACCOUNTABLE</h6>
          <ul>
          <li>
            <p>Lean into interpersonal discomfort if it means holding one another accountable to group priorities and outcomes</p>
          </li>
          <li>
            <p>Clarify your standards of performance (bar of excellence) so that you do not create resentment among team members </p>
          </li>
          <li>
            <p>Encourage greatness from every team member; do not accept mediocrity<br>
              Stay on top of deadlines and key deliverables</p>
          </li>
          <li>
            <p>Do not place an undue burden on the team leader as the sole source of discipline</p></li></ul>
        </td>
      </tr>
      <tr>
        <td><p>Inattention to results</p></td>
        <td><h6>PAY ATTENTION TO RESULTS</h6>
          <ul>
          <li>
            <p>Stay focused on your collective success; do not let your pursuit of individual goals and personal status get in the way of shared goals</p>
          </li>
          <li>
            <p>Commit to learning and growing</p>
          </li>
          <li>
            <p>Aim to defeat competitors; do not settle for second best</p>
          </li>
          <li>
            <p>Stay focused on the most urgent and important action items and results</p></li></ul>
        </td>
      </tr>
    </table>
  <?php bz_close_box(); ?>
  <?php 
  bz_open_box('question','What should you <strong>avoid</strong> when working as a team?'); 
    $items = array(
      array(
        'correctness' => 'correct',
        'content' => 'Preserving harmony when there is conflict',
        'feedback' => ''
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'Holding each other accountable',
        'feedback' => ''
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'Hearing all opinions',
        'feedback' => ''
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'Offering to help outside your own responsibilities',
        'feedback' => ''
      ),
    );
    bz_make_cr_list($items, 'radio-list');

  bz_close_box();?>
  <?php 
  bz_open_box('reflection','Describe a team you worked on where it felt dysfunctional. What wasn’t working? What was the end result? What are some ways you could have changed the dynamic?');?>
    <p><?php bz_make_textarea();?></p>
  <?php bz_close_box(); ?>
  <h3>How do I identify my strengths as a teammate?</h3>
  <?php $GLOBALS['hlevel'] = 4; ?>
  <?php bz_open_box('pulse', 'What are some common obstacles you personally encounter when working in a team? (Check all that apply)');
    $items = array(
      array('content' => 'You pick up the slack when other teammates drop the ball (and you feel resentful!) '),
      array('content' => 'You believe you work better autonomously and get frustrated when others slow you down'),
      array('content' => 'You worry about bringing up challenges or conflicts because you don’t want to hurt anyone’s feelings '),
      array('content' => 'You feel that your voice and opinion never get the floor time they deserve '),
      array('content' => 'You know you take up too much floor time'),
      array('content' => 'You have a hard time backing down or compromising '),
    ); 
  bz_make_cr_list($items); ?>
  <p><?php bz_make_textarea(array('other'=>true)); ?></p>
  <?php bz_close_box();?>
  <?php 
  bz_open_box('answer', 'We’re constantly learning to be better teammates, and that starts with knowing yourself - your challenges and your strengths when it comes to teamwork - really well.</p><p>One framework (there are many) for identifying your strengths as a teammate is the Leadership Compass. It comes from a Native American Indian-based practice called the Four-Fold Way, in which the four directions are described as warrior (north), healer (south), teacher (west), and visionary (east).', 'Yep, we all have to deal with some of these issues!');
  bz_close_box(false);
  ?>
  <?php bz_open_box('question', 'Try to match each compass direction with its description:'); ?>
    <table class="sort-to-match">
      <?php $GLOBALS['for'] = 'for-match'; ?>
        <tr>
          <th>NORTH</th><td>Acting — “Let’s do it”; likes to act, try things, plunge in</td>
        </tr>
        <tr>
          <th>WEST</th><td>Paying attention to detail — likes to know the who, what, when, where and why before acting</td>
        </tr>
        <tr>
          <th>EAST</th><td>Speculating — likes to look at the big picture and the possibilities before acting</td>
        </tr>
        <tr>
          <th>SOUTH</th><td>Caring — likes to know that everyone’s feelings have been taken into consideration and that their voices have been heard before acting</td>
        </tr>  
    </table>
  <?php bz_close_box();?>
  <?php bz_open_box('answer','All directions on the leadership compass have profound strengths and potential weaknesses, and every person is seen as capable of growing in each direction. However, many leaders exemplify one compass direction more strongly than others.','There is more than one way to lead');
  bz_close_box(false);
  ?>
  <?php bz_open_box('question', 'Match the person with his or her primary compass direction.');?>

  <table class="multi-radios instant-feedback">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>NORTH</th>
        <th>WEST</th>
        <th>EAST</th>
        <th>SOUTH</th>
      </tr>
      <tr>
        <td>
          <h6>SONIA SOTOMAYOR</h6>
          <p>Sonia Sotomayor is an Associate Justice of the Supreme Court of the United States, serving since August 2009. She has the distinction of being its first justice of Hispanic heritage, only its third female justice, and is one of the youngest justices on the Supreme Court. Sotomayor has made notable court opinions and articles on racial discrimination, strip searches, the environment, and 2nd amendment rights.</p>
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" name="<?php echo bz_make_id('hold');?>" value="NORTH">
        </td>
        <td class="correct">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="WEST">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="EAST">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="SOUTH">
        </td>
      </tr>
      <tr>
        <td>
          <h6>MARISSA MAYER</h6>
          <p>Marissa Mayer is an American business executive and computer scientist, who was most recently the CEO of Yahoo!. In 2014, Mayer was named to Forbes 40 under 40 list, and was ranked the 16th most-powerful businesswoman in the world. Mayer has been credited with changing Yahoo!’s maternity leave policy, acquisition of Tumblr and the Chinese e-commerce company the Alibaba Group, and institution of a new performance review system.</p>
        </td>
        <td class="correct">
          <input type="radio" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" name="<?php echo bz_make_id('hold');?>" value="NORTH">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="WEST">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="EAST">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="SOUTH">
        </td>
      </tr>
      <tr>
        <td>
          <h6>MARTIN LUTHER KING JR.</h6>
          <p>Martin Luther King Jr. was a minister and social activist who led the Civil Rights Movement in the Uniter States from the mid-1950s until his death by assassination in 1968. His leadership was fundamental to that movement’s success in ending the legal segregation of African Americans in the South and other parts of the United States.</p>
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" name="<?php echo bz_make_id('hold');?>" value="NORTH">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="WEST">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="EAST">
        </td>
        <td class="correct">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="SOUTH">
        </td>
      </tr>
      <tr>
        <td>
          <h6>STEVE JOBS</h6>
          <p>Steve Jobs was an American information technology entrepreneur and inventor. He was the co-founder, chairman, and CEO of Apple Inc. He was also the primary investor and CEO of Pixar Studios. Steve Jobs has been credited as the pioneer of the personal computer revolution and the creation of wildly popular devices such as the iPod and iPhone. Jobs died of cancer in 2011.</p>
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id();?>" name="<?php echo bz_make_id('hold');?>" value="NORTH">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="WEST">
        </td>
        <td class="correct">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="EAST">
        </td>
        <td class="incorrect">
          <input type="radio" data-bz-retained="<?php echo bz_make_id('hold');?>" name="<?php echo bz_make_id('hold');?>" value="SOUTH">
        </td>
      </tr>
    </thead>
  </table>
  <?php 
  $GLOBALS['for'] = 'match';
  bz_close_box();
  ?>
  <?php bz_open_box('answer'); ?>
  <h6>MARISSA MAYER</h6>
  <p><strong>North.</strong> Marissa Mayer exemplifies a leader who is assertive, directive, and decisive. Not all of her management decisions have been popular, but there's a reason that she is the only person to have been featured in all three of Fortune Magazine's annual lists during the same year: Businessperson of the Year (No. 10), Most Powerful Women (at No. 8), and 40 Under 40 (No. 1) at the same time.</p>
  <h6>MARTIN LUTHER KING JR.</h6>
  <p><strong>South.</strong> Martin Luther King Jr. exemplifies a leader who is values-driven and a relationship-builder, who takes into account the voices, experiences, and perspectives of others and acts in service of them. He tapped into the emotional and moral compass of a generation to promote nonviolent tactics to achieve civil rights. He was awarded the Nobel Peace Prize in 1964.</p>
  <h6>SONIA SOTOMAYOR</h6>
  <p><strong>West.</strong> Sonia Sotomayor exemplifies a leader who lives by inquiry, is detail-oriented, and makes reliable and thorough decisions, and is willing to ask the tough questions. Sotomayor has earned a reputation as a “sharp and fearless jurist" who has been known to take into account aspects of her identity, including her gender and personal experience, into her decisions.</p>
  <h6>STEVE JOBS</h6>
  <p><strong>East.</strong> Steve Jobs was called a "modern-day Leonardo da Vinci" by some pundits, who praised his ability to think outside the box, set a creative vision for the future, and transform entire industries with his inventions. Jobs was a master in designing from the perspective of his users and creating adaptive solutions to real-world problems that they faced.</p>
  <?php bz_close_box(); ?>
  <?php 
  bz_open_box('question', 'Why might it be helpful to know where you personally land on the Leadership Compass? (check all that apply)');
    $items = array(
      array(
        'correctness' => 'correct',
        'content' => 'To share it with others on your team and understand how each person works',
        'feedback' => ''
      ),
      array(
        'correctness' => 'correct',
        'content' => 'To articulate why you work the way you do and identify skills that you can contribute to your cohort',
        'feedback' => ''
      ),
      array(
        'correctness' => 'correct',
        'content' => 'To develop an understanding of how your work style might affect the team',
        'feedback' => ''
      ),
      array(
        'correctness' => 'correct',
        'content' => 'To build skill in all four directions to enhance personal and team performance ',
        'feedback' => ''
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'So you can write it on your resume',
        'feedback' => ''
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'To justify to your teammates why you’re not following through on tasks',
        'feedback' => ''
      ),
      array(
        'correctness' => 'incorrect',
        'content' => 'To keep building skill in your primary direction and ignore the other directions ',
        'feedback' => ''
      ),
    );
    bz_make_cr_list($items);
  bz_close_box();
  ?>
  <?php 
  bz_open_box('reflection', 'So which compass direction are you? Take the following quiz to find out. Check off each characteristic that applies to you.');
  ?>


  <ul class="checklist eval">
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You take charge </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You keep a list of things to do and you work to check them off as soon as possible</li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You feel a sense of urgency to get things done and express urgency for others too</li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You enjoy a challenge </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You’re persistent; you won’t stop when you hear “no”</li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You sometimes overlook strategic planning and asking clarifying questions so you can get right into the work </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You sometimes get defensive or lose patience with other team members </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You usually want things to go your way and have difficulty seeing the other perspective</li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="North" />You don’t do very well with ambiguity </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You are a big-picture thinker </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You are creative; you think outside the box </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You are future-focused; you believe in backwards planning with the end in sight</li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You easily see overarching themes and ideas </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You are good at and enjoy problem-solving and experimenting </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You lack attention to detail</li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You sometimes drop the ball on your tasks in a project </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You often lose track of time or deadlines </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="East" />You start projects, but don’t always follow through with completing them </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You make sure that everyone’s voice is heard </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You are receptive to and build on others’ ideas </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You’re not competitive </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You value relationships on a team </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You trust emotions and intuition to guide you </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You are supportive of your colleagues and their needs </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You have trouble saying “no” to requests </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You internalize failure and often assume blame </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="South" />You try to avoid conflict as much as possible </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You ask the tough questions that no one else seems to ask </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You’re detail-oriented </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You don’t start work on a project until you’re clear about the details </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You follow the rules </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You weigh all sides of an issue before making a decision </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You use data analysis and logic to make decisions </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You sometimes lose sight of the forest for the trees (e.g. lose sight of the big picture)</li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You often stay toward the sidelines in team discussion and would rather observe </li>
    <li class="bz-compass-eval"><input type="checkbox" data-bz-retained="<?php echo bz_make_id(); ?>" value="West" />You can be resistant to change </li>
  </ul>


  <?php 
  $GLOBALS['for'] = 'for-eval';
  bz_close_box();
  bz_open_box('answer','','Your results');

  bz_close_box();
  ?>
  <?php 
  bz_open_box('reflection', 'Do these directions fall in line with what you expected? Why or why not?');
    bz_make_textarea();
    ?>
    <p>What do these directions make you think about how you will work with your cohort on the Capstone Challenge?</p>
    <?php
    bz_make_textarea();
  bz_close_box();
  ?>
  <h3>How do I take on the course's upcoming Challenges?</h3>
  <?php $GLOBALS['hlevel'] = 4; ?>
  <div class="bz-box">
    <p>In the third part of the Accelerator, <em>Tackle Career Challenges</em>, which you’re in right now, you will complete two big projects:</p>
    <ol>
      <li>A group challenge &mdash; <a href="#">the Capstone Challenge</a></li>
      <li>An individual project &mdash; <a href="#">Tackle Career Challenges</a></li>
    </ol>
    <p>Read each project description and rubric by clicking the links above, internalize them, and mark down any questions you have so you’re ready to jump in with your cohort during Learning Lab.</p>
  </div>
  <?php bz_open_box('question', 'The following questions will check your understanding of these two projects.', 'Are you ready for this?');
  ?>
  <p><strong>What is the main deliverable of the Capstone Challenge?</strong></p>
  <?php
  $items = array(
    array('correctness' => 'correct', 'content' => 'A group presentation in front of judges ',),
    array('correctness' => 'incorrect', 'content' => 'Short answer questions on the Portal ',),
    array('correctness' => 'incorrect', 'content' => 'An essay ',),
    array('correctness' => 'incorrect', 'content' => 'A website ',),
  );
  $GLOBALS['innercounter']++;
  bz_make_cr_list($items, 'radio-list');

  ?>
  <p><strong>Which of the Capstone Challenge leadership roles appeals to you? (check all that apply)</strong></p>
  <?php
  $items = array(
    array('correctness' => '', 'content' => 'Project Manager',),
    array('correctness' => '', 'content' => 'Lead Researcher',),
    array('correctness' => '', 'content' => 'Lead prototyper',),
    array('correctness' => '', 'content' => 'Lead Oral Presenter',), 
    array('correctness' => '', 'content' => 'Lead Deck Designer',),
  ); 
  $GLOBALS['innercounter']++;
  bz_make_cr_list($items);
  ?>
  <p><strong>In the past, what is true of the most successful cohorts during the Capstone Challenge?</strong></p>
  <?php
  $items = array(
    array('correctness' => 'correct', 'content' => 'They met outside of Learning Lab to work on the project',),
    array('correctness' => 'incorrect', 'content' => 'They made no mistakes throughout the process',),
    array('correctness' => 'incorrect', 'content' => 'Fellows worked individually and then came together to present as a group',),
    array('correctness' => 'incorrect', 'content' => 'They spied on other teams to steal their most innovative ideas',), 
  );
  $GLOBALS['innercounter']++;
  bz_make_cr_list($items, 'radio-list');
  ?>
  <p><strong>Which part of the Tackle Career Challenges project goes hand in hand with your group work on the Capstone Challenge?</strong></p>
  <?php 
  $items = array(
    array('correctness' => 'correct', 'content' => 'Part 1: Challenge Plan and Reflection'),
    array('correctness' => 'incorrect', 'content' => 'Part 2: Revised Resume'),
    array('correctness' => 'incorrect', 'content' => 'Part 3: Performance Task'),
    array('correctness' => 'incorrect', 'content' => 'Part 4: Legacy Reflection '),
  );
  $GLOBALS['innercounter']++;
  bz_make_cr_list($items, 'radio-list', 'instant-feedback', 'dont-mix');
  ?>
  <p><strong>How many users will you personally need to interview outside of Learning Lab?</strong></p>
  <table class="no-zebra instant-range-feedback">
    <tbody>
      <tr class="inputs-row">
        <td>
          <input max="5" min="1" step="1" type="range" data-bz-retained="<?php echo bz_make_id(); ?>" />
          <div class="display-value"><span class="current-value">&nbsp;</span> users</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="feedback" data-bz-range-flr="0" data-bz-range-clg="2">That's a little too low</div>
          <div class="feedback" data-bz-range-flr="2" data-bz-range-clg="3">That's right! <strong>Three</strong> is the magic number.</div>
          <div class="feedback" data-bz-range-flr="4" data-bz-range-clg="5">That's a little too high</div>
        </td>
      </tr>
    </tbody>
  </table>
  <?php bz_close_box(); ?>
  <h2 id="productivity-corner">PRODUCTIVITY CORNER:<br />PROJECT PLANNING</h2>
  <?php bz_open_box('question', 'Why are project plans helpful for teams working on big projects? (check all that apply)', 'Quick Question', null);
    $items=array(
      array('correctness' => 'correct', 'content' => 'It saves time'),
      array('correctness' => 'correct', 'content' => 'It saves money '),
      array('correctness' => 'correct', 'content' => 'It lets you preempt expected problems'),
      array('correctness' => 'correct', 'content' => 'It keeps the team coordinated and on-task'),
    );
    $GLOBALS['innercounter']++;
    bz_make_cr_list($items);
  bz_close_box();
  bz_open_box('answer','These are all true. One of the critical factors for project success is having a well-developed project plan. Often, project planning is ignored in favor of getting on with the work. However, creating a project plan is the first thing you should do when undertaking any kind of project.');
  bz_close_box(false);
  ?>
  <?php bz_open_box('question', 'Take a look at this piece of a Capstone project plan:'); ?>
  <div class="bz-view-box">
    <table class="shrink">
      <thead>
        <tr>
          <th>Milestone</th>
          <th>Action Item / Task</th>
          <th>Due Date</th>
          <th>Owner</th>
          <th>Helpers</th>
          <th>Completed? (Y/N)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td rowspan="3" colspan="1"><div>Test prototype and make improvements</div></td>
          <td>Reach out to 20 potential users and schedule testing sessions with 10 </td>
          <td>11/10/2017</td>
          <td>Lead Prototyper (Tran)</td>
          <td>Esteban, Zia, Tao</td>
          <td>Y</td>
        </tr>
        <tr>
          <td>Test prototype with 10 different users and record feedback</td>
          <td>11/21/2017</td>
          <td>Lead Prototyper (Tran)</td>
          <td>Esteban, Zia, Tao</td>
          <td>N</td>
        </tr>
        <tr>
          <td>Make final improvements to prototype based on feedback</td>
          <td>11/28/2017</td>
          <td>Lead Prototyper (Tran)</td>
          <td>Esteban, Zia, Tao</td>
          <td>N</td>
        </tr>
      </tbody>
    </table>
  </div>
  <p>Now match each piece of a project plan with its description:</p>
  <table class="sort-to-match">
      <?php $GLOBALS['for'] = 'for-match'; ?>
    <tr>
      <td><p>Milestone</p></td>
      <td><p>These are the outcomes you&rsquo;re shooting for</p></td>
    </tr>
    <tr>
      <td><p>Action Item/Task</p></td>
      <td><p>All the things that need to happen in order to accomplish a milestone</p></td>
    </tr>
    <tr>
      <td><p>Due Date</p></td>
      <td><p>The deadline for tasks to be completed</p></td>
    </tr>
    <tr>
      <td><p>Owner</p></td>
      <td><p>The leader in the team who ensures the task is completed</p></td>
    </tr>
    <tr>
      <td><p>Helpers</p></td>
      <td><p>The teammates who work on the task in a supporting role</p></td>
    </tr>
    <tr>
      <td><p>Completed (Y/N)</p></td>
      <td><p>Where to check off the task</p></td>
    </tr>
  </table>
  <?php
  bz_close_box();
  ?>
  <?php bz_open_box('answer', 'This project plan example is also ordered in the way you should create your plan. It’s backwards planning (remember that?!) Start with your milestones, then plan out your tasks, etc.');
  bz_close_box(false);
  ?>
  <?php bz_open_box('question','Match the following action items to the appropriate milestone:'); ?>
  <table class="sort-to-match">
    <tbody>
      <tr>
        <td>Conduct research</td>
        <td>
          <ul>
            <li>Email five potential users </li>
            <li>Create an interview guide </li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>Create new website </td>
        <td>
          <ul>
            <li>Draft content</li>
            <li>Select compelling images</li>
          </ul>
        </td>
      </tr>
      <tr>
        <td>Present to customers</td>
        <td>
          <ul>
            <li>Create presentation slide deck</li>
            <li>Confirm attendance</li>
          </ul>
        </td>
      </tr>
    </tbody>
  </table>
  <?php bz_close_box(); ?>
  <?php bz_open_box('action', 'To ensure you&rsquo;ve thought about all the tasks necessary to complete a milestone, ask yourself if there’s anything you need to do to complete that task. For example, to draft content for a new website, you might need to start with an outline or a vision for the site.', 'Work backward to move forward');
  bz_close_box(false);
  ?>
  <?php bz_open_box('key', 'Feel free to use this Google Spreadsheets template for your cohort’s project plan in the Capstone Challenge and/or your project plan in Part 3 of the Tackle Career Challenges Project (link). You can also feel free to use other formats for project planning, such as an online tool like Asana.', 'Helpful resource');
  bz_close_box(false); ?>
  <blockquote>Use your project plan as a map to navigate your project: check it often to how much ground you've already covered, what lies ahead, what you may have missed, and whether a course adjustment is needed.</blockquote>
  <h2 id="wrap-up">Wrap-up</h2>
  <div>
    <p>In this module we looked at why team work skills matter for your career success:</p>
    <ul>
      <li>You will most likely work in teams no matter what job you have </li>
      <li>Employers hire for good teammates </li>
      <li>Being a good team player is more important to the success of a team project than your individual talents </li>
    </ul>
    <p>Then we went through some frameworks and tips you can apply to build a strong team around you, such as:
    <ul>
      <li>Identifying where your team is on the continuum: forming &rArr; storming &rArr; norming &rArr; performing</li>
      <li>Being aware of common pitfalls and handling common dysfunctions</li>
    </ul>
    <p>We also used the Leadership Compass framework to help you become more aware of your leadership style and what your strengths are as a team member.</p>
    <p>And finally, we reviewed the upcoming challenges you'll take on as a team and individually, and boosted your project planning skills a bit to get you ready for capstone kick-off.</p>
    <p><strong>Good luck kicking-off your project at the next Learning Lab!</strong></p>
  </div>
</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>