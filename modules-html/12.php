<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>CAPSTONE CHALLENGE: PROTOTYPE</title>
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
    <p>This module is about giving and getting feedback, which will be critical to your success on the Capstone Challenge (for example when working on your prototype in the next Learning Lab) and in any future job.</p>
    <h2 id="why">Why is feedback important?</h2>
    <?php bz_open_box('reflection', 'When you think of giving and receiving interpersonal feedback, what makes it difficult? (Check all that apply)');
      $items = array(
        array('content' => 'I don&rsquo;t know where to start.'),
        array('content' => 'I feel like I don&rsquo;t have enough time or energy.'),
        array('content' => 'It can hurt- feelings, relationships, dynamics.... I&rsquo;m afraid of the damage. '),
        array('content' => 'I don&rsquo;t feel the urgent need for change or I don&rsquo;t believe the other person wants to change. '),
        array('content' => 'It&rsquo;s uncomfortable.'),
        array('content' => 'It&rsquo;s hard to know when it&rsquo;s the right time to have the conversation.'),
        array('content' => 'I feel like I need to have all the answers before having the conversation.'),
        array('content' => 'I&rsquo;m afraid my words won&rsquo;t come out right.'),
        array('content' => 'I don&rsquo;t know how to give or receive it.'),
      );
      bz_make_cr_list($items);
    bz_close_box();
  //
    bz_open_box('answer', null, 'It&rsquo;s like that for most people.');
      ?>
      <p>Giving and getting feedback can be difficult for all these reasons. However, holding a mirror to ourselves and others is the only way we can grow and improve as individuals and a team. </p>
      <p>It’s the midway point in the Capstone Challenge, so it’s a good time to give and get feedback with your teammates. You’ll have the space in Learning Lab this week for a feedback discussion. </p>
      <?php 
    bz_close_box(); 
    //
    bz_open_box('video');
      $transcript = '
      <p>Hi! I’m Jenni. I’m a Data Science Manager at Instagram, and I’m here to talk to you a little about one of my favorite topics: feedback.</p>
      <p>Feedback, in my opinion, is one of the things that really sets people apart in the workplace. Giving and receiving honest, critical feedback was one of the hardest things for me to learn as a manager and as a teammate. When I first started managing, it was really hard for me to give people honest, critical feedback because, frankly, I thought they were going to think I was mean or that I didn’t like them or that they would take it personally. I was worried. My ego got in the way that people wouldn’t like me if I was giving them critical feedback.</p>
      <p>What I started to realize over time is that I was depriving people on my team and depriving my partners in the workplace of an opportunity to actually get better at their jobs, because if I didn’t point out critical feedback then they would have no way of knowing what they weren’t doing well or what they could improve on. Actually, my giving them feedback was a gift. One of the ways I was able to realize this was starting to give critical feedback and getting really positive signals from people that they really liked this, and also seeing that people were actually doing better at their jobs after I gave them the critical feedback.</p><p>So for me, one lesson that I learned is that giving feedback is a muscle. The more you do it, the easier it gets. I really recommend that all of you start doing this in small ways, and I think you’ll find over time that your capacity to give feedback is continually increasing, and it’s going to pay dividends.</p>
      ';
      bz_embed_video('vimeo', '231583459', '1:36', 'Jenni, a Data Scientist at Instagram, shares why feedback skills are important at the workplace', $transcript);
    bz_close_box();
  //
    bz_open_box('question','Another Fellow in your Braven cohort is frustrated with you. She feels like you keep interrupting her when she tries to speak in Learning Lab. You notice that she starts to give you the cold shoulder, but you don’t understand why. What would you prefer?', 'See it from someone else&rsquo;s perspective');
      $items = array(
        array('correctness' => 'correct', 'content' => 'She approaches you privately after Learning Lab and explains how you are hurting her feelings.'),
        array('correctness' => 'incorrect', 'content' => 'She continues to give you the cold shoulder and you remain confused as to why.'),
        array('correctness' => 'incorrect', 'content' => 'She tells other Fellows in the cohort that she’s really mad at you.'),
        array('correctness' => 'incorrect', 'content' => 'She starts interrupting you when you speak to teach you a lesson.'),
      );
      bz_make_cr_list($items, 'radio-list');
    bz_close_box();
  //
    bz_open_box('answer', 'It’s always better to have the difficult feedback conversation than let it fester or turn into gossip. After all, you want to know when your actions are hurting someone else.');
    bz_close_box();
  //
    ?>
    <h2 id="how">How do I do this?</h2>
    <h3>How should I give feedback?</h3>
    <h4>The basics</h4>
    <?php 
    bz_open_box('question', 'It’s a couple months into your first job out of college. The honeymoon period is ending and you’re starting to feel some tension with some of your colleagues. It’s time to initiate some feedback conversations. Who can you <strong>not</strong> give feedback to?');
      $items = array(
        array('correctness' => 'incorrect', 'content' => 'Your peers'),
        array('correctness' => 'incorrect', 'content' => 'The intern'),
        array('correctness' => 'incorrect', 'content' => 'Your manager'),
        array('correctness' => 'correct', 'content' => 'This is a trick question! You can give feedback to anyone you work with.'),
      );
      bz_make_cr_list($items, 'radio-list', 'instant-feedback', 'dont-mix');
    bz_close_box();
    //
    bz_open_box('answer','Giving feedback to your manager might seem like the most difficult, but having the conversation is better than not having it all. Using what you&rsquo;ll learn in this module will make such conversations easier and more productive,');
    bz_close_box();
    //
    bz_open_box('question', 'What should you give feedback on in a workplace setting? (check all that apply)');
      $items = array(
        array('correctness' => 'correct', 'content' => 'Task-specific and day-to-day work'),
        array('correctness' => 'correct', 'content' => 'Overall performance in the role'),
        array('correctness' => 'correct', 'content' => 'Your working relationship'),
        array('correctness' => 'correct', 'content' => 'Strengths and things colleagues are doing well'),
        array('correctness' => 'correct', 'content' => 'Improvement in a development area'),
        array('correctness' => 'correct', 'content' => 'Effort that exceeds expectations'),
        array('correctness' => 'correct', 'content' => 'Areas that can be improved and can lead to new actions, behaviors, and/or results'),
        array('correctness' => 'correct', 'content' => 'Performance expectations or standards that have not been met'),
        array('correctness' => 'correct', 'content' => 'Difficulty with a task or skill'),
        array('correctness' => 'correct', 'content' => 'Behavior that reflects poorly on the team or negatively impacts others'),
        array('correctness' => 'incorrect', 'content' => 'Personal life '),
        array('correctness' => 'incorrect', 'content' => 'Personality '),
      );
      bz_make_cr_list($items);
    bz_close_box();
    //
    bz_open_box('answer','Keep your feedback relevant to the work at hand so that it’s actionable for your colleagues. Remember that feedback isn’t only constructive. It’s important to your colleagues to hear positive feedback as well.');
    bz_close_box();
    //
    bz_open_box('question', 'In the workplace, you will encounter informal and formal opportunities to give feedback. Sort the following examples:');
      $cats = array ('Informal' => '', 'Formal' => '');
      $items = array(
        array('answer'=>'Informal', 'content' => 'Someone pulls you aside after a meeting to talk'),
        array('answer'=>'Formal', 'content' => 'Filling out an online survey'),
        array('answer'=>'Formal', 'content' => 'You recieve an annual performance review from your manager'),
        array('answer'=>'Informal', 'content' => 'Someone stops by your desk'),
      );
      bz_make_multi_radios($items, $cats);
    bz_close_box();
    //
    ?>
    <blockquote>Informal feedback often finds its way into formal feedback. Both kinds are necessary for a healthy team culture.</blockquote>
    <h4>Advanced Strategies</h4>
    <?php 
    bz_open_box('question', 'The following is a list of ways to ensure the feedback you give is effective, meaning it comes across to your colleague in a way that they hear it and make any necessary changes. Match the items in the three columns.');
      $headings = array(
        'Less effective feedback',
        'More effective feedback',
        'Effective feedback is&hellip;',
      );
      $items = array(

        array(
          '“I don’t think you can change this, but I wanted to give you this feedback anyway.”', 
          'Authentic feedback comes from a place of <span class="bz-has-tooltip" title="accepting and respecting others as they are without judgment or evaluation">unconditional positive regard</span> (even when it focuses on things to improve). When you truly mean it, your feedback conveys meaning and builds trust.',
          'Authentic and meaningful',
        ),
        array(
          '“You did great!”',
          '"You gave a great presentation! You captivated your audience from the beginning with how you opened with a personal story, you were clear on your objectives and agenda before you got started, and you provided clear headlines for each data set you presented so people knew what to walk away with."',
          'Specific and actionable',
        ),
        array(
          '"Your project idea is too crazy and expensive"',
          '"I like the ambition and creativity of your idea. Do you think we can make this more practical, considering our limited resources?"',
          'Empowering and motivating',
        ),
        array(
          '“Here’s how the presentation went from my perspective.”',
          'Before you give feedback, you might ask for permission or you might ask them first for their opinion before you give your own. E.g., "How did you think it went?" or "Did this go according to your plans?" And after listening and giving your own feedback, you provide space for the person to share reactions, questions, and responses. It&rsquo;s a conversation.',
          'Empathetic',
        ),
      );
      bz_make_match_table($items,$headings, 'equal-column-widths');
    bz_close_box();
    //
    bz_open_box('question','Below are four things you can do to make giving feedback to others less painful. Match the strategy with the correct example.');
      $items = array(

        array(
          '<h6>IDENTIFY WHAT IS HOLDING YOU BACK</h6>
          You might hold back from giving feedback for a number of reasons like fear of failure, fear of hurting someone&rsquo;s feelings, fear of making the other person uncomfortable, fear of being misunderstood, fear of damaging a relationship. Once you identify what is holding you back from giving feedback, acknowledge this fear to yourself and even to the person you’re giving feedback to. Your vulnerability will help ease tension in the conversation. ',
          '<em>Devonda felt that Jeremy was not pulling his own weight, which meant she was working overtime, but she was nervous to confront him. She realized she was afraid of hurting the lighthearted and fun collegial relationship they had built over the last few months. They met for a one-on-one, and she started the conversation saying, “I want to give you some feedback. This isn’t easy for me, because I value our friendship and the last thing I want to do is damage the relationship we’ve built.”</em> ',
        ),
        array(
          '<h6>CREATE A CULTURE OF FEEDBACK</h6>
          A culture of feedback can normalize giving and getting feedback and place value on having a growth mindset and learning and continuously improving. Even as a new hire, you can push for regular feedback meetings with your colleagues and manager as a way to grow yourself and as an outlet for providing feedback to others. ',
          '<em>As an intern early in her time with the company, Sade thinks that if she were to give her supervisor feedback, she may damage her relationship with her boss and her chances of this internship leading to an offer. It might be worth asking her supervisor for periodic opportunities to exchange feedback with each other, as an opportunity for her to practice feedback conversations, enhance performance, and for the two to build a relationship. This decreases any sense of threat and allows a two-directional mutually-beneficial exchange of feedback. Her supervisor might be impressed with her initiative and desire to be effective in her job.</em>',
        ),
        array(
          '<h6>FOCUS ON RELATIONSHIP-BUILDING</h6> 
          It can feel much easier and less risky to give feedback to someone you have a strong relationship with. Think about how effortless it can feel with family or your closest friends. Building trusting relationships will create a safe space for a feedback exchange, and in turn, it will shape that culture of feedback.',
          '<em>From day one on the job, Adrian put in a lot of effort making strong connections and building friendships with his teammates. He invited them to lunch, asked them questions about their life outside of work, and told them stories about his own personal life. Soon, he had inside jokes with his teammates and they were hanging out on the weekends. When a tense situation came up with Eve, one of his closest work friends, he knew he could have a heart-to-heart with her. </em>',
        ),
        array(
          '<h6>CHECK YOUR MINDSETS</h6>
          Be sure to check your mindsets before a feedback session. Otherwise, you may not actively listen and end up losing an opportunity to gain perspective, or, you may end up saying something that you will regret later. Be sure to go into a feedback conversation with a growth mindset both for yourself and the other person. ',
          '<em>Carlos was about to step into a feedback conversation with Diana. From his perspective, her disorganization on their team project had led to a low quality product, and he needed to tell her that. Before starting the conversation, he reminded himself that this was not about blaming her. Instead, the goal was to get the team on the same page and improve for next time. He realized he should start by asking for her perspective on the situation and keep the end goal of a better experience for everyone in mind.</em> ',
        ),
      );
      bz_make_match_table($items);
    bz_close_box();
    //
    bz_open_box('key','Here are some other mindset traps people often get into when giving feedback. Hover to reveal how to turn these traps into growth mindsets.','More strategies:'); ?>
      <table>
        <thead>
          <tr>
            <th>MINDSET TRAP</th>
            <th>GROWTH MINDSET</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>I'm certain that I'm right.</td>
            <td>There's usually more than one way to accomplish a task.</td>
          </tr>
          <tr>
            <td>This is his/her fault.<br />This is my fault.</td>
            <td>How do we fix it and how do we do it better next time?</td>
          </tr>
          <tr>
            <td>I've got to help him see it my way.</td>
            <td>I need to take time to consider how s/he sees the situation.</td>
          </tr>
          <tr>
            <td>This problem has nothing to do with me.</td>
            <td>How have my actions contributed to this problem? how could I have prevented it?</td>
          </tr>
          <tr>
            <td>Mistakes are bad.</td>
            <td>Mistakes happen. What can I learn from this mistake, so I can do better in the future?</td>
          </tr>
          <tr>
            <td>How I feel is irrelevant. How the other person feels is irrelevant. </td>
            <td>Both our viewpoints and feelings are important. </td>
          </tr>
          <tr>
            <td>I've had it! I'm about to blow my top! </td>
            <td>Take a step back and cool down. It's difficult to engage in effective feedback when you're angry.</td>
          </tr>
          <tr>
            <td>I have to get this off my chest &mdash; NOW!</td>
            <td>In addition to managing your emotions, make sure to ask for permission first before giving feedback. The chances things won't go well are high if the person you are giving feedback to isn't ready to receive your feedback. Make sure it's a good time and if not, schedule a time later that is. </td>
          </tr>
        </tbody>
      </table>
      <?php 
    bz_close_box();
    //
    bz_open_box('question', 'Eva gives the same feedback in three different ways. Watch each video and then match what the recipient was feeling after receiving the feedback that way.');
      $headings = array(
        'Example', 'How it felt',
      );
      $items = array(
        array(
          '<h6>Scenario 1</h6>
          <iframe style="display: block; margin-left: auto; margin-right: auto;" src="https://player.vimeo.com/video/142296624?color=eb3b46" width="240" height="160" allowfullscreen="allowfullscreen"></iframe>
          <p class="transcript">You don&rsquo;t care about our team because you don&rsquo;t work hard enough and I feel like you&rsquo;re kind of selfish.</p>',
          'I would feel hurt and attacked. Even though Eva remained emotionally calm, she questioned my character and made me feel unsafe by calling me selfish and irresponsible. I knew there was a reason why I was so unhappy on this team.',
        ),
        array(
          '<h6>Scenario 2</h6>
          <iframe style="display: block; margin-left: auto; margin-right: auto;" src="https://player.vimeo.com/video/142294500?color=eb3b46" width="240" height="160" allowfullscreen="allowfullscreen"></iframe>
          <p class="transcript">When you didn&rsquo;t show up to last week&rsquo;s team meeting, that made me feel like you didn&rsquo;t think our project was important.</p>',
          'This was tough to hear. I&rsquo;m sorry that I was impacting the team in this way. I can see how Eva might think I don&rsquo;t care about the project. I just thought the meeting was not important or required. I probably should&rsquo;ve checked in with the team before deciding not to show up and maybe we could have rescheduled it.',
        ),
        array(
          '<h6>Scenario 3</h6>
          <iframe style="display: block; margin-left: auto; margin-right: auto;" src="https://player.vimeo.com/video/142294501?color=eb3b46" width="240" height="160" allowfullscreen="allowfullscreen"></iframe>
          <p class="transcript">(Silence)</p>',
          'Man, what am I supposed to do with this? I feel confused, and kind of disrespected.',
        ),
      );
      bz_make_match_table($items, $headings, 'equal-column-widths');
      ?>
      <p>Which scenario seems like the best way to provide feedback?</p>
      <?php 
      $items = array(
        array('correctness' => 'incorrect', 'content' => 'Scenario 1'),
        array('correctness' => 'correct', 'content' => 'Scenario 2'),
        array('correctness' => 'incorrect', 'content' => 'Scenario 3'),
      );
      bz_make_cr_list($items, 'radio-list', 'instant-feedback', 'dont-mix');
    bz_close_box();
    //
    bz_open_box('answer',null); ?>
      <p>Scenario 2 follows the feedback framework:</p>
      <div class="bz-example" style="text-align: center;">
        <h6>When you did X, I felt Y.</h6>
      </div>
      <p>Using this sentence structure helps you communicate how someone's actions or behaviors impacted you without attacking someone's personality or character. It cultivates empathy and creates space for conversation.</p>
      <?php 
    bz_close_box(false);
    //
    bz_open_box('key', null, 'How to use this framework effectively');
      ?>
      <ol>
        <li>You will not only need to fill in the blanks for this sentence, but you will also need to prepare for the conversation as a whole.</li>
        <li>When giving feedback, you don't need to provide a solution. Your responsibility is to give the feedback. Let the recipient receive it and figure out what to do next. Let him/her invite your thought partnership but don't expect it. </li>
        <li>There's still a chance that the recipient could be defensive and emotions could escalate unexpectedly. Even though you are the one who may feel wronged, it's important not to give up and to keep striving for mutual understanding. Stay focused on the relationship, not on being right and proving wrong.</li>
      </ol>
      <?php 
    bz_close_box(false); 
    //
    bz_open_box(); ?>
      <p>You’ve noticed that your colleague Darren hasn’t been present during your team meetings. He shows up, but he’s typically on his phone or gazing out the window instead of paying attention to the tasks at hand. You decide to approach Darren to give him some feedback.</p>
      <p>Use the <i>When you did X, I felt Y</i> framework and plan out what you would say to Darren:</p>
      <?php
      bz_make_textarea();
    bz_close_box(false); 
  //
    bz_open_box('answer', null, 'A possible way to give Darren feedback:');?>
      <div class="bz-example">
        "Yesterday during our team meeting, I noticed that you were on your phone when I was talking. This made me feel embarrassed, like what I was saying wasn’t important."
      </div>
      <?php 
    bz_close_box(); 
  //
    bz_open_box('key', null, 'Another framework: STAR');?>
      <p>Here's another framework that can lead to an objective, evidence-based, two-way conversation focused on learning and strengthening relationshipsis:</p>
      <div class="bz-example">
        <ul>
          <li><strong>S</strong>ituation/<strong>T</strong>ask: What was the situation or task you're giving feedback about?</li>
          <li><strong>A</strong>ctions: What actions were taken (by everyone)</li>
          <li><strong>R</strong>esults: What were the results of these actions (and how did it feel)?</li>
        </ul>
      </div>
      <p>You’ll notice this is similar to the <span class="bz-has-tooltip" title="Problem &rArr; Action &rArr; Results">PAR</span> interview framework.</p>
      <?php
    bz_close_box();
    //
    bz_open_box('read'); ?>
      <p>Read the following two stories recounting a manager giving an employee feedback. Then determine:</p>
      <ol>
        <li>Which part is the Situation/Task, which part is the Actions, and which part is the Results. (<strong>Pro tip:</strong> They may not fall in that order!</li>
        <li>Whether the feedback given is asking or telling language.</li>
      </ol>
      <div class="bz-example">
        <h6>Example 1</h6>
        <blockquote>
          <p>Darya is working on a team project at work. She has a meeting scheduled with her manager. When she sits down in her manager’s office, he begins:</p>
          <p>"Here's the thing. You were late in consolidating your part of the project, and there was no indication on your end that you were having difficulty bringing it all together. Because of this, we were not prepared to tackle the final question in the project. I have no idea whether we came up with an acceptable answer for that last part, but we shouldn't have been in that position in the first place. You were assigned a task that required no more work than everyone else's. But you were the last to submit, and missed the deadline we set. In the future, we cannot be in this position. What can we do to make sure deadlines are met next time?"</p>
        </blockquote>
      </div>
      <p>&nbsp;<br /></p>
      <p>Now match the quotes to the STAR elements:</p>
      <?php 
      $items = array(
        array(
          'Actions',
          '"You were late in consolidating your part of the project, and there was no indication on your end that you were having difficulty bringing it all together."',
        ),
        array(
          'Results',
          '"Because of this, we were not prepared to tackle the final question in the project. I have no idea whether we came up with an acceptable answer for that last part, but we shouldn&rsquo;t have been in that position in the first place."',
        ),
        array(
          'Situation/Task',
          '"You were assigned a task that required no more work than everyone else&rsquo;s. But you were the last to submit, and missed the deadline we set."',
        ),
      );
      bz_make_match_table($items);
    bz_close_box();
    //
    bz_open_box(null, 'Is Darya’s manager using <em>asking</em> or <em>telling</em> language?');
      $items = array(
        array('correctness' => 'incorrect', 'content' => 'Asking'),
        array('correctness' => 'correct', 'content' => 'Telling'),
      );
      bz_make_cr_list($items, 'radio-list');
    bz_close_box();
    //
    bz_open_box(null);?>
      <div class="bz-example">
        <h6>Example 2</h6>
        <p>Manager: <q>"So how do you feel your part of the project went?"</q></p>
        <p>Darya: <q>"Honestly, not well. I thought everything was going great, but the night before we were supposed to report out, I noticed a huge problem from early in the process. Basically I had to go back and re-do the whole thing."</q></p>
        <p>Manager: <q>"Given you were under such a time crunch, why didn't you pull some of us in to help out?"</q></p>
        <p>Darya: <q>"This was a rough section, and I don't think additional people would have helped to get it done faster."</q></p>
        <p>Manager: <q>"Here's the thing, we couldn't move forward until we had your task. I get that stuff happens, but we didn't even know what was going on."</q></p>
        <p>Darya: <q>"I kept feeling like I was just about done and that I could send it out soon. It just kept dragging on though."</q></p>
        <p>Manager: <q>"The way I see it though, if we even had the first half of your work, we could have started to push forward. The decision not to let us know what happened is what set us back as team. In the future I think there needs to be more open lines of communication. What you ended up submitting was great, as usual, and you've been a strong member of our team. But, the communication on progress needs to be stronger next time. Let's check in at the start of the next project to review this idea and see how we can improve things."</q></p>      
      </div>
      <p>&nbsp;<br /></p>
      <p>Same deal as before &mdash; match the quote to the STAR element:</p>
      <?php 
      $items = array(
        array(
          'Situation/Task',
          '"Here&rsquo;s the thing, we couldn&rsquo;t move forward until we had your task. I get that stuff happens, but we didn&rsquo;t even know what was going on."',
        ),
        array(
          'Actions',
          '"The decision not to let us know what happened"',
        ),
        array(
          'Results',
          '"set us back as team"',
        ),
      );
      bz_make_match_table($items);
    bz_close_box();
    //
    bz_open_box(null, 'How about this time &mdash; Is Darya’s manager using <em>asking</em> or <em>telling</em> language?');
      $items = array(
        array('correctness' => 'correct', 'content' => 'Asking'),
        array('correctness' => 'incorrect', 'content' => 'Telling'),
      );
      bz_make_cr_list($items, 'radio-list');
    bz_close_box();
      //
    bz_open_box('answer', null, 'Asking vs. Telling language'); ?>
      <p>“Telling” feedback language might seem stern, but some colleagues will prefer the directness of the feedback, while others will prefer an “asking” style, which is more like a conversation. Knowing how your colleague works best is critical for approaching the feedback conversation in the most productive way. </p>
      <p>You’ll have a better conversation if you plan out (and even rehearse) your feedback. Consider when and where to give the feedback (in-person is always best), what kind of language you want to use (asking/telling), and what you want to say. </p>
      <?php 
    bz_close_box();
      //
    bz_open_box('actions', 'For each of the following situations, plan out how you would give feedback. Use the STAR framework.', 'Your turn to try');?>
      <div class="bz-example">
        <h6>Scenario 1</h6>
        <p>One class you are taking requires that you complete five projects throughout the term with the same group. Each person in the group rotates as team leader, and this project is yours to lead.</p>
        <p>Overall, the team has worked well together, but one person, Isabel, has not been pulling her weight. Last night she even missed an important group meeting, in order to go watch the World Cup with some friends from her dorm. Her unpredictability, having to catch her up, and figuring out what to do when she doesn't do her part has been exhausting for everyone.</p>
        <p>As far as you know, no one has brought this problem up to her yet, and looking over the requirements, you think that all members of the team will need to do their fair share in order for the team to be successful. You have a week left before the project is due. You've reached out to meet with Isabel 1:1 to give her feedback.</p>
      </div>
      <p>&nbsp;<br /></p>
      <p>What would you say?</p>
      <?php bz_make_textarea();?>
      <p>&nbsp;<br /></p>
      <p>In what order did you present the feedback? (there's no right answer, it's just to help you reflect)</p>
      <?php
      $items = array(
        'Situation/Task',
        'Action',
        'Result',
      );
      $cats = array(
        'First' => '', 
        'Second' => '', 
        'Third' => '',
      );
      bz_make_multi_radios($items, $cats, null);
      ?>
      <div class="bz-example">
        <h6>Scenario 2</h6>
        <p>There's a heated discussion going on with the team today. You have been digging in pretty hard saying that the team should propose to buy their equipment from Wilson Enterprises. The group is getting pretty annoyed, especially since they have already come to a consensus on Backcourt Supplies. The decision to go with Backcourt Supplies is also a fair decision considering the risks involved in working with Wilson Enterprises &mdash; risks you didn't consider.</p>
        <p>Eager to move things forward, Dee stands up and says, "This has been settled. We're moving on with Backcourt." You start to respond by saying, "But I think..." Dee replies, "No, we're done." You schedule time with Dee later in the week to discuss the conversation.</p>
      </div>
      <p>&nbsp;<br /></p>
      <p>How would you approach it? What would you say?</p>
      <?php bz_make_textarea();?>
      <p>&nbsp;<br /></p>
      <p>In what order did you present the feedback? (again there's no right answer, it's just to help you reflect)</p>
      <?php
      $items = array(
        'Situation/Task',
        'Action',
        'Result',
      );
      $cats = array(
        'First' => '', 
        'Second' => '', 
        'Third' => '',
      );
      bz_make_multi_radios($items, $cats, null);
      ?>
    <?php 
    bz_close_box();
    //
    bz_open_box('question', 'You might begin to notice some patterns of when it feels right to start with the Situation/Task, Actions, or Results. Drag and drop the explanations into the correct column.');

    $headings = array(
      'Element',
      'Why start with this?',
      'Who might benefit? ',
    );
    $items = array(
      array(  
        'Situation/Task',
        'You want to establish the context first',
        'Someone who wants to ease into receiving feedback',
      ),
      array(  
        'Actions',
        'You want to take a direct approach and jump right in with the behavior or actions you want to address',
        'Someone who prefers to begin by understanding their role in the situation',
      ),
      array(  
        'Result',
        'You want to emphasize the impacts of the person&rsquo;s actions or behavior',
        'Someone who wants to hear the outcome first ',
      ),
    );
    bz_make_match_table($items, $headings);
    bz_close_box();
      //
    bz_open_box('answer',null,'How to make the most of it'); ?>
      <p>At the end of the day, the goal of your feedback conversation is that the person receiving the feedback generates insights and learns from the conversation. To make this happen, you’ll have to:</p>
      <ul>
        <li><strong>Listen:</strong> Make room for the other person to share his/her thoughts and feelings and stay actively focused on what the person is saying instead of formulating your response. Listening may involve asking clarifying questions to better understand what the person is saying and paraphrasing to acknowledge what you've heard.</li>
        <li><strong>Be empathetic:</strong>
          <ul>
            <li>Leave space to acknowledge the discomfort: "I know this is a lot to take in, and I don't want you to feel overwhelmed. How are you feeling about this so far?"</li>
            <li>Open the channels of communication: "Tell me more about how you experienced this situation;" "What are your thoughts on that?"</li>
            <li>Manage your tone, pace, and word choice: "Let's take a moment to process and think"</li>
          </ul>
        </li>
        <li><strong>Don’t forget strengths:</strong> In fact, lead with them. Empower the person to maximize what s/he does well. Use your assessment of the strengths to make a suggestion on how the individual might address the opportunity.</li>
      </ul>
      <?php 
    bz_close_box();
    //
    bz_open_box('question', 'In the following feedback on a presentation, what’s the ratio of positive to constructive feedback?'); ?>
      <div class="bz-example">
        <blockquote>
          <p>You engaged me right away with your personal story, and you used specific examples that related to my own life. You also ended with actionable next steps, which keep me invested in your vision for the future. However, I sometimes struggled to read the PowerPoint and listen to you at the same time. I didn't want to miss anything you were saying, but I worried about not following the slides. You might experiment with fewer words on the slides &mdash; or maybe even no slides. You had me without them.<sup class="bz-has-tooltip" title="Source: Daring Greatly by Brene Brown (2012)">1</sup></p>
        </blockquote>
      </div>
      <p>What’s the ratio of positive to constructive feedback?</p>
      <?php
      $items = array(
        array('correctness'=>'correct', 'content'=>'3 to 1'),
        array('correctness'=>'incorrect', 'content'=>'1 to 3'),
        array('correctness'=>'incorrect', 'content'=>'2 to 2'),
        array('correctness'=>'incorrect', 'content'=>'5 to 1'),
      );
      bz_make_cr_list($items, 'radio-list');
    bz_close_box();
      //
    bz_open_box('answer','While there’s no exact rule of thumb, providing evidence of strengths will often make it easier for your colleague to hear and internalize your feedback. Some workplaces have a 2x2 structure, where colleagues meet for an informal 1:1 conversation where both people share two strengths and two areas for growth about themselves and about the other person.','So what&rsquo;s the magic ratio?');
    bz_close_box();
    ?>

    <blockquote><p>Learning to recieve feedback from each other is what leadership is all about.</p><p class="quote-source">Sheila Heen, consultant</p></blockquote>
    <h3>How should I receive feedback?</h3>
    <h4>Have the right mindset</h4>
    <?php 
    bz_open_box('pulse', 'Think about the last few times you received feedback. How did it feel? (check all that apply)');
    $items = array(

      array('content' => 'Icky. It’s uncomfortable being told what I’m doing wrong. Sometimes I feel attacked.', 'feedback' => 'You’re not alone! A lot of people feel this way.'),
      array('content' => 'Helpful. I know that all feedback is a gift that helps me improve.', 'feedback' => 'Indeed! We can’t always see ourselves clearly, and we need other people to help us continually grow. '),
      array('content' => 'Awesome! All the feedback I get is positive feedback.', 'feedback' => 'It’s great to receive positive feedback, but this may mean you’re missing out on ways you can improve. '),
      array('content' => 'Frustrating. It wasn’t great feedback because I disagreed with it or it wasn’t actionable or specific. ', 'feedback' => 'That is frustrating! Not all feedback is good feedback.'),
      array('content' => 'Unsatisfying. I wish people were more transparent and direct with their feedback so I can actually improve.', 'feedback' => 'Totally. There may be strategies you can use to get more satisfying feedback. Stay tuned...'),
      array('content' => 'N/A. I don’t think I’ve ever received real feedback.', 'feedback' => 'That’s unfortunate! This module will provide some pointers to help you get the feedback you need. '),
    );
    bz_make_cr_list($items);
    bz_close_box();
    //
    bz_open_box('answer','Knowing how to ask for feedback and strategies for receiving it will help you get the feedback you need and feel good about it.', 'All of these feelings are valid and common.');
    bz_close_box(false);
    //
    bz_open_box('question','Karen receives the feedback that she sometimes overpowers the conversation in team meetings. Which of these reactions demonstrate a growth mindset?');
    $items = array(
      array('correctness'=>'correct','content'=>'Karen is determined to improve. In future meetings, she tries to take a step back and let others share their opinions before she does. '),
      array('correctness'=>'incorrect','content'=>'Karen disagrees with this feedback. From her perspective, others are not speaking up, and she needs to move the conversation forward. She decides not to make any changes. '),
      array('correctness'=>'incorrect','content'=>'Karen feels hurt and upset that this is the effect she has on her team members. She decides to keep her mouth shut in team meetings for the foreseeable future. '),
      array('correctness'=>'incorrect','content'=>'Karen feels that her personality has been attacked. Her strong voice and opinionated nature is key to her identity. She starts looking for other jobs because her colleagues at this company do not respect who she is. '),
    );
    bz_make_cr_list($items, 'radio-list');
    bz_close_box();
    //
    bz_open_box('answer',null,'Why does growth mindset matter?');?>
    <p>Receiving feedback with a growth mindset means that you see your current abilities as a starting point that can be developed and improved over time. From this perspective, feedback is always about getting better. It is truly a gift when other people care enough to help you improve!</p>
    <p>One more point about the last reaction, where Karen feels her personality has been attacked by the feedback she received: Identity often plays a role in feedback. You will undoubtedly encounter colleagues who are not conscious of their own biases and may give feedback that plays into a stereotype. </p>
    <?php 
    bz_close_box(false);
    //
    bz_open_box('question', 'If you receive feedback that feels like an identity attack, what’s the most productive thing you could do?');
    $items = array(
      array('correctness'=>'correct', 'content'=>'Have a 1:1 conversation with your colleague to provide feedback on the feedback you received, explaining how it came across to you.'),
      array('correctness'=>'incorrect', 'content'=>'Grin and bear it. It’s not worth digging into this conversation because your colleague will never understand who you really are. '),
      array('correctness'=>'incorrect', 'content'=>'Ignore the feedback because it’s an identity attack. '),
      array('correctness'=>'incorrect', 'content'=>'Talk to other colleagues about it to find out if they’ve had the same experience. '),
    );
    bz_make_cr_list($items, 'radio-list');
    bz_close_box();
    //
    bz_open_box('answer','If a conversation with this colleague does not go well, you may have to escalate the situation. However, opening with a dialogue is generally the best way to help someone else understand where you are coming from.');
    bz_close_box();?>
    <h4>Ask for it</h4>
    <?php 
    bz_open_box('question','It’s a month into his summer internship, and Dylan hasn’t received any feedback from his manager. He knows that if this internship is going to help him develop professionally, he needs to be getting regular, helpful feedback. What could he do? (check all that apply) ');
      $items=array(
        array('correctness'=>'correct', 'content'=>'At the end of every meeting or check-in with his manager, Dylan can ask, “What can I do better?” or “What can be improved for next time?”'),
        array('correctness'=>'correct', 'content'=>'Ask his other colleagues for feedback too. '),
        array('correctness'=>'correct', 'content'=>'Create an anonymous survey and ask colleagues to fill it out as a way to provide honest feedback to him. '),
        array('correctness'=>'incorrect', 'content'=>'Quit the internship because it’s not developing him professionally.'),
        array('correctness'=>'incorrect', 'content'=>'Give his manager critical feedback in the hopes s/he will return the favor. '),
        array('correctness'=>'incorrect', 'content'=>'Write an email to his manager explaining that his internship experience has not been helpful because he hasn’t received any feedback. '),
      );
      bz_make_cr_list($items);
    bz_close_box();
      //
    bz_open_box('answer','Before any nuclear options (quitting, complaining), you can always start with the simplest thing: asking for feedback. Your manager and colleagues will probably admire your maturity and professionalism, and you may kickstart a culture of feedback in the process.');
    bz_close_box(false);
    //
    bz_open_box('question','Dylan ends up talking to his manager after his presentation in a meeting, asking, “How did I do?” His manager says, “You did great!” This is not helpful to Dylan. What else could he say to get a more helpful response?');
      $items = array( 
        array('correctness'=>'correct', 'content'=>'“Which part of my presentation could I improve for next time?”'),
        array('correctness'=>'incorrect', 'content'=>'“Thanks so much! So glad to hear that.”'),
        array('correctness'=>'incorrect', 'content'=>'“That’s it? You’re really not being helpful.”'),
        array('correctness'=>'incorrect', 'content'=>'“I think I did terribly. I don’t think I should do these presentations anymore.”'),
      );
      bz_make_cr_list($items,'radio-list');
    bz_close_box();
    //
    bz_open_box('answer', 'Being more specific in your ask for feedback as well as focusing on what you can do better in the future (versus what you did wrong in the past) can make others feel more comfortable providing you with tangible feedback you can learn from.');
    bz_close_box(false);
    ?>
    <h4>Respond well to feedback</h4>
    <?php 
    bz_open_box('video');
      $transcript = '
        <p><strong>Martha:</strong> Thanks so much for making the time to chat with me. I wanted to talk about the way we work together on projects, because it’s really important to me that we work together well.</p> 
        <p><strong>Tess:</strong> Yes, of course. Our working relationship is important to me too.</p> 
        <p><strong>Martha:</strong> Great. So before our big event last week, I was in charge of getting everything in place and ready to go. We had set a deadline for a month out for me to get the designs from you. However, I didn’t receive the designs from you until a week before the event, which made my job of executing much more difficult. I ended up scrambling and making some little mistakes, which could have been avoided if I’d had the time to plan properly. I am hoping that in the future, we can stick to the deadlines we set, so that I don’t have to scramble and we can host a great event. </p>
        <p><strong>Tess:</strong> Thank you for that feedback. I really appreciate it. Let me see if I’m completely understanding. So because I was late in getting you the designs for this event, you had a limited amount of time to prepare, and it resulted in un-needed stress and even some errors that could have been avoided. Is that accurate?</p>
        <p><strong>Martha:</strong> Yes, exactly. It was pretty stressful for me!</p> 
        <p><strong>Tess: </strong>I’m so sorry about that. I really had no intention of making your life more difficult! I will do what I need to do to make sure I manage my time better and get you designs by the deadline in the future. </p>
        <p><strong>Martha:</strong> Great, that sounds like a good plan. </p>
        <p><strong>Tess:</strong> For the next event we have on the calendar, how far out should we set the deadline so that you have the time you need to plan?</p> 
        <p><strong>Martha:</strong> 6 weeks out would be great for me.</p> 
        <p><strong>Tess:</strong> Ok, I’m taking note and will put that on the calendar as soon as I get back to my desk.</p> 
      ';
      bz_embed_video('vimeo','231609057', '2 minutes (some technical issues with the picture, but the sound works)', 'Watch this feedback conversation', $transcript);?>
      <p>&nbsp;<br /></p>
      <p>What did the person receiving the feedback do? (check all that apply)</p>
      <?php 
      $items = array(
        array(
          'correctness'=>'correct',
          'content'=>'Thanked the feedback giver', 
          'feedback'=>'As you know, it’s difficult to provide feedback! Acknowledge the risk the feedback giver took. Thanking them will also encourage them to continue giving you feedback in the future.'
        ),
        array(
          'correctness'=>'correct',
          'content'=>'Actively listened: repeated back what she heard the feedback giver say', 
          'feedback'=>'By repeating back what you hear in the feedback conversation, you show you are listening and taking it in, as well as checking if you understood the feedback correctly.'
        ),
        array(
          'correctness'=>'correct',
          'content'=>'Wrote down the feedback ', 
          'feedback'=>'This tactic accomplishes multiple things: 1) you can refer back to the feedback after the conversation as it can sometimes be difficult to take in everything at once, 2) it communicates you’re taking the feedback seriously, and 3) it often offers the feedback giver some time and space to think through what they’re trying to say. '
        ),
        array(
          'correctness'=>'correct',
          'content'=>'Made eye contact ', 
          'feedback'=>'Eye contact is important body language for showing that you’re listening. '
        ),
        array(
          'correctness'=>'correct',
          'content'=>'Asked clarifying questions ', 
          'feedback'=>'A great way to make sure you’re on the same page is by asking clarifying questions.'
        ),
        array(
          'correctness'=>'correct',
          'content'=>'Apologized ', 
          'feedback'=>'If your actions made a negative impact on someone else, it’s always the best policy to say you’re sorry.'
        ),
        array(
          'correctness'=>'correct',
          'content'=>'Offered a solution to the problem ', 
          'feedback'=>'You can, but don’t feel like you need to offer a solution on the spot. You should take the time to evaluate the feedback if you need it. You can always follow up another time. '
        ),
        array(
          'correctness'=>'incorrect',
          'content'=>'Crossed her arms ', 
          'feedback'=>'Body language matters. Stay open and curious. '
        ),
        array(
          'correctness'=>'incorrect',
          'content'=>'Questioned whether the feedback was accurate ', 
          'feedback'=>'Being defensive might discourage the feedback giver from ever providing honest feedback to this colleague again. '
        ),
      );
      bz_make_cr_list($items);
    bz_close_box();?>
    <h4>Follow through</h4>
    <?php 
    bz_open_box('key',null,'Having the conversation is just the beginning'); ?>
      <p>Your growth is most tied to what you do with the feedback you received. After you’ve received feedback, here are some strategies to actually act on that feedback.</p>
      <ul>
        <li>Notice when you repeat (or are about to repeat) the behavior you got feedback on. Learn more about why you are motivated to act in this way.</li>
        <li>Create a plan laying out what you will do differently.</li>
        <li>Find someone else in the company who is strong at your weakness and ask for a meeting to learn from him/her.</li>
        <li>Follow up with the feedback giver to brainstorm together ways you could improve. Continually check in with this person to ask about your progress.</li>
      </ul>
      <?php
    bz_close_box();
    // 
    bz_open_box('question', 'A colleague just gave you some feedback. She said your pace of work is slowing the team down. This doesn’t sit right with you because you just don’t think of yourself as a slow worker, and you believe your attention to detail is key to the team’s success. What can you do? (check all that apply)');
      $items = array(
        array('correctness'=>'correct','content'=>'Step into your colleague’s shoes and try to think objectively about what her experience has been. '),
        array('correctness'=>'correct','content'=>'Seek out other colleague’s opinions on the team to see if this is a consistent feeling. '),
        array('correctness'=>'correct','content'=>'Follow up with your colleague to seek more clarification and provide your perspective. '),
        array('correctness'=>'incorrect','content'=>'Ignore the feedback because you know it’s not true. '),
        array('correctness'=>'incorrect','content'=>'Take her feedback at face value and speed up your pace of work, even if it means taking some shortcuts.'),
      );
      bz_make_cr_list($items);
    bz_close_box();
    //
    bz_open_box('answer','You won’t always agree with the feedback you receive, and that’s okay. It’s ultimately up to you to decide which feedback helps you improve.');
    bz_close_box(); ?>
  <h2>SO, YOU’RE FACILITATING<br />LEARNING LAB THIS WEEK&hellip;</h2>
  <?php $GLOBALS['hlevel'] = 3; ?>
  <?php bz_open_box('action');?>
  <p>If you’re the Project Manager or the Lead Prototyper, you’re facilitating sections of Learning Lab this week. Your objectives and suggested methods for reaching those objectives are listed below. Come prepared with an agenda to facilitate Learning Lab.</p>
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
        <td>45 mins</td>
        <td>Build Prototypes</td>
        <td>Lead Prototyper</td>
      </tr>
      <tr>
        <td>15 mins</td>
        <td>Plan to Test</td>
        <td>Lead Prototyper</td>
      </tr>
      <tr>
        <td>20 mins</td>
        <td>Team Check-In</td>
        <td>LC</td>
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
          <th>Build prototypes</th>
          <td>
            Build 1-3 prototypes that can be tested by users. Prototypes must be in physical or digital form.
          </td>
          <td>
            Productive prototype-building work session 
          </td>
        </tr>
        <tr>
          <th>Plan to Test</th>
          <td>
            <ol>
              <li>Determine how you will test your prototypes and who you will test your prototypes with.</li>
              <li>Assign owners for reaching out to users and scheduling testing sessions.</li>
              <li>Determine how you will keep the cohort informed of user feedback for refining prototypes.</li>
            </ol>
          </td>
          <td>
            <ol>
              <li>Brainstorm</li>
              <li>Assign tasks </li>
            </ol>
          </td>
        </tr>
      </tbody>
    </table>
    <?php 
    bz_close_box(); ?>
    <h2 id="wrap-up">Wrap-up</h2>
    <div>
      <p>In this module we looked at getting and giving feedback, which are two of the most important skills you'll need to learn and grow in any job (and life in general).</p>
      <p>We began by looking at how to give feedback. We emphaized that planning how you'll give feedback (e.g. by formulating it using STAR or "When you did X I felt Y") is an important key to making it work.</p>
      <p>Then we looked at some <em>do</em>s and <em>don't</em>s of receiving feedback, and especially on following through with what you've heard to keep getting better.</p>
      <h3>Next Steps:</h3>
      <ol>
        <li>Make sure you begin building prototypes with your cohort to stay on track in the <a href="/courses/1/assignments/684">Capstone Challenge</a>.</li>
        <li>For the <a href="/courses/1/assignments/711">Tackle Career Challenges</a> Project, complete <i>Part 1: Define the Problem</i> and get started on Parts 2 and 3.</li>
      </ol>
    </div>
  </div>
  <script src="../new-ui-sandbox.js"></script>
  <progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>