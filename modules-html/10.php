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
  <?php openbox('answer', 'Let&rsquo;s take a closer look at these five elements:');?>
    <p class="tbd">REPLACE IMAGES WITH CONTENT LIBRARY BASED ONES</p>
    <table>
      <tbody>
        <tr>
          <td style="width: 25%;"><img src="/courses/25/files/8486/preview" alt="braven-team-building_safety.png" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/25/files/8486" data-api-returntype="File" /></td>
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
          <td style="width: 25%;"><img src="/courses/25/files/8485/preview" alt="braven-team-building_depend.png" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/25/files/8485" data-api-returntype="File" /></td>
        </tr>
        <tr>
          <td><img src="/courses/25/files/8489/preview" alt="braven-team-building_structure.png" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/25/files/8489" data-api-returntype="File" /></td>
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
          <td><img src="/courses/25/files/8488/preview" alt="braven-team-building_goals.png" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/25/files/8488" data-api-returntype="File" /></td>
        </tr>
        <tr>
          <td><img src="/courses/25/files/8487/preview" alt="braven-team-building_comms.png" data-api-endpoint="https://portal.bebraven.org/api/v1/courses/25/files/8487" data-api-returntype="File" /></td>
          <td colspan="2">
            <h6>5. Team members communicate frequently.&nbsp;</h6>
            <p>On a typical team,&nbsp;a dozen or so communication exchanges per working week&nbsp;may turn out to be optimum. It's also critical that teams&nbsp;spend&nbsp;time communicating outside of formal meetings, as increasing opportunities for informal communication tends to increase team performance. However, it's critical that team members talk and listen with equal measure. Lower performing teams have dominant members, teams within teams, and members who talk or listen but don&rsquo;t do both.&nbsp;</p>
          </td>
        </tr>
      </tbody>
    </table>
  <?php closebox();?>
  <?php openbox('reflection', 'Think about your own cohort as a team. You’ve been working as a team all semester, and you’re about to begin an intense project, the Capstone Challenge, as a team. Rate your cohort on the five effective team characteristics: (1=poor, 5=excellent)');?>
    <?php 
      $items = array(
        'Your cohort feels safe',
        'Your cohort members are dependable',
        'Your cohort has an established structure',
        'Your cohort has a clear purpose and believes what you’re doing matters',
        'Your cohort members communicate frequently ',
      );
    ?>
    <?php makemultiradios($items); ?>
  <?php closebox();?>
  <?php openbox('answer','You may have ranked your cohort low on some of these characteristics, and that’s okay. Embrace the journey! Teamwork is hard stuff. You will have the time in the upcoming Learning Lab to set expectations and define leadership roles to work effectively as a team throughout the Capstone Challenge. And you will have the space to reflect on your cohort’s teamwork during weekly Retrospectives with the purpose of always improving', 'What does this mean?'); ?>
  <?php closebox(false);?>
  <h4>Troubelshooting</h4>
  <?php openbox('story');?>
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
    <?php makecrlist($items, 'radio-list');?>
  <?php closebox();?>
  <blockquote>Even the most effective teams have conflicts. It’s how you deal with those challenges that reveals the strength of the team.</blockquote>
  <?php openbox('question', 'Every team goes through the stages of group development. Each of the four phases are necessary and inevitable in order for the team to grow, to face up to challenges, to tackle problems, to find solutions, to plan work, and to deliver results. Read the descriptions of each of the stages (they’re currently not in the correct order), and match the names to the stages.'); ?>
    <table class="sort-to-match">
      <?php $GLOBALS['for'] = 'for-match'; ?>
      <tr>
        <td><p>By this time, team members are motivated and knowledgeable, competent and autonomous, and able to handle the decision-making process without supervision. Teams at this stage often reach an unexpectedly high level of success. However, even the most high-performing teams will go through the earlier stages, and even revert back to them in certain circumstances.</p></td>
        <td><p>PERFORMING</p></td>
      </tr>
      <tr>
        <td><p>Don't be surprised (or worried!) if your team encounters some difficulties as you work together. In this stage team members may encounter disagreements and personality clashes. Team members may feel compelled to voice these opinions if they find someone shirking responsibility or attempting to dominate. Even some of the best teams get stuck in the &quot;storming&quot; phase, however these issues must be resolved before the team can progress.</p></td>
        <td><p>STORMING</p></td>
      </tr>
      <tr>
        <td><p>The team meets and learns about the opportunities and challenges, and then agrees on goals and begins to tackle the tasks.</p></td>
        <td><p>FORMING</p></td>
      </tr>
      <tr>
        <td><p>Resolving disagreements results in greater intimacy and a spirit of cooperation. All team members must share the responsibility and have the ambition to work for the success of the team's common goals.</p></td>
        <td><p>NORMING</p></td>
      </tr>
    </table>
  <?php closebox();?>
  <?php openbox('question', 'There are five common team dysfunctions that often get in the way of “rowing together.” Match each team pitfall to what it causes in the team dynamic.'); ?>
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
  <?php closebox(); ?>
  <?php openbox('answer', 'Counter to conventional wisdom, the causes of dysfunction are both identifiable and curable. The following cards explain how to combat each dysfunction.', 'Fear not!'); ?>
  <p class="tbd">Add flip interaction or change intro</p>
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
  <?php closebox(); ?>
  <?php 
  openbox('question','What should you <strong>avoid</strong> when working as a team?'); 
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
        'content' => 'Holding each other accountable',
        'feedback' => ''
      ),
    );
    makecrlist($items, 'radio-list');

  closebox();?>
  <?php 
  openbox('reflection','Describe a team you worked on where it felt dysfunctional. What wasn’t working? What was the end result? What are some ways you could have changed the dynamic?');?>
    <p><?php maketextarea();?></p>
  <?php closebox(); ?>
  <h3>How do I identify my strengths as a teammate?</h3>
  <?php $$GLOBALS['hlevel'] = 4; ?>
  <?php openbox('pulse', 'What are some common obstacles you personally encounter when working in a team? (Check all that apply)');
    $items = array(
      array('content' => 'You pick up the slack when other teammates drop the ball (and you feel resentful!) '),
      array('content' => 'You believe you work better autonomously and get frustrated when others slow you down'),
      array('content' => 'You worry about bringing up challenges or conflicts because you don’t want to hurt anyone’s feelings '),
      array('content' => 'You feel that your voice and opinion never get the floor time they deserve '),
      array('content' => 'You know you take up too much floor time'),
      array('content' => 'You have a hard time backing down or compromising '),
    ); 
  makecrlist($items); ?>
  <p><?php maketextarea(array('other'=>true)); ?></p>
  <?php closebox();?>
  <?php 
  openbox('answer', '<p>We’re constantly learning to be better teammates, and that starts with knowing yourself - your challenges and your strengths when it comes to teamwork - really well.</p><p>One framework (there are many) for identifying your strengths as a teammate is the Leadership Compass. It comes from a Native American Indian-based practice called the Four-Fold Way, in which the four directions are described as warrior (north), healer (south), teacher (west), and visionary (east).</p>', 'Yep, we’re all familiar with these archetypes!');
  closebox(false);
  ?>
  <?php openbox('question', 'Match the compass direction with its description:'); ?>
    <table class="sort-to-match">
      <?php $GLOBALS['for'] = 'for-match'; ?>
      <tbody>
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
      </tbody>
    </table>
  <?php closebox();?>
  <?php openbox('answer','All directions on the leadership compass have profound strengths and potential weaknesses, and every person is seen as capable of growing in each direction. However, many leaders exemplify one compass direction more strongly than others.','There is more than one way to lead');
  closebox(false);
  ?>
  <?php openbox('question', 'Match the person with his or her primary compass direction.');?>
  <?php 
  /*
  $items=array(
    '<h6>MARISSA MAYER</h6><p>Marissa Mayer is an American business executive and computer scientist, who was most recently the CEO of Yahoo!. In 2014, Mayer was named to Forbes 40 under 40 list, and was ranked the 16th most-powerful businesswoman in the world. Mayer has been credited with changing Yahoo!&rsquo;s maternity leave policy, acquisition of Tumblr and the Chinese e-commerce company the Alibaba Group, and institution of a new performance review system.</p>',
    '<h6>MARTIN LUTHER KING JR.</h6><p>Martin Luther King Jr. was a minister and social activist who led the Civil Rights Movement in the Uniter States from the mid-1950s until his death by assassination in 1968. His leadership was fundamental to that movement’s success in ending the legal segregation of African Americans in the South and other parts of the United States.</p>',
    '<h6>SONIA SOTOMAYOR</h6><p>Sonia Sotomayor is an Associate Justice of the Supreme Court of the United States, serving since August 2009. She has the distinction of being its first justice of Hispanic heritage, only its third female justice, and is one of the youngest justices on the Supreme Court. Sotomayor has made notable court opinions and articles on racial discrimination, strip searches, the environment, and 2nd amendment rights.</p>',
    '<h6>STEVE JOBS</h6><p>Steve Jobs was an American information technology entrepreneur and inventor. He was the co-founder, chairman, and CEO of Apple Inc. He was also the primary investor and CEO of Pixar Studios. Steve Jobs has been credited as the pioneer of the personal computer revolution and the creation of wildly popular devices such as the iPod and iPhone. Jobs died of cancer in 2011.</p>',
  );
  $cats = array('NORTH' => '','WEST' => '','EAST' => '','SOUTH' => '',);

  makemultiradios($items, $cats)
  */
  ?>
 




  </table>
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