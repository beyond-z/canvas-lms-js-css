<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Module 11 - CAPSTONE CHALLENGE: DEFINE AND IDEATE</title>
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
  $ns = 'csdi';
  require('functions.php');
?>
<div class="bz-module">
  <p>In this module we'll focus on meeting facilitation skills, which will help you in any future job but also with your work on the Capstone Challenge.
  <h2 id="why">Why is this important?</h2>
  <?php 
  bz_open_box('reflection', 'Meetings are a necessary part of working in teams so that teammates can collaborate. However, we’ve all been in meetings (including classes and school meetings) that didn’t go so well.</p><p>Which of the following describe your experience? (check all that apply)', 'What happens in meetings?');
    $items = array(
      array('content' => 'You ran out of time because the group spent too much time on one topic'),
      array('content' => 'It felt disorganized and lacked a goal or purpose '),
      array('content' => 'There was great discussion, but no clear action steps came out of the meeting, so nothing actually happened '),
      array('content' => 'One or two people controlled the majority of the conversation '),
      array('content' => 'It was boring and exhausting '),
      array('content' => 'There was too much “talking at” rather than conversation between everyone '),
      array('content' => 'The discussion seemed to be going in circles rather than progressing forward '),
      array('content' => 'It lacked focus; you kept going down “rabbit holes”'),
    );
    bz_make_cr_list($items);
    bz_make_textarea(array ('optional' => true, 'other' => true,));
    bz_close_box();
    //
    bz_open_box('answer', 'All of these experiences are typical problems with meetings, and it’s the role of the meeting’s leader or facilitator to avoid these common pitfalls. With some key tips and practice, you can become an excellent facilitator.', 'It happens to everyone');
    bz_close_box();
    //
    bz_open_box('video');
    $transcript = '<p>Hi, my name is Katy, and I’m currently a Store Planner at Old Navy. Both in my current role and in my past experiences as a manager, I’ve had to facilitate a number of meetings at work, both ad hoc project management style meetings as well as business reviews that happen week over week. Through my experiences, there are a few things I would offer you as you begin your experience facilitating meetings at work as well.</p><p>The first thing is I would be sure you have a clear, established purpose for the desired outcomes you want to achieve through this meeting. In addition to that, you want to establish an agenda for the meeting that will directly lead the group to those outcomes you’ve stated.</p><p>Also, [and] that leads me to the second point, to just make sure that agenda and that purpose are clearly communicated to all participants ahead of the meeting date. This will ensure all participants know what’s coming, have prepared their role appropriately, and are showing up ready to engage and have a robust discussion and eventually lead you toward success in achieving your outcomes.</p><p>Additionally it’s very important at meetings at work to make sure that meetings stay on time and on task. It can be a challenge as a lot of good ideas surface, people are excited to participate, but it isn’t uncommon for side conversations to begin, or rabbit holes that start getting run down that can detract from the purpose of your meeting. Often times, establishing language to be able to validate those points and to be able to revisit them offline at another time is an effective way to help keep your meeting on time and on task.</p><p>Also, too, as you get towards the end of your meeting, it’s important to make sure you provide the group a summary of key points that have been discussed, decisions that have been made, ultimately goals that have been reached, and if there is any outstanding or follow up work, that next steps are established, and everyone who is present understands they have a role in completing those next steps too.</p><p>So, with that I’ll leave you with one last nugget, is that [if] after all of this great preparation, you&rsquo;ve determined that this topic could actually be resolved with a conversation or two or an email exchange, go ahead and do that. It’s really great to be known at work as when you do hold a meeting and you take everyone’s valuable time, that you have a really clear purpose, and you’re known for getting things done in meetings.</p><p>Best of luck to you as you go forth and start facilitating meetings on your own.</p>';
    bz_make_youtube('OIvuaqYOHQs','2:13', 'Katy, an experienced manager (and Braven Leadership Coach!) shares her advice on meetings', $transcript);
    bz_close_box();
    //
    bz_open_box('question', null, 'See it from someone else&rsquo;s perspective');?>
    <div class="bz-example">
      <p>You’re sitting in Learning Lab during the Capstone Challenge and your cohort’s Lead Prototyper is in charge of facilitating this section of Learning Lab. However, it’s clear he didn’t prepare. He has no agenda and he just looks back at the rest of your cohort with a blank stare, not knowing what to say or do.</p>
    </div>
    <p>How are you feeling? (check all that apply)</p>
    <?php
    $items = array(     
      array('content' => 'Frustrated. Since the Lead Prototyper did not prepare to facilitate, it’s going to put your cohort behind and you may not be able to complete the Challenge. '),
      array('content' => 'Curious. You wonder why he seems nervous and unprepared and if there’s any way you could help. '),
      array('content' => 'Nervous. Your team has come so far. How will you get past this obstacle?'),
    );
    bz_make_cr_list($items);
    bz_make_textarea(array ('optional' => true, 'other' => true,));
    bz_close_box();
    //

  ?>
  <blockquote><p>You should never go to a meeting or make a telephone call without a clear idea of what you are trying to achieve.</p><p class="quote-source">Steve Jobs, founder of Apple</p></blockquote>
  <h2 id="how">How do I facilitate meetings?</h2>
  <h3>How can I become a better facilitator?</h3>
  <?php $GLOBALS['hlevel'] = 4; ?>
  <?php 
  bz_open_box('reflection', 'Reflect on your facilitation skills or how you suspect you may facilitate meetings: rate yourself on each skill below on a scale from from 1 (need to grow the most) to 5 (already very strong)');
  $items = array(
    array('You&rsquo;re able to envision how the meeting will play out in your head.','Practice “Image Training.” Just as athletes run through the race or game in their mind in advance, preparing their bodies’ neural pathways for the real thing, facilitators should close their eyes and mentally walk through the session. Try to visualize difficult situations that might crop up and how to handle them calmly, rehearse jokes or stories, or simply imagine the group smiling. When it comes time to execute the facilitation, the mind is ready.'),
    array('You clarify the expected outcomes or objectives of the meeting and stay focused on them.','Create an agenda (see more detail in the Productivity Corner at the end of this module) where you list out the expected outcomes or objectives of the meeting. Build the rest of your agenda, including activities and discussion topics, around achieving these outcomes. Whenever you feel conversation going down a rabbit hole or slipping away from the objectives, refocus the conversation by saying something like, “It seems like we’re losing focus. Let’s get back to discussing XYZ.”'),
    array('You intuitively know when the group&rsquo;s energy is low and energize the group throughout the meeting.','You know what boredom looks like, so force yourself to notice when people are losing focus. You can also set a norm at the beginning of your meeting that people should feel empowered to voice when they feel their energy dropping.</p><p>When energy is low, change it up! Try a brief energizer like jumping jacks or stretching. Ask everyone to stand, move to a different part of the room, sit on the floor, or go outside. It’s worth making these small adjustments to ensure everyone can stay engaged.'),
    array('You manage participation, ensuring everyone&rsquo;s voice is heard.','How much each participant chooses to talk will vary, as will their communication style. Draw out the quieter participants by asking pairs or small groups to discuss questions first or requesting their opinion once other people have talked a bit. Allocate different roles to the people you feel might be hogging too much attention, such as a note taker, timekeeper, or scribe on the board. Ensure small group work has a balance of participants with different communication styles.'),
    array('You adapt your facilitation style based on the needs of the group.','Sometimes your group will need a more directive facilitation style. This means you will tell the group what they should be doing. Other times, often once the group knows each other well, a more consultative facilitation style can be effective. This means that participants voice what they think is needed and discussion flows based on these needs.  '),
    array('You take a step back and let the other members of the group carry the discussion.','Facilitators only need to activate the group, and then take a step back. Facilitators can ask questions, point to people who deserve their turn at answering, and then let the group members carry the discussion. If a facilitator speaks the whole time, it will defeat the purpose of the meeting, which is to collaborate with a group of people.'),
    array('You pace yourself so that you get to every objective.','On your agenda, indicate how much time you estimate each activity or discussion will take. Then during the meeting, set a timer on your phone or ask another participant to keep time throughout. If you feel focus slipping, remind the team about your time constraints. '),
    array('You move the group towards taking ownership of action steps coming out of the meeting.','At the end of the meeting, leave time to discuss what the next steps will be and who will be taking ownership over those tasks. Add those tasks to the project plan to ensure they aren’t lost in the shuffle. '),
    array('You hold people accountable and point out when norms are not being upheld.','While everyone has the responsibility to uphold norms and point out when norms are being violated, you have a special responsibility as the facilitator to be the norms enforcer. You may want to refresh on team norms at the beginning of your meeting so they’re fresh in the participants’ minds. Call out norms violations respectfully and in service of achieving your meeting goals. '),
  );?>

  <?php bz_make_instant_range_table($items);?>

  <?php bz_close_box(); ?>
    <?php $GLOBALS['hlevel'] = 4; ?>
  <h3>How do I prepare an agenda?</h3>
  <?php bz_open_box('question', 'Take a look at this sample agenda:'); ?>
  <div class="bz-example full">
    <table class="no-zebra">
      <tr>
        <th>Time and Location:</th>
        <td>Rutgers-Newark, Conklin Hall, Room 319, 6:00-8:00pm</td>
      </tr>
    <tr>
      <th>Attendees:</th>
      <td>
        <ul>
          <li>Rihanna Howe</li>
          <li>Felix Valdez</li>
          <li>Alana Carey</li>
          <li>Yee Hoi</li>
          <li>Shoba Pavi</li>
          <li>Leon Zieff</li>
        </ul>
      </td>
    </tr>
    <tr>
      <th>Objectives:</th>
      <td>
        <ol>
          <li>Determine what leadership role each Fellow will fill on the team</li>
          <li>Create a comprehensive project plan for the Capstone Challenge</li>
          <li>Identify users, determine who they will interview, and create an interview guide</li>
        </ol>
      </td>
    </tr>
    <tr>
      <th>Agenda in short:</th>
      <td>
        <ul>
          <li>[15 mins] Identify roles</li>
          <li>[25 mins] Create a project plan</li>
          <li>[35 mins] Plan for research</li>
          <li>[10 mins] Flex time as needed</li>
        </ul>
      </td>
    </tr>
    <tr>
      <th colspan="2">Agenda in full:</th>
    </tr>
    <tr>
      <td>Identify roles [15 mins]</td>
      <td>
        <ul>
          <li>Introduce activity: Every Fellow will take on a leadership role during the Capstone Challenge so that we all have the opportunity to lead and contribute meaningfully. As you consider which roles interest you, do not feel constrained by your strengths; you might be looking for a stretch opportunity to develop in an area that you might typically find challenging. As we decide on these roles, I want us to go into the discussion with the lens of compromise. You may not get your first choice, but the good of our team is bigger than each of our individual preferences.</li>
        </ul>
        <ul>
          <li>Explain the steps of the activity:</li>
        </ul>
        <ol>
          <li>A Fellow writes the five roles on the board.</li>
          <li>Each Fellow gets two sticky notes and writes their name on both.</li>
          <li>Fellows go to the board and vote with their sticky notes, placing them by the name of the two roles that interest them most.</li>
          <li>Discuss each role as a team, figuring out who should fill that role based on their compass direction (from the module) and their preference.</li>
        </ol>
        <ul>
          <li>Work on the activity</li>
        </ul>
      </td>
    </tr>
    <tr>
      <th>&hellip;</th>
      <td><em>(The agenda continues for each of the objectives)</em></td>
    </tr>
  </table>
  </div>
  <p>&nbsp;</p>
  <p>Now match each of the following pieces of a typical agenda to where they appear in this sample agenda:</p>
  <p><strong>Intended Outcomes</strong> appear in:</p>
  <?php
    $items = array(
      array('correctness' => 'incorrect', 'content' => 'Time and Location'),
      array('correctness' => 'incorrect', 'content' => 'Attendees'),
      array('correctness' => 'correct', 'content' => 'Objectives'),
      array('correctness' => 'incorrect', 'content' => 'Agenda in short'),
      array('correctness' => 'incorrect', 'content' => 'Agenda in full'),
    );
    bz_make_cr_list($items, 'radio-list');
  ?>
  <p><strong>Method to accomplish an intended outcome</strong> appears in:</p>
  <?php
    $items = array(
      array('correctness' => 'incorrect', 'content' => 'Time and Location'),
      array('correctness' => 'incorrect', 'content' => 'Attendees'),
      array('correctness' => 'incorrect', 'content' => 'Objectives'),
      array('correctness' => 'incorrect', 'content' => 'Agenda in short'),
      array('correctness' => 'correct', 'content' => 'Agenda in full'),
    );
    bz_make_cr_list($items, 'radio-list');
  ?>
  <p><strong>Talking points</strong> appear in:</p>
  <?php
    $items = array(
      array('correctness' => 'incorrect', 'content' => 'Time and Location'),
      array('correctness' => 'incorrect', 'content' => 'Attendees'),
      array('correctness' => 'incorrect', 'content' => 'Objectives'),
      array('correctness' => 'incorrect', 'content' => 'Agenda in short'),
      array('correctness' => 'correct', 'content' => 'Agenda in full'),
    );
    bz_make_cr_list($items, 'radio-list');
  ?>
  <p><strong>Estimated time for each agenda item</strong> appears in:</p>
  <?php
    $items = array(
      array('correctness' => 'incorrect', 'content' => 'Time and Location'),
      array('correctness' => 'incorrect', 'content' => 'Attendees'),
      array('correctness' => 'incorrect', 'content' => 'Objectives'),
      array('correctness' => 'incorrect', 'content' => 'Agenda in short'),
      array('correctness' => 'correct', 'content' => 'Agenda in full'),
    );
    bz_make_cr_list($items, 'radio-list');
  ?>
  <?php bz_close_box(); ?>
  <?php bz_open_box('action', null, 'Top two tips for a successful agenda'); ?>
  <ol>
    <li>When you sit down to create your agenda, the first thing to do is <strong>identify the intended outcomes</strong> for the meeting (the objectives). Be very clear and concrete when listing your objectives so you can later tell if your team has achieved them.</li>
    <li><strong>Add flex time</strong> to the end of your agenda. If one agenda item ends up running over, you’ll have the ability to adapt as needed.</li>
  </ol>
  <?php bz_close_box(); ?>
  <?php bz_open_box('question', 'Looking back at the sample agenda, what do you notice is included in the talking points for the Identify roles agenda item? (Check all that apply)'); 
    $items = array(
      array('correctness' => 'correct', 'content' => 'Voicing the objective of that agenda item', ),
      array('correctness' => 'correct', 'content' => 'Explaining the purpose behind the objective and the methods you chose ', ),
      array('correctness' => 'correct', 'content' => 'Explaining the steps of the method and how attendees should participate ', ),
      array('correctness' => 'incorrect', 'content' => 'An overview of all the objectives', 'feedback' => 'You could provide an overview of all the objectives at the beginning of the meeting.', ),
    );
    bz_make_cr_list($items);
  bz_close_box(); ?>

  <?php bz_open_box('key', 'There are many different agenda templates, and you should pick one that’s right for you. Here are some to get you started:', 'Agenda templates'); ?>
  <table class="equal-column-widths">
    <tr>
      <td><img src="/courses/1/files/12708/preview" alt="meeting agenda template example 1" style="width:100%; height: auto;"/></td>
    </tr>
    <tr>
      <td><img src="/courses/1/files/12709/preview" alt="meeting agenda template example 2" style="width:100%; height: auto;"/></td>
    </tr>
    <tr>
      <td><img src="/courses/1/files/12710/preview" alt="meeting agenda template example 3" style="width:100%; height: auto;"/></td>
    </tr>
  </table>
  <p>You'll find plenty more <a href="https://templatelab.com/meeting-agenda-templates/" target="_blank">here</a>.

  <?php bz_close_box(); ?>


  <?php bz_open_box('question', 'Should share your agenda with your team in advance of the meeting?', 'Final quick question');

  $items = array(
    array('correctness' => 'correct', 'content' => 'Yes'),
    array('correctness' => 'incorrect', 'content' => 'No'),
  );
  bz_make_cr_list($items, 'radio-list', null);
  bz_close_box();
  bz_open_box('answer', null);?>
  <p>Sharing the agenda in advance will help your team review and plan before they arrive so that they can be fully engaged participants.</p>
  <p>In order to successfully facilitate Learning Lab during the Capstone Challenge, and as part of your Tackle Career Challenges Project, you’ll have to create a meeting agenda. If you’re facilitating next week, it’s a good idea to do that now!</p>
  <?php bz_close_box(false);?>
  <h2>SO, YOU’RE FACILITATING<br />LEARNING LAB THIS WEEK&hellip;</h2>
  <?php $GLOBALS['hlevel'] = 3; ?>
  <?php bz_open_box('action', 'If you’re the Project Manager or the Lead Researcher, you’re facilitating sections of Learning Lab this week. Your objectives and suggested methods for reaching them are listed below. Be sure to come prepared with an agenda to facilitate Learning Lab.');
  ?>
    <h3>HIGH-LEVEL AGENDA</h3>
    
    <table class="full">
      <tr>
        <th>TIME</th>
        <th>ACTIVITY</th>
        <th>FACILITATOR</th>
      </tr>
      <tr>
        <td>20 mins</td>
        <td>Opening</td>
        <td>LC</td>
      </tr>
      <tr>
        <td>10 mins</td>
        <td>Project Plan Check-In</td>
        <td>Project Manager </td>
      </tr>
      <tr>
        <td>30 mins</td>
        <td>Debrief Research</td>
        <td>Lead Researcher</td>
      </tr>
      <tr>
        <td>20 mins</td>
        <td>Create a Problem Statement</td>
        <td>Lead Researcher</td>
      </tr>
      <tr>
        <td>20 mins</td>
        <td>Brainstorm</td>
        <td>Project Manager</td>
      </tr>
      <tr>
        <td>20 mins</td>
        <td>Closing</td>
        <td>LC</td>
      </tr>
    </table>
    
    <p>&nbsp;<br /></p>
    <h3>Objectives and suggested methods:</h3>
    <table>
      <thead><tr><th>Activity</th><th>Objectives</th><th>Suggested Methods</th></tr></thead>
      <tbody>
        <tr>
          <th>Project Plan Check-In</th>
          <td>Update the project plan to ensure the cohort is on track in the Capstone Challenge. </td>
          <td>
            <ol>
              <li>Go through each task that is due with owners and update the Project Plan in real time.</li>
              <li>If any Fellow has fallen behind, lead a discussion about why and what can be done moving forward.</li>
            </ol>
          </td>
        </tr>
        <tr>
          <th>Debrief Research</th>
          <td>
            <ol>
              <li>Share research to get everyone up to speed. </li>
              <li>Make connections and pull out surprising insights about users’ needs.</li>
            </ol>
          </td>
          <td>
            <ol>
              <li>Go through each task that is due with owners and update the Project Plan in real time.</li>
              <li>If any Fellow has fallen behind, lead a discussion about why and what can be done moving forward.</li>
            </ol>
          </td>
        </tr>
        <tr>
          <th>Create a Problem Statement </th>
          <td>Create a problem statement that identifies the user, the user’s need, and a surprising insight about the user’s need.</td>
          <td>
            <ol>
              <li><a class=" instructure_file_link" title="Click to download PDF" href="/courses/1/files/12711/download?wrap=1">Story Share and Capture method</a></li>
              <li><a class=" instructure_file_link" title="Click to download PDF" href="/courses/1/files/12712/download?wrap=1">Saturate and Group method</a></li>
            </ol>
          </td>
        </tr>
        <tr>
          <th>Brainstorm</th>
          <td>
            <ol>
              <li>Ideate potential solutions to the problem statement.</li>
              <li>Use the problem statement Madlib handout and facilitate a discussion</li>
            </ol>
          </td>
          <td>
            <ol>
              <li>Brainstorm (refresh on brainstorming rules in the previous module) </li>
              <li>Select which idea(s) to prototype</li>
            </ol>
          </td>
        </tr>
      </tbody>
    </table>
  <?php bz_close_box(); ?>
  <blockquote>The number of meetings I&rsquo;ve been in &mdash; people would be shocked. But that&rsquo;s how you gain experience, how you can gain knowledge, being in meetings and participating. You learn and grow.<p class="quote-source">Tiger Woods, professional golfer</p></blockquote>
  <h2 id="wrap-up">Wrap-up</h2>
  <div>
    <p>In this module we looked at how to effectively facilitate meetings, since you'll be having meetings to work on your project and, naturally, in almost any job in the future.</p>
    <p>We asked you to self-evaluate your facilitation skills and looked at some tips based on where you need to grow (we suggest you scroll up and revisit those as soon as you're done here).</p>
    <p>We also looked at some meeting agendas (and hopefully already practiced creating one if you're facilitating this week).</p>
    <h3>Next Steps:</h3>
    <ol>
      <li>Complete Tackle Career Challenges Project, Part 1: Empathy-Based Research</li>
      <li>Conduct empathy-based research for the Capstone Challenge (interview 3+ users)</li>
      <li>Make sure your team's Project Manager has finalized the project plan and shared it with the rest of your cohort</li>
    </ol>
  </div>
</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>