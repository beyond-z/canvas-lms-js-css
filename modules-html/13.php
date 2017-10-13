<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Module 13 CAPSTONE CHALLENGE: REHEARSE</title>
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
$ns = 'csre';
require('functions.php');
?>
<div class="bz-module">
  <h2 id="why">Why is this important?</h2>
  <?php
  bz_open_box('question','Why is it important to be an effective presenter? (check all that apply)');
    $items = array(
      array('correctness'=>'correct', 'content'=>'Presentation skills are at the top of the list for what employers look for when hiring candidates'),
      array('correctness'=>'correct', 'content'=>'It builds your credibility in the workplace'),
      array('correctness'=>'correct', 'content'=>'You can invest people in your ideas or plan '),
      array('correctness'=>'incorrect', 'content'=>'Feeling nervous before public speaking makes you a poor presenter '),
      array('correctness'=>'incorrect', 'content'=>'You’ll have to give a formal presentation in every job interview you have'),
    );
    bz_make_cr_list($items);
  bz_close_box();
  //
  bz_open_box('answer','Surveys often show that people are more scared of public speaking than&hellip;','Presenting doesn&rsquo;t always come easy');
    $items = array(
      'Death',
      'The first day of a new job',
      'Flying on an airplane ',
      'Bungee jumping ',
    );
    bz_make_radio_list($items);
  bz_close_box();
  //
  bz_open_box(); ?>
    <p>Let's travel into the future. It’s the Capstone Presentations Learning Lab, and you’re sitting in the audience as another cohort is presenting. It’s clear that the Fellows in this cohort haven’t prepared or practiced their presentation.</p>
    <p>They’re reading from notes and off the slides, which are crowded with text and hard to read from where you’re sitting. They keep interrupting each other because no one knows what part they’re in charge of presenting. You can barely hear some of the Fellows because they’re facing the screen instead of the audience, and they’re not projecting their voices. And you’re just not following what their design solution is because the presentation has no organization.</p>
    <p>How are you feeling? (check all that apply)</p>
    <?php
    $items = array(
      array('content' => 'Uncomfortable',),
      array('content' => 'Bored',),
      array('content' => 'Sleepy',),
      array('content' => 'Anxious',),
      array('content' => 'Sad',),
      array('content' => 'Hopeful',),
      array('content' => 'Frustrated',),
      array('content' => 'Curious',),
    );
    bz_make_cr_list($items);
    bz_make_textarea(array('other'=>true));
  bz_close_box();
  //
  bz_open_box('answer','This module will equip you with what you need to avoid making your audience feel this way when you present!','No worries!');
  bz_close_box(false); 
  ?>
  <blockquote>&ldquo;I loathe making speeches, and always have. I deliver a lot of them these days, but it’s almost as true today as it was when I first spoke in public as a student some 50-odd years ago. [&hellip;] I remember being scared half to death when my turn came and I had to stand in front of my classmates. [&hellip;] I have become much more practiced at giving speeches, though it still makes me a bit nervous &rdquo;<p class="quote-source">Richard Branson, founder of Virgin Group</p></blockquote>
  <h2 id="how">How do I give effective presentations?</h2>
  <?php
  bz_open_box('reflection', 'Think of a time you were in the audience during a great presentation. What made the presenter so effective? (check all that apply)', 'Think back on your own experience');
    $items = array(
      array('content'=>'The presentation was focused ',),
      array('content'=>'The presentation was organized ',),
      array('content'=>'The presenter told relatable stories ',),
      array('content'=>'The presenter used compelling data ',),
      array('content'=>'You felt an empathic connection with the presenter',),
      array('content'=>'The presenter was confident ',),
      array('content'=>'It was seamless: the presenter didn’t hesitate or stumble ',),
      array('content'=>'The presenter was vulnerable and authentic',),
    );
    bz_make_cr_list($items);
  bz_close_box();
  //
  bz_open_box('answer','All of these behaviors are what make presenters effective. Here’s a bit more detail:','These are all good practices'); 
    ?>
    <table class="no-zebra">
      <tbody>
        <tr>
          <td><img src="/courses/1/files/12716/preview" alt="" style="width:150px; height:auto;" /></td>
          <td>
            <h6>1. FOCUS</h6>
            <p><?php  echo $z1 = 'Effective presenters know what the purpose and goals of their presentation are and stay focused on them. They edit the information down to only what&rsquo;s necessary, and keep the rest for questions and answers later.';?></p>
          </td>
        </tr>
        <tr>
          <td><img src="/courses/1/files/12717/preview" alt="" style="width:150px; height:auto;" /></td>
          <td>
            <h6>2. ORGANIZE</h6>
            <p><?php  echo $z2 = 'Without organization, you will most likely lose your audience and leave them confused about what the point was. Effective presenters deliver information and messages in a well-structured way that has a clear <strong>beginning</strong> (introduction), <strong>middle</strong> (developing the key concepts), and <strong>end</strong> (wrapping everything up neatly).';?></p>
          </td>
        </tr>
        <tr>
          <td><img src="/courses/1/files/12718/preview" alt="" style="width:150px; height:auto;" /></td>
          <td>
            <h6>3. THINK CRITICALLY</h6>
            <p><?php  echo $z3 = 'Effective presenters use their tools and techniques purposefully. They decide which stories, data, and visuals best support their case.';?></p>
          </td>
        </tr>
        <tr>
          <td><img src="/courses/1/files/12719/preview" alt="" style="width:150px; height:auto;" /></td>
          <td>
            <h6>4. EMPATHIZE</h6>
            <p><?php  echo $z4 = 'Effective presenters understand their audience and consider their audience they prepare and present. They meet the audience members where they are, earn their trust, and take cues from them to adapt the presentation in real time.';?></p>
          </td>
        </tr>
        <tr>
          <td><img src="/courses/1/files/12720/preview" alt="" style="width:150px; height:auto;" /></td>
          <td>
            <h6>5.&nbsp;EXUDE CONFIDENCE</h6>
            <p><?php  echo $z5 = 'Confidence goes a long way in presentations and if you&rsquo;re lucky, you naturally have lots of it. But if you&rsquo;re like most of us, you need to believe that you can do it; and with practice <em>you can</em>. The most confident presenters don&rsquo;t crumble over mistakes and are able to adapt as they go. They communicate confidence not only with their words but with their body language.';?></p>
          </td>
        </tr>
        <tr>
          <td><img src="/courses/1/files/12721/preview" alt="" style="width:150px; height:auto;"/></td>
          <td>
            <h6>6. TELL A STORY</h6>
            <p><?php  echo $z6 = 'This doesn&rsquo;t mean that you start every presentation with "once upon a time&hellip;", however, both written and oral presentations involve storytelling. Effective presentations have a seamless flow from beginning to end, which takes the audience on a journey from where they were to where you want them to be.&nbsp;';?></p>
          </td>
        </tr>
        <tr>
          <td><img src="/courses/1/files/12722/preview" alt="" style="width:150px; height:auto;" /></td>
          <td>
            <h6>7. PRACTICE</h6>
            <p><?php  echo $z7 = 'Your skill as a presenter is not fixed, no matter where it stands now. It is guaranteed to grow with practice, feedback, reflection, failure, and more practice. That&rsquo;s why it takes a bit of courage to step out of your comfort zone and commit to growing in this area, but it&rsquo;s the only way to improve.';?></p>
          </td>
        </tr>
        <tr>
          <td><img src="/courses/1/files/12723/preview" alt="" style="width:150px; height:auto;"  /></td>
          <td>
            <h6>8. USE THEIR AUTHENTIC VOICE</h6>
            <p><?php  echo $z8 = 'This one can be hard to do, but when you let go of perfection and let people hear your authentic voice, when you can <em>be you</em> in a presentation, you will have found yourself as a presenter and become significantly more effective.';?></p>
          </td>
        </tr>
      </tbody>
    </table>
    <?php
  bz_close_box(false);
  //
  bz_open_box('reflection','How effective of a presenter are you currently? Rate yourself on these behaviors:');
    $items = array(
      array('Your presentations stay focused',),
      array('Your presentations are well-organized',),
      array('You tell relatable stories in your presentations ',),
      array('You use compelling data in your presentations',),
      array('You empathize with the audience',),
      array('You exude confidence ',),
      array('You present with your authentic voice ',),
    );
    bz_make_instant_range_table($items);
  bz_close_box();
  ?>
  <h3>FOCUS</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter = 16; $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z1;?></p>
    </div>
    <?php
    bz_open_box('question', 'Jared is presenting about the project he’s been working on in a team meeting. He starts explaining all the moving parts of the project and the results he’s seen, but he starts to see blank stares on his teammates’ faces. They seem lost and confused. How can he regain everyone’s focus and keep them engaged?');

      bz_make_radio_list(array(
        'Communicate the purpose and goals of the presentation',
        'Ask everyone to take a break so they can come back refreshed ',
        'Read the accompanying slides he’s created ',
        'Explain the parts of the project in better detail ',
      ));

    bz_close_box();
    //
    bz_open_box('answer','Communicating what you aim to do at the beginning of the presentation is the key to maintaining focus and keeping your audience engaged. You will put the audience at ease and invest them in what you’re presenting.');
    bz_close_box();
    //
    bz_open_box('question','What might the purpose of Jared’s presentation be? (check all that apply)');
      $items = array(
        array('correctness'=>'correct', 'content'=>'Receive feedback from his team on the project’s progress so far',),
        array('correctness'=>'correct', 'content'=>'Learn from the results of the project to apply to other projects in the future ',),
        array('correctness'=>'correct', 'content'=>'Align on the next steps to take ',),
        array('correctness'=>'correct', 'content'=>'Invest his team in the project so they feel empowered to take the necessary action steps',),
        array('correctness'=>'incorrect', 'content'=>'Dig deep into his analysis of the data ',),
        array('correctness'=>'incorrect', 'content'=>'Give a good presentation',),
        array('correctness'=>'incorrect', 'content'=>'Show compelling graphs and charts ',),
        array('correctness'=>'incorrect', 'content'=>'Tell a good story ',),
      );
      bz_make_cr_list($items);
    bz_close_box();
    //
    bz_open_box('answer');
    ?>
      <p>You’ll notice that the purpose of his presentation is a shared purpose with his audience and goes beyond presenting for presenting’s sake. He’s communicating what they’ll learn together and what next steps they’ll take together.</p>
      <p>You don’t always need to explicitly state the purpose and goals in your presentation, but you need to know what they are so that your presentation stays focused.</p>
    <?php
    bz_close_box(false);
    ?>
  <h3>ORGANIZE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z2;?></p>
    </div>
    <?php 
    bz_open_box('question', 'How long is the average human’s attention span before they lose focus?');
      bz_make_range(8,0,60,$step = 1, $unit = ' seconds');
    bz_close_box();
    //
    bz_open_box('answer');
    ?>
      <p>Eight seconds, that&rsquo;s it (this is when browsing the Web, and only according to a single non-scientific study done by a Canadian ad agency).</p>
      <p>Statistics aside, we all know from personal experience that people tend to drift off, unless the speaker uses a <strong>"hook"</strong> grab their attention powerfully as soon as the presentation begins. Kind of like what we did here with this interactive Quick Question!</p>
    <?php
    bz_close_box(false);
    //
    bz_open_box('question', 'How long should the opening of your presentation be at the most?');
      bz_make_range(1,0,10,$step = 1, $unit = ' minute(s)');
    bz_close_box();
    //
    bz_open_box('answer','It&rsquo;s best not to go over 90 seconds, and one minute is optimal for providing a hook, introducing yourself, and introducing what you will be presenting.' );
    bz_close_box(false);
    //
    bz_open_box('question','Listen to Jeana’s opening to her presentation. Then answer the questions below. ','Let&rsquo;s try an example');?>

      <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/232516900%3Fsecret_token%3Ds-Jbf2M&amp;color=eb3b46&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_playcount=false&amp;sharing=false&amp;buying=false&amp;download=false" style=" width:100%; height:166px; border:none; overflow: hidden;"></iframe>
    
      <p>Jeana included all the necessary pieces of a presentation’s beginning. In what order did she include these elements?</p>
      <?php 
      bz_make_match_table(array(
        array('1','Provide a hook to make people pay attention',),
        array('2','Introduce yourself',),
        array('3','State the purpose and goals',),
      ));
    bz_close_box();
    //
    bz_open_box('answer','You don’t have to include these elements in this order, but they’re all important to include to engage the audience.');
      ?>
      <h6>INCLUDE A HOOK</h6>
      <?php
      bz_open_box('key',null,'Here are some possible hooks:?');
      ?>
      <ul>
        <li>A picture that speaks a thousand words</li>
        <li>A quote, poem, or rhyme</li>
        <li>A startling and/or personally relevant statistic ("One in five people in this audience is likely <i>X</i>")</li>
        <li>A question to the audience ("Show of hands &mdash; how many here are <i>X</i>?"</li>
        <li>A quick reference to a current news item (just be careful with politics)</li>
        <li>A story that relates directly to your message and/or humanizes you </li>
        <li>Asking the audience to take some action ("turn to someone next to you and <i>do X</i>")</li>
        <li>Humor (again be careful and test your material so you don't fall flat)</li>
        <li>A prediction ("By the time you leave here today, half of you will <i>X</i>")</li>
      </ul>
      <h6>INTRODUCE YOURSELF.</h6>
      <p>Make sure people know who you and your co-presenters are.</p> 
      <h6>STATE THE PURPOSE OF YOUR PRESENTATION.</h6>
      <p>Make sure people know why they should listen. What's the point? What are you hoping to accomplish?</p>
    <?php
    bz_close_box();
    //
    bz_open_box('question','What could Jeana have said to engage the audience even more?');
      bz_make_radio_list(array(
        '“If we implement this plan, you will be saving 20% or more on your utility bill by 2020.”',
        '“Let me give my co-presenters a chance to introduce themselves.”',
        '“El Niño is a band of warm ocean water that develops in the Pacific Ocean.” ',
        '“We need to change now. Who’s with me?”',
      ));

    ?>

  <h3>THINK CRITICALLY</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z3;?></p>
    </div>
  <h3>EMPATHIZE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z4;?></p>
    </div>
  <h3>EXUDE CONFIDENCE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z5;?></p>
    </div>
  <h3>TELL A STORY</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z6;?></p>
    </div>
  <h3>PRACTICE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z7;?></p>
    </div>
  <h3>USE YOUR AUTHENTIC VOICE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
    <p><?php echo $z8;?></p>
    </div>
</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>

