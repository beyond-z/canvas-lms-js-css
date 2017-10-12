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
    <?php bz_close_box(); ?>

    <?php 
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
        'Authentic feedback comes from a place of unconditional positive regard (even when it focuses on things to improve). When you truly mean it, your feedback conveys meaning and builds trust.',
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


    ?>
  <h3>How should I receive feedback?</h3>

  </div>
  <script src="../new-ui-sandbox.js"></script>
  <progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>