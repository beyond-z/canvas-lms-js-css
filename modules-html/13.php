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
            <h6>3. BE SELECTIVE</h6>
            <p><?php  echo $z3 = 'Effective presenters use their tools and techniques purposefully. They decide which stories, data, and visuals best support their case, and they leave everything else out.';?></p>
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
            <p><?php  echo $z5 = 'Confidence goes a long way in presentations and if you&rsquo;re lucky, you naturally have lots of it. But if you&rsquo;re like most of us, you need to believe that you can do it; and with practice <em>you can</em>! Focus on body language and voice, since those are the top two cues your audience picks up on as signs of confidence.';?></p>
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
            <h6>8. USE THEIR AUTHENTIC "VOICE"</h6>
            <p><?php  echo $z8 = 'This one can be hard to do, but when you let go of perfection and let people see and hear your authentic self, when you can <em>be you</em> in a presentation, you will have found yourself as a presenter and become significantly more effective.';?></p>
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
      array('You present with your authentic "voice" ',),
    );
    bz_make_instant_range_table($items);
  bz_close_box();
  ?>
  <h3>FOCUS</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter = 16; $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z1;?></p>
    </div><div style="clear:both;">&nbsp;</div>
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
    </div><div style="clear:both;">&nbsp;</div>
  <h4>BEGINNING</h4>
    <?php 
    bz_open_box('question', 'How long is the average human’s attention span before they lose focus?');
      bz_make_range(8,0,60,$step = 1, $unit = ' seconds');
    bz_close_box();
    //
    bz_open_box('answer');
    ?>
      <p>Eight seconds, that&rsquo;s it (at least when browsing the Web&hellip;).</p>
      <p>Statistics aside, we all know from personal experience that we can drift off, unless the speaker uses a <strong>"hook"</strong> grab our attention powerfully as soon as the presentation begins. Kind of like what we did here with this interactive Quick Question!</p>
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
    bz_open_box('answer','You don’t have to include these elements in this order, but they’re all important to include to engage the audience. Here is some more detail:');
      ?>
      <h6>INCLUDE A HOOK</h6>
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
      $items = array(
        array('correctness'=>'correct','content'=>'“If we implement this plan, you will be saving 20% or more on your utility bill by 2020.”','feedback'=>'Yes, this point makes clear why this presentation matters for this audience.',),
        array('correctness'=>'incorrect','content'=>'“Let me give my co-presenters a chance to introduce themselves.”','feedback'=>'',),
        array('correctness'=>'incorrect','content'=>'“El Niño is a band of warm ocean water that develops in the Pacific Ocean.” ','feedback'=>'',),
        array('correctness'=>'incorrect','content'=>'“We need to change now. Who’s with me?”','feedback'=>'',),
      );
      bz_make_cr_list($items, 'radio-list');
    bz_close_box();
    ?>
  <h4>Middle</h4>
    <?php
    bz_open_box('question','What are some of the most common pitfalls of the middle of presentations? (check all that apply)');
      $items = array(
        array(
          'correctness'=>'correct',
          'content'=>'Wandering off on a tangent',
          'feedback'=>'Stay focused on what you want your audience to remember and what you need to accomplish. ',
        ),
        array(
          'correctness'=>'correct',
          'content'=>'Awkward transitions between parts',
          'feedback'=>'For your presentation to flow smoothly, you will need transitions to connect all pieces. Some examples:<br />
            A transition from beginning to middle: "Over the next few minutes, I will present a plan that penalizes over-usage and incentivizes and rewards conservation. Let&rsquo;s start with the penalties."<br />
            A transition from one topic in the middle to the next: "Now that we&rsquo;ve discussed penalties for over-usage, let&rsquo;s talk about how we can incentivize and reward those who conserve."',
        ),
        array(
          'correctness'=>'correct',
          'content'=>'Trying to cram in every piece of information ',
          'feedback'=>'Assume you have less time than you think. Make smart decisions about what is most important to include.',
        ),
        array(
          'correctness'=>'incorrect',
          'content'=>'Staying too focused on one topic ',
          'feedback'=>'This is a good thing! ',
        ),
        array(
          'correctness'=>'incorrect',
          'content'=>'Creating an outline',
          'feedback'=>'This is helpful! ',
        ),
      );
      bz_make_cr_list($items);
    bz_close_box();
    //
    bz_open_box('answer','Speaking of outlines, they’re a really helpful way to keep the middle of your presentation focused and organized. Ask yourself, what are your main points/sections and what is the supporting evidence or information that would reinforce those points?');
    bz_close_box();
    ?>
  <h4>END</h4>
    <?php
    bz_open_box('question','Here are some ways that Jeana could have ended her presentation on water conservation. Match the ending with the strategy:');

      $items = array(
        array(
          '&ldquo;In summary [...] Please take a moment now to sign the petition that&rsquo;s being passed around the room.&rdquo;',
          'Call to action',
        ),
        array(
          '&ldquo;In summary [...] If we stay true to this plan, then we won&rsquo;t have to take more drastic measures in the future.&rdquo;',
          'Quick summary',
        ),
        array(
          '&ldquo;We all want to be here for a long time. We all want our children to be here for a long time. This is one way we can make this possible.&rdquo;',
          'Inspiring takeaway',
        ),
        array(
          '&ldquo;There are a few questions that we still need to answer. For example, how do we distinguish wasteful usage from unintentional usage due to things like pipe damage? [...]&rdquo; ',
          'Leave the audience with some questions that still need to be answered',
        ),
        array(
          '&ldquo;We also considered alternative solutions like commoditizing tap water and prohibiting certain uses of water but [...]&rdquo;',
          'Name other possibilities considered and build confidence in this proposal',
        ),
        array(
          '&ldquo;That concludes our presentation. [Repeat main take-away.] Thank you.&rdquo;' ,
          'Thank the audience' ,
        ),
        array(
          '&ldquo;Let’s open it up for questions from the audience.”',
          'Q&A (questions & answers)',
        ),
        array(
          '&ldquo;If you take away anything from this presentation, please remember three things [...]”',
          '1-3 key points',
        ),
      );
      bz_make_match_table($items, array('Ending', 'Strategy'));
    bz_close_box();
    ?>
  <blockquote>Use one or more of these closing strategies to leave the audience with a clear sense of purpose and your key messages.</blockquote>
  <h3>BE SELECTIVE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z3;?></p>
    </div><div style="clear:both;">&nbsp;</div>
    <?php
    bz_open_box('question', 'Chas created this high-level outline for his presentation:');
    ?>
      <div class="bz-example">
        <p><strong>Beginning</strong></p>
        <ul>
          <li>Hook: Octopus getting out of tank in aquarium on its own </li>
          <li>Introduction: Name, etc. </li>
          <li>Purpose: Audience members become octopus activists </li>
        </ul>
        <p><strong>Middle</strong></p>
        <ul>
          <li>Octopuses can evade predators well </li>
          <li>Octopuses are very intelligent and feel pain  </li>
          <li>Octopuses are being fished at an alarming rate </li>
          <li>What activist groups are doing about the problem </li>
        </ul>
        <p><strong>End</strong></p>
        <ul>
          <li>Summary of how to get involved</li>
          <li>Thank you</li>
        </ul>
        <p><strong>Q&A</strong></p>
      </div>
      <p>What could he take out?</p>
    <?php
    $items = array(
      array(
        'correctness'=>'correct',
        'content'=>'Octopuses can evade predators well ',
        'feedback'=>'While interesting, this point might not convince the audience members to become octopus activists. ',
      ),
      array(
        'correctness'=>'incorrect',
        'content'=>'Octopuses are very intelligent and feel pain',
        'feedback'=>'This point could make the audience feel an empathic connection to octopuses and want to become activists. ',
      ),
      array(
        'correctness'=>'incorrect',
        'content'=>'Summary of how to get involved',
        'feedback'=>'This point will help audience members identify clear action steps about how to get involved.',
      ),
      array(
        'correctness'=>'incorrect',
        'content'=>'Hook: Octopus getting out of tank in aquarium on its own ',
        'feedback'=>'This hook is an interesting fact that shows how intelligent octopuses are, which can capture the audience’s interest.  ',
      ),
    );
    bz_make_radio_list($items);
  bz_close_box();
  ?>
  <blockquote>Always ask yourself: is this bit of content the most effective one I can use to help me achieve the purpose of my presentation?</blockquote>
  <h3>EMPATHIZE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z4;?></p>
    </div><div style="clear:both;">&nbsp;</div>
  <?php
  bz_open_box('question', 'Which of these phrases would you want to hear in a presentation?');
    bz_make_radio_list(array(
      'Let’s explore the benefits of this strategy together ',
      'I’m an expert in this field',
      'Our team did the most research',
      'Our client list is extensive ',
    ));
  bz_close_box();
  //
  bz_open_box('answer');?>
    <p>When you talk at an audience or just talk about how great you are, you’re not empathizing with your audience, and you will lose them quickly. In order for your presentation to go well, you need to be aware of your audience. And the more you know about your audience, the easier it will be to connect and engage.</p> 
    <p>Some questions to ask yourself about your audience:</p>
    <ul>
      <li>Who will be in your audience and how will you connect to them? How might they relate to what you have to say?</li>
      <li>What might get in the way of them engaging openly with your presentation? What might shut them off? </li>
      <li>What are they interested in? </li>
      <li>What are they afraid of? </li>
      <li>During the presentation, how is my audience doing?</li>
    </ul>
  <?php
  bz_close_box(false);
  //
  bz_open_box('question','Match each cue from the audience with what it might mean about how they’re feeling and what can be done moving forward in the presentation. ');
    $items = array(
      array(
        'Looking at their phones',
        'They’re bored. Re-engage them with an interesting hook, audience participation, or reframe the purpose for being here today.  ',
      ),
      array(
        'Laughter and clapping',
        'They’re amused and interested. Keep doing what you’re doing! ',
      ),
      array(
        'Raised hands ',
        'They’re curious or confused. Take a mental note and decide when it’s the right time to answer their questions. ',
      ),
      array(
        'Slouched with arms crossed',
        'They’re thinking, so what? This is a waste of my time. They may be frustrated. Re-engage them with an interesting hook or reframe the purpose for being here today.  ',
      ),
      array(
        'Eyes wide, mouth open ',
        'They’re surprised or shocked. This means they’re interested. Keep doing what you’re doing! ',
      ),
      array(
        'Nodding',
        'They understand you. You’re connecting with the audience and they’re encouraging you to go on. ',
      ),
    );
    bz_make_match_table($items);
  bz_close_box();
  ?>
  <blockquote>&ldquo;The stars may be on stage,<br />but the audience is king.&rdquo;<p class="quote-source">Show business saying</p></blockquote>
  <h3>EXUDE CONFIDENCE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z5;?></p>
    </div><div style="clear:both;">&nbsp;</div>
  <?php
  bz_open_box('question', 'What are some effective ways to communicate confidence through your body language? (check all that apply)');
    $rights = array(
      'Stand up straight',
      'Face the audience ',
      'Make eye contact with different audience members ',
      'Use natural hand gestures ',
    );
    $wrongs = array(
      'Face the presentation screen',
      'Keep your hands in your pockets ',
      'Make eye contact with one audience member ',
      'Use big hand gestures ',
      'Slouch ',
    );
    bz_make_simple_checklist($rights, $wrongs);
  bz_close_box();
  //
  bz_open_box('question', 'Similar to body language, you must let your tone of voice communicate confidence. What does this sound like? (check all that apply, click DONE to see how you did)');
    $items = array(
      array(
        'correctness'=>'correct',
        'content'=>'Speak loudly and clearly ',
        'feedback'=>'Make sure the people at the back of the room can hear you (but don’t shout!) ',
      ),
      array(
        'correctness'=>'correct',
        'content'=>'Speak as you do naturally',
        'feedback'=>'Sounding natural (rather than overly formal and <span class="bz-has-tooltip" title="Without variation, like a robot.">monotone</span>) and will make it easier to follow you along, as long as you keep the other advice here in mind!',
      ),
      array(
        'correctness'=>'correct',
        'content'=>'Say “We should do this” rather than “I think maybe we should do this”',
        'feedback'=>'Being more direct sounds more confident ',
      ),
      array(
        'correctness'=>'incorrect',
        'content'=>'Speak quickly',
        'feedback'=>'Don’t speak slowly either, but speak at a pace your audience seems to easily follow',
      ),
      array(
        'correctness'=>'incorrect',
        'content'=>'Speak with fillers (e.g. “um, like”)',
        'feedback'=>'Practice, practice, practice (including videoing yourself) to try to avoid this distracting “verbal graffiti.” ',
      ),
      array(
        'correctness'=>'incorrect',
        'content'=>'End sentences like you’re asking a question ',
        'feedback'=>'This makes it sound like you’re unsure of what you’re talking about? And it can also be, like, distracting?',
      ),
    );
    bz_make_cr_list($items,'checklist',false);
  bz_close_box();
  //
  bz_open_box('answer','You might feel self-conscious for a while as you practice some of these strategies, but with some practice they will become second-nature by the time you make your Capstone presentation (we know it&rsquo;s possible because we&rsquo;ve seen many past Fellows achieve this).');
  bz_close_box();
  ?>
  <h3>TELL A STORY</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z6;?></p>
    </div><div style="clear:both;">&nbsp;</div>
  <?php
  bz_open_box('question','Which way of presenting this information is more engaging?');
  ?>
    <table class="instant-feedback equal-column-widths">
      <tbody>
        <tr>
          <td>
            <div class="bz-example">
              <p>Lucy always wanted to become a pilot, but she failed the math section of the exam. When her son graduated high school, she decided to take it again, and again she didn't pass. But she was determined to become a pilot, and she asked her son to teach her math, so every night after dinner, he taught her everything he knew. The next time she took the exam, she passed. Finally, she got a pilot license and got a job in crop dusting. On the job, she found herself needing to use her math to calculate the airplane's fuel consumption and to plan the most efficient course to cover the all the fields she was sparying in the shortest time. She could do the math so quickly, other pilots came to her for help and she became known for her excellent math skills. What Lucy thought was her weakness turned out to be a great strength!</p>
            </div>
          </td>
          <td><p>With practice and persistence, you can turn your weakness into a strength!</p></td>
        </tr>
        <tr>
          <?php $GLOBALS['innercounter']++; ?>
          <td class="correct"><input name="<?php echo bz_make_id();?>" type="radio" value="0" data-bz-retained="<?php echo bz_make_id('hold');?>" />
            This one</td>
          <td class="incorrect"><input name="<?php echo bz_make_id('hold');?>" type="radio" value="" data-bz-retained="<?php echo bz_make_id('hold');?>" />
            This one</td>
        </tr>
      </tbody>
    </table>
  <?php
  bz_close_box();
  //
  bz_open_box('answer',null,'People think in stories');
  ?>
    <p>When people hear a story, the deeper parts of the brain where memory and emotion work together are activated, and meaningful connections are made to other memories your audience already has. Your audience will feel more engaged as you speak, and remember more once you're done.</p>
  <?php 
  bz_close_box();
  ?>
  <h3>PRACTICE</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
      <p><?php echo $z7;?></p>
    </div><div style="clear:both;">&nbsp;</div>
  <?php
  bz_open_box('read');
  ?>
    <div class="bz-example">
      <p>Stephen Curry is arguably the purest, greatest shooter to ever play basketball. His mission is to constantly find ways to make himself better. Among other things, he fires up to 1,000 shots before practice.</p>
      <img style="width:95%; margin: 1em auto;" src="/courses/1/files/12724/preview" alt="Image of Stephen Curry playing basketball" />
      <p>Here’s what he has to say:</p>
      <blockquote>“You have to rely on the fact that you put the work in to create the muscle memory and then trust that it will kick in. The reason you practice and work on it so much is so that during the game your instincts take over to a point where it feels weird if you don't do it the right way.”</blockquote>
    </div>
    <p>How can you apply Stephen Curry’s advice to presenting?</p>
    <?php
      $items = array(
        'Practice a ton before your presentation so that it feels like second nature under pressure ',
        'Run through your presentation at least one thousand times ',
        'Work out your muscles beforehand so that you’re ready ',
        'Show up early on your presentation day and begin practicing ',
      );
      bz_make_radio_list($items);
    bz_close_box();
    //
    bz_open_box('reflection','Thinking about your Capstone Presentation, what are ways you could practice so that it feels like a no-brainer? (check all that apply)','What would you do?');
      $items = array(
        'Rehearse with your cohort outside of Learning Lab ',
        'Record video of yourself practicing and reflect on it ',
        'Rehearse in front of your LC ',
        'Rehearse in front of friends or family ',
        'Rehearse in front of your stuffed animals ',
        'Practice saying your part really fast, then really slow, then just right ',
        'Record audio of your cohort’s presentation and then listen to it over and over while commuting ',
      );
      bz_make_simple_checklist($items);
    bz_close_box();
    ?>
  <blockquote>Practice makes perfect!</blockquote>
  <h3>USE YOUR AUTHENTIC "VOICE"</h3>
    <div class="full">
      <img src="/courses/1/files/127<?php echo $imgcounter++; ?>/preview" alt="" style="width: 25%; height: auto; float: right; margin: 0 0 2em 2em;" />
    <p><?php echo $z8;?></p>
    </div><div style="clear:both;">&nbsp;</div>
    <?php
    bz_open_box('reflection');
    ?>
    
    <p>Presenting as your authentic self can be difficult, especially when presenting doesn’t come naturally to you (you’re not alone &mdash; that describes the vast majority of people!).</p>
    <p>What gets in the way of using your authentic "voice" when presenting? (check all that apply)</p>
    
    <?php
    bz_make_cr_list(array(
      array(
        'content'=>'Feeling like you have to stay on script',
        'feedback'=>'You will find it easier to let go of the script if you prepare and practice enough. You can also jot down keywords that will help you remember what you need to cover. Remember: your audience doesn&rsquo;t know the script so they won&rsquo;t mind if you go off-script!',
      ),
      array(
        'content'=>'Feeling like you are giving a performance',
        'feedback'=>'Try to think of it as a conversation rather than a one-way talk. You have just been given a few minutes to make your argument, but then the conversation continues as soon as you&rsquo;re done.',
      ),
      array(
        'content'=>'Feeling like you need to fit other people&rsquo;s idea of what a presenter looks and sounds like',
        'feedback'=>'You&rsquo;ll give your best performance in a role that suits you best, and that role is simply <em class="replace-with-user-name">you</em>. If you&rsquo;ve ever watched The Voice, you&rsquo;ve seen coaches like Rihanna encourage contestants like Korin Bukowski to "lean into her weird side" and be herself instead of holding back, which led to her best performance yet on the show. Sure, you can&rsquo;t be too weird in a professional setting, but lean into who you are and see yourself as your greatest strength rather than a weakness.',
      ),
    ));
  bz_close_box();
  //
  bz_open_box('question','You just finished a rockstar presentation. You feel a big sense of relief wash over you. But it’s time for questions from the audience (Q&A). Someone asks you a question, and you realize you have no idea how to answer it. What could you do? (check all that apply)');
    $rights = array(
      'Say "That&rsquo;s a great question, I haven&rsquo;nt really looked into that yet."',
      'Briefly explain why this wasn’t an aspect you focused your research on',
      'Stay calm',
      'Try to honestly answer as best you can, and then immediately ask "Does that answer your question?"',
      'Say you prioritized different topics, but that finding the answer to this question would be a great next step',
      'Pause and allow yourself a moment to think',
    );
    $wrongs = array(
      'Freeze like a deer in the headlights',
      'Fake an answer on the fly',
      'Answer a different question ',
      'Gulp and walk out',
    );
    bz_make_simple_checklist($rights,$wrongs);
  bz_close_box();
  //
  bz_open_box('key', 'Practicing Q&A sessions beforehand and knowing your material will help ensure that the real thing is a breeze. Here are a few other tips:','One more thing about Q&A Sessions');
  ?>
    <ul>
      <li>If you're not sure you heard the question or understood it, offer to rephrase it. For example: "Let me make sure I understand the question. You're asking if...." If you still don't understand, ask for an example: "I'd love an example of what you mean to better understand your question..."</li>
      <li>If you are asked more than one question at a time, answer each one at a time. For example: "I heard three questions there. Let me start with the first question...."</li>
      <li>Ask the person if you've answered his/her question. "Have I answered your question?"</li>
      <li>Interact using names. For example, "Thank you for your question, Ms. Lucas..."</li>
      <li>If presenting as a team, determine who will answer what kinds of questions, to avoid stepping over each other in real time, and to ensure not just one person answers all the questions. However, try to keep it to one response per question (or two at the most), as it becomes frustrating for the audience when everyone on your team chimes in.</li>
      <li>Respect your audience by keeping it short and simple. If someone seems to be "attacking" you, disagree respectfully: "That's an interesting point. I've thought about that too but reached a different conclusion..." or "Thank you for that thought. I have a different view of this..."</li>
    </ul>
  <?php
  bz_close_box();
  ?>
  <h3>CREATE A COMPELLING PRESENTATION DECK</h3>
  <?php
  bz_open_box('watch');
    bz_embed_video('yt','Iwpi1Lm6dFo','20 minutes &mdash; likely twenty of the most rewarding minutes you&rsquo;ll ever spend on an online video', 'Author of Death by Powerpoint David J. Phillips models a great presentation as he delivers his top tips for top-notch effective slide decks',null,'Auto-generated captions available');
  bz_close_box();
  //
  bz_open_box('question','How many concepts or messages at most should you deliver per slide?','Let&rsquo;s recap');
    $items = array(
      array(
        'content'=>'One',
        'correctness'=>'correct',
        'feedback'=>'This helps people focus and retain what you say.'
      ),
      array(
        'content'=>'Three',
        'correctness'=>'incorrect',
        'feedback'=>'Three is a magic number but having more than one idea per slide dilutes the attention and foucs of your audience, making the presentation less effective.',
      ),
      array(
        'content'=>'Six',
        'correctness'=>'incorrect',
        'feedback'=>'You might be confusing concepts/messages with visual elements such as headings, images, etc.',
      ),
      array(
        'content'=>'As many as possible',
        'correctness'=>'incorrect',
        'feedback'=>'Are you okay with confusing and distracting your audience just for the sake of keeping the slide count down?',
      ),
    );
    bz_make_radio_list($items, false);
  bz_close_box();
  //
  bz_open_box('answer');
  bz_close_box(false);
  //
  bz_open_box('question','Why is it better to use light text over a dark background?','Let&rsquo;s try another one')
  ?>
    <?php 
    $items = array(
      array(
        'content'=>'Because it grabs less attention.',
        'feedback'=>'Yes! Your slides are just there to help illustrate what you say, but the rest of the time you want people to be looking at you, and that is hard to do when there is a big bright screen behind you, grabbing their attention!',
        'correctness'=>'correct',
      ),
      array(
        'content'=>'Because high contrast helps people focus on the presentation',
        'feedback'=>'That is the opposite of what you want to do. The slides are there to support the speaker, not to take over!',
        'correctness'=>'incorrect',
      ),
    );
    bz_make_radio_list($items, false);
    ?>
  <?php
  bz_close_box();
  //
  bz_open_box('answer', 'Did you get it right? How about this one: how many objects (e.g. headings, bullet points, images) <strong>at most</strong> should there be on a slide to make it effective?','One more');
    bz_make_radio_list(array(
      'Six',
      'One',
      'Three',
      'Nine',
      'As many as possible',
    ));
  bz_close_box();
  //
  bz_open_box('answer', 'Six is the most your audience can <em>see</em> without having to process things by counting. Not having to process the slide helps them relax and concentrate on what you are saying.');
  bz_close_box();
  //
  bz_open_box('question', 'Your manager asked you to prepare a slide deck for her. Which of these design strategies do you apply to the deck?');
    $items = array(
      array(
        'content'=>'It depends',
        'correctness'=>'correct',
        'feedback'=>'If your manager is giving an oral presentation then these strategies could make her shine. But if the deck is meant for sending out as a stand-alone product many of these strategies are actaully counter-productive (for example: using pithy bullets instead of full sentences on the slides won&rsquo;t make sense to the reader).',
      ),
      array(
        'content'=>'All of them!',
        'correctness'=>'incorrect',
        'feedback'=>'Nope. You don&rsquo;t know whether this is for her to present orally or to send out as a stand-alone (self-guided) deck. The strategies above only apply to oral presentations.',
      ),
      array(
        'content'=>'All of them, but only if she says she needs a printed copy',
        'correctness'=>'incorrect',
        'feedback'=>'Nope. Printing lots of single-message slides using a white-on-black design will be terribly wasteful!',
      ),
    );
    bz_make_radio_list($items, false);
  bz_close_box();
  //
  bz_open_box('answer','You will meet many people in your career who still try in vain to create a single slide deck for both oral presentations and stand-alone written decks they send to people. Don&rsquo;t be one of them!');
  bz_close_box();
  ?>
  <blockquote>When you present in-person you want the audience to focus on you, the presenter, <em>not</em> on the slide deck which is only there to illustrate key concepts and help the audience follow you along.</blockquote>
  <h2 id="wrap-up">Wrap-up</h2>
  <div>
    <p>In this module we looked at two important career skills: giving effective oral presentations and preparing great slide decks to support those.</p>
    <p>We shared dozens of success secrets on how to apply these best practices:</p>
      <ul>
        <li>Focus</li>
        <li>Organize</li>
        <li>Be selective</li>
        <li>Empathize</li>
        <li>Exude confidence</li>
        <li>Tell a story</li>
        <li>Practice</li>
        <li>Use your authentic "voice"</li>
        <li>Create a compelling presentation deck</li>
      </ul>
    <p>While all the advice above is valuable, if there's one thing that will be determine your overall success in presenting it's simply how much practice and feedback you get.</p>
    <p>The upcoming Capstone presentation should give plenty of opportunity to rehearse and up your game, but you should consider treating every presentation you make as a chance to improve on one or more of these fronts.</p>
    <h3>Next Steps:</h3>
    <ol>
      <li>To be prepared for Learning Lab this week, make sure your cohort has completed your prototypes, tested your prototypes with at least <strong>ten</strong> users, and refined your prototypes based on their feedback.</li>
      <li>You will be rehearsing your Capstone Presentation during Learning Lab, so make sure your team has a draft of the presentation (deck and talking points) ready to rehearse.</li>
      <li>On your own, continue working on the <a href="/courses/1/assignments/711">Tackle Career Challenges</a> project. You can complete Part 1: Prototype &amp; Test and continue to work on Parts 2 and 3.</li>
      <li>Check out the agenda for your upcoming Learning Lab (below).</li>
    </ol>
  </div>
  <h2>SO, YOU’RE FACILITATING <br />LEARNING LAB THIS WEEK&hellip;</h2>
  <?php $GLOBALS['hlevel'] = 3; ?>
  <?php bz_open_box('action');?>
  <p>If you’re the <em>Project Manager</em>, <em>Lead Oral Presenter</em>, or <em>Lead Deck Designer</em>, you’re facilitating sections of Learning Lab this week. Your objectives and suggested methods for reaching those objectives are listed below. Come prepared with an agenda to facilitate Learning Lab.</p>
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
      <td>Project Manager</td>
    </tr>
    <tr>
      <td>10 mins</td>
      <td>Review Presentation Rubrics</td>
      <td>LC</td>
    </tr>
    <tr>
      <td>60 mins</td>
      <td>Rehearse Capstone Challenge Presentation</td>
      <td>Lead Prototyper</td>
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
        <th>Rehearse Capstone Challenge Presentation</th>
        <td>
          <ol>
            <li>Run through the entire presentation at least two times.</li>
            <li>Receive feedback on both the oral presentation and presentation deck.</li>
            <li>Make changes or determine which improvements need to be made to the oral presentation and presentation deck.</li>
            <li>Practice answering questions you might receive from the judges.</li>
          </ol>
        </td>
        <td>
          <ol>
            <li>Rehearse </li>
            <li>The LC acts as a judge and provides feedback </li>
          </ol>
        </td>
      </tr>
    </tbody>
  </table>
  <?php 
  bz_close_box(false); ?>
</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>

