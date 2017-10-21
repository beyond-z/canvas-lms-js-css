<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Module 15 Live your Legacy</title>
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
$ns = 'lyl';
require('functions.php');
?>
<div class="bz-module">
  <blockquote class="special">Braven has challenged me to push myself to be all I can be, it has empowered me to be confident. I will live my legacy by continuing to push my boundaries. <br /><span class="bz-hashtag">#EmbraceYourself</span> <span class="bz-hashtag">#LiveYourLegacy</span> <span class="quote-source">Liliana Amaro-Ortiz</span></blockquote>

  <?php 
  bz_open_box(null, null, 'Live Your Legacy is one of Braven’s five core values');
  ?>
  <p>Living your legacy means your everyday actions align with your purpose. It means you are the author of your own story. You give meaning to how you got it here, and where you’re headed next.</p>
  <p>Being able to articulate this story not only helps motivate and focus your actions, but helps others understand you too.</p>
  <?php 
  bz_close_box(false);
  ?>
  <blockquote class="special"><p>I will live my legacy by moving forward with my goals and advance my life in a future career in which I will succeed.</p><p>I will pay it forward by helping other individuals and encourage them to follow their dreams, be successful as individuals in life, and follow their instincts. </p><span class="bz-hashtag">#BravenSwoleFellows</span> <span class="bz-hashtag">#AlwaysRunning</span> <span class="bz-hashtag">#LiveYourLegacy</span> <span class="quote-source">Joe Macias</span></blockquote>

  <?php 
  bz_open_box(null, null, 'Reflection is how we author our stories.');
  ?>
  <p>Reflecting on our experiences how we decide what lessons we’ll internalize, and meld into our story.</p>
  <p>During this last week of the Braven Accelerator, we ask that you reflect by looking back at your Braven exeprience and looking ahead at how you will live your legacy. You will write down this Legacy Reflection so that you can share it with your cohort during the final Learning Lab. It’s also the last part of your Tackle Career Challenges Project.</p>
  <h3 class="box-title">Ready? Let's do this thing!</h3>  
  <?php 
  bz_close_box(false);
  ?>

  <h2>Legacy Reflection</h2>

  <blockquote class="special">Braven has taught me to get involved with those around me and to take on new experiences presented to me <br /><span class="bz-hashtag">#emBARK</span> <span class="bz-hashtag">#liveyourlegacy</span> <span class="quote-source">Christina Pizano</span></blockquote>

  <h3>Look Back</h3>

  <?php 
  bz_open_box('key','Lay out everything from the Braven Accelerator. This could include the following (check off when you’ve gathered each):','What you’ll need');

    $items = array(
      array('content' => 'Notes',),
      array('content' => 'Feedback from your Leadership Coach',),
      array('content' => 'Your Song of Significance ',),
      array('content' => 'Your Story of Self',),
      array('content' => 'Each of your projects ',),
      array('content' => 'Photos ',),
      array('content' => 'Facebook posts ',),
    );
    bz_make_cr_list($items);
    bz_make_textarea(array('other'=>true));
  bz_close_box();
  //
  bz_open_box('reflection');
  ?>
    <table class="no-zebra bz-survey">
      <tbody>
        <tr>
          <td>
            <h5>Working in Teams</h5>
          </td>
          <td>
            <p>1&nbsp;=&nbsp;little&nbsp;to&nbsp;no experience</p>
          </td>
          <td>&nbsp;</td>
          <td>5&nbsp;=&nbsp;full&nbsp;mastery</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>I work effectively in teams and add value to toward team goals.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-01"></td>
          <td class="current-value">1</td>
        </tr>
        <tr>
          <td>I navigate cultural difference on teams.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-02"></td>
          <td class="current-value">1</td>
        </tr>
        <tr>
          <td>I cultivate belonging and safety for myself and others.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-03"></td>
          <td class="current-value">1</td>
        </tr>
        <tr>
          <td>
            <h5>Strategic Problem-Solving</h5>
          </td>
          <td>
            <p>1&nbsp;=&nbsp;little&nbsp;to&nbsp;no experience</p>
          </td>
          <td>&nbsp;</td>
          <td>5&nbsp;=&nbsp;full&nbsp;mastery</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>I identify the underlying complexity and ambiguity of problems.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-04"></td>
          <td class="current-value">1</td>
        </tr>
        <tr>
          <td>I implement effective solutions.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-05"></td>
          <td class="current-value">1</td>
        </tr>
        <tr>
          <td>
            <h5><span style="font-weight: 400;">Operating and Managing</span></h5>
          </td>
          <td>
            <p>1&nbsp;=&nbsp;little&nbsp;to&nbsp;no experience</p>
          </td>
          <td>&nbsp;</td>
          <td>5&nbsp;=&nbsp;full&nbsp;mastery</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>I manage my time and personal to-dos well.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-06"></td>
          <td class="current-value">2</td>
        </tr>
        <tr>
          <td>I manage projects to on-time and successful completion.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-07"></td>
          <td class="current-value">3</td>
        </tr>
        <tr>
          <td>I give and receive feedback effectively.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-08"></td>
          <td class="current-value">4</td>
        </tr>
        <tr>
          <td>
            <h5>Networking and Communicating</h5>
          </td>
          <td>
            <p>1&nbsp;=&nbsp;little&nbsp;to&nbsp;no experience</p>
          </td>
          <td>&nbsp;</td>
          <td>5&nbsp;=&nbsp;full&nbsp;mastery</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>I clearly present myself and ideas.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-09"></td>
          <td class="current-value">5</td>
        </tr>
        <tr>
          <td>I demonstrate professional polish and understanding of workplace dos and don’ts.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-10"></td>
          <td class="current-value">4</td>
        </tr>
        <tr>
          <td>I actively build and strengthen my professional network.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-11"></td>
          <td class="current-value">3</td>
        </tr>
        <tr>
          <td>
            <h5>Self-Driven Leading</h5>
          </td>
          <td>
            <p>1&nbsp;=&nbsp;little&nbsp;to&nbsp;no experience</p>
          </td>
          <td>&nbsp;</td>
          <td>5&nbsp;=&nbsp;full&nbsp;mastery</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>I am grounded in my purpose, clear on my path, and leverage my assets and values.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-12"></td>
          <td class="current-value">2</td>
        </tr>
        <tr>
          <td>I learn from both wins and failure.</td>
          <td colspan="3"><input class="bz-optional-magic-field bz-retained-field-setup" max="5" value="0" min="1" step="1" type="range" data-bz-retained="test-self-ass-post-13"></td>
          <td class="current-value">1</td>
        </tr>
      </tbody>
    </table>
  <?php
  bz_close_box();
  //
  bz_open_box('action','Let&rsquo;s see how your current self-assessment compares to the one you took in week 1 of the Accelerator:','See your growth');
  
    echo '<table class="no-zebra">';
    echo '<tbody>';

    $items = array(
      array(
        'title' => 'Working in Teams',
        'criteria' => array(
          '01' => 'I work effectively in teams and add value to toward team goals.',
          '02' => 'I navigate cultural difference on teams.',
          '03' => 'I cultivate belonging and safety for myself and others.',
        ),
      ),
      array(
        'title' => 'Strategic Problem-Solving',
        'criteria' => array(
          '04' => 'I identify the underlying complexity and ambiguity of problems. ',
          '05' => 'I implement effective solutions.',
        ),
      ),
      array(
        'title' => 'Operating and Managing',
        'criteria' => array(
          '06' => 'I manage my time and personal to-dos well.',
          '07' => 'I manage projects to on-time and successful completion.',
          '08' => 'I give and receive feedback effectively.',
        ),
      ),
      array(
        'title' => 'Networking and Communicating',
        'criteria' => array(
          '09' => 'I clearly present myself and ideas.',
          '10' => 'I demonstrate professional polish and understanding of workplace dos and don’ts.',
          '11' => 'I actively build and strengthen my professional network.',
        ),
      ),
      array(
        'title' => 'Self-Driven Leading',
        'criteria' => array(
          '12' => 'I am grounded in my purpose, clear on my path, and leverage my assets and values.',
          '13' => 'I learn from both wins and failure.',
        ),
      ),
    );

    foreach ($items as $category) {
      echo '<tr>';
        echo '<th>'.$category['title'].'</th>';
        echo '<th>Week&nbsp;1</th>';
        echo '<th>Today</th>';
        echo '<th>Change</th>';
      echo '<tr>';
      foreach ($category['criteria'] as $key => $value) {
        echo '<tr>';
          echo '<td>'.$value.'</td>';
          echo '<td><span data-bz-retained="test-self-ass-'.$key.'">&nbsp;</span></td>';
          echo '<td><span data-bz-retained="test-self-ass-post-'.$key.'">&nbsp;</span></td>';
          echo '<td>&nbsp;</td>';
        echo '</tr>';
      }
    }

    echo '</tbody>';
    echo '</table>';
    
  //

  bz_close_box();
  ?>

  <blockquote class="special">I will live my legacy by continuing to follow my dreams of creating a product that revolutionizes a part of people’s lives! <br /><span class="bz-hashtag">#liveyourLegacy</span> <span class="bz-hashtag">#pumped</span> <span class="quote-source">Nicholas Papano</span></blockquote>

  <h3>Look Ahead</h3>
  <?php bz_open_box('reflection', 'What kind of impact do you want to have on others, and who will you impact?','Reflect');
  ?>
    <ul>
      <li>What remains to be accomplished?</li>
      <li>What will you do with your 'one wild and precious life'?</li>
      <li>What is the very next action you will commit to?</li>
    </ul>
    <p>Take notes on your answers to these questions here:</p>
    <?php
    bz_make_textarea();
    ?>
  <?php
  bz_close_box();
  ?>
  
  <blockquote class="special">Push yourself to become who you aspire to be. It doesn’t have to happen a year down the line when it can happen today. That’s what Braven and my cohort has taught me. <br /><span class="bz-hashtag">#FBBravenLeaders</span> <span class="bz-hashtag">#LiveYourLegacy</span> <span class="quote-source">Andre Chik</span></blockquote>

  <h3>Put it all together</h3>
  <p>You’re now ready to write your Legacy Reflection. You can find all the expectations and instructions in Part 4 of the <a href="/courses/1/assignments/711" target="_blank">Tackle Career Challenges Project</a>. 
  <p>While we won&rsquo;t be sharing past Fellows’ reflections with you &mdash; we want this reflection to be unique to you &mdash; we thought we could share some examples from the inspiration for this exercise: NPR’s “This I believe” series.</p>
  <p>Similar to these stories, for this assignment you will think about your core beliefs as part of who you are, what is important to you, how they guide the impact you want to have, and what you will do.</p>
  <?php 
  bz_open_box('video',null,'Listen to this'); 
  ?>
    <p>Life is an Act of Literary Creation by Luis ALberto Urrea (5:01) 
      <div class="transcript">
      <p>I believe God is a poet; every religion in our history was made of poems and songs, and not a few of them had books attached. I came to believe the green fuse that drives spring and summer through the world is essentially a literary energy. That the world was more than a place. Life was more than an event. It was all one thing, and that thing was: story.</p>
      <p>I was in a small house in Cuernavaca with old healer women. We were eating green Jell-O. One of them told me this: "When you write, you light a bonfire in the spirit world. It is dark there. Lost souls wander alone. Your inner flame flares up. And the lost souls gather near your light and heat. And they see the next artist at work and go there. And they follow the fires until they find their ways home."</p>
      <p>Aside from thinking my old Baptist preacher would not be amused by this kind of pagan talk, I recognized the beauty and awe, the deep respect in a woman who didn't read, for the act of literary creation.</p>
      <p>Now, if it is all story, I believe we are the narrators. Many writing instructors will tell you that to be a great writer, you must be attentive. Shamans will tell you the same thing: If you want to be a good person, a whole person, wake up! Pay attention! Be here now! Zen monks will go so far as to hit you with a stick. Look!</p>
      <p>I used to approach writing like a football game. If I went out there and aggressively saw more, I'd know more and I'd capture more, and I'd write better. Hut, hut, hut: First down and haiku! But I found out something entirely different. I learned that if I went into the world and paid attention (in Spanish, you "lend attention," presta atencion), the world would notice and respond. I would have demonstrated my worthiness to receive the world's gifts. It's a kind of library where you lend attention and receive a story. Or God will toss off a limerick for your pleasure.</p>
      <p>In South Carolina recently, I was telling my hosts before a speaking engagement all about this idea. I told them that Story comes on the wings of hummingbirds and dragonflies. My host told me to turn around. A hummingbird hovered outside the window, three inches from the back of my head. After the event, I was in the street enjoying the silence. A dragonfly came and hovered over my head. Both times, all I had to do was look.</p>
    </div></p>
    <iframe src="https://www.npr.org/player/embed/103362391/103397414" width="100%" height="240" frameborder="0" scrolling="no" title="NPR embedded audio player"></iframe>
    <p>Accomplishing Big Things in Small Pieces by William Wisseman (4:46)
      <div class="transcript">
      <p>I carry a Rubik's Cube in my backpack. Solving it quickly is a terrific conversation starter and surprisingly impressive to girls. I've been asked to solve the cube on the New York City subway, at a track meet in Westchester and at a café in Paris.</p>
      <p>I usually ask people to try it first. They turn the cube over in their hands, half-heartedly they make a few moves and then sheepishly hand it back. They don't even know where to begin. That's exactly what it was like for me to learn how to read. Letters and words were scrambled and out of sequence. Nothing made sense because I'm dyslexic.</p>
      <p>Solving the Rubik's Cube has made me believe that sometimes you have to take a few steps back to move forward. This was a mirror of my own life when I had to leave public school after the fourth grade. It's embarrassing to admit, but I still couldn't consistently spell my full name correctly.</p>
      <p>As a fifth-grader at a new school that specialized in what's called language-processing disorder, I had to start over. Memorizing symbols for letters, I learned the pieces of the puzzle of language, the phonemes that make up words. I spent the next four years learning how to learn and finding strategies that allowed me to return to my district's high school with the ability to communicate my ideas and express my intelligence.</p>
      <p>It took me four weeks to teach myself to solve the cube — the same amount of time it took the inventor, Erno Rubik. Now, I can easily solve the 3x3x3, and the the 4x4x4, and the Professor's Cube, the 5x5x5. I discovered that just before it's solved, a problem can look like a mess, and then suddenly you can find the solution. I believe that progress comes in unexpected leaps.</p>
      <p>Early in my Rubik's career, I became so frustrated that I took the cube apart and rebuilt it. I believe that sometimes you have to look deeper and in unexpected places to find answers. I noticed that I can talk or focus on other things and still solve the cube. There must be an independent part of my brain at work, able to process information.</p>
      <p>The Rubik's Cube taught me that to accomplish something big, it helps to break it down into small pieces. I learned that it's important to spend a lot of time thinking, to try to find connections and patterns. I believe that there are surprises around the corner. And, that the Rubik's Cube and I, we are more than the sum of our parts.</p>
      <p>Like a difficult text or sometimes like life itself, the Rubik's Cube can be a frustrating puzzle. So I carry one in my backpack as a reminder that I can attain my goals, no matter what obstacles I face.</p>
      <p>And did I mention that being able to solve the cube is surprisingly impressive to girls?</p>
    </div></p>
    <iframe src="https://www.npr.org/player/embed/94566019/94603503" width="100%" height="240" frameborder="0" scrolling="no" title="NPR embedded audio player"></iframe>
    <p>Black is Beautiful by Sufiya Abdur-Rahman (4:36)
      <div class="transcript">
      <p>I'd been searching for a job for months with no success. I was just about ready to settle into permanent unemployment and a deep depression when my siblings suggested I try something I'd never before considered.</p>
      <p>"Why don't you put a different name on your resume," they proposed. Something less ethnic-sounding and easier to pronounce, something that doesn't set off alarm bells like my name apparently does.</p>
      <p>Out of the question, I said. "If they don't want Sufiya Abdur-Rahman, then they don't want me."</p>
      <p>I'm the daughter of two 1970s African-American converts to Islam. I am black, I am proud and I don't shy from showing it. I wasn't going to downplay my cultural identity to accommodate someone else's intolerance, because I believe that black is beautiful. I believe in living that old 1960s credo, as out of style as it may be.</p>
      <p>Growing up black, and to some extent Muslim, colors almost all that I believe and just about everything I do — how I talk, what I eat, the clothes I wear, what I fear and love.</p>
      <p>In fifth grade, while my friends disguised themselves as witches and zombies for Halloween, I became Queen Nefertiti, celebrated Egyptian wife of the pharaoh Akhnaten. I thought I really looked like her with my tunic belted above the waist, feet exposed in my mother's sandals and heavy eyeliner, just like I saw in pictures. My neighbor thought I looked more like an ancient Roman or Greek. Back then I didn't know how to articulate to her the dignity I had for my heritage, so I said nothing. I just cut my trick-or-treating short that night.</p>
      <p>I learned, along with every other American school kid, that at one point in this country being black meant being less than human. But that never made me wish I wasn't black. I love that my African people were among the most innovative in the world and am constantly amazed that my ancestors survived a period of unimaginable hardship. I'm forever grateful to my grandparents' fight for equal rights and equally admire my brothers for creating a music and culture with impact worldwide.</p>
      <p>So I could never mask who I really am, not even to get a job.</p>
      <p>People like me may have gone out of style, with leather Africa medallions and embroidered FUBU T-shirts, but I still believe in celebrating my blackness. It starts with my name and remains at the forefront of my identity because for me, there is no shame in being black. And I don't mean just having brown skin. There's no shame in having thick nappy hair, big full lips, a colorful melodic vernacular or even an inherent sense of rhythm, stereotype or not.</p>
      <p>So I refuse to be anyone but myself: hip-hop listening, nappy hair-having, Girlfriends-watching, James Baldwin-, Zora Neale Hurston-, Malcolm X-reading me. I've internalized that black is beautiful, not a condition to rise above. For as long as it takes, I'll keep being Sufiya Abdur-Rahman on my resume and everywhere else I go.</p>
    </div></p>
    <iframe src="https://www.npr.org/player/embed/93879707/93954502" width="100%" height="210" frameborder="0" scrolling="no" title="NPR embedded audio player"></iframe>
    
  <?php
  bz_close_box();
  ?>
  <h2>Braven Nation</h2>
  <?php bz_open_box('pulse', 'Which of these reasons to stay involved with Braven appeals to you? (check all that apply)');
    $items = array(
      array(
        'content'=>'Stay connected to a growing network of like-minded peers as well as young professionals and organizations that can help you on your path to fulfilling your potential.',
      ),
      array(
        'content'=>'Pay it forward to other students in this community.',
      ),
      array(
        'content'=>'Participate in more leadership and professional development experiences that will help you grow your skills and readiness for the workplace.',
      ),
    );
    bz_make_cr_list($items,'checklist',null,'dont-mix');
    bz_make_textarea(array('other'=>true));
  bz_close_box();
  //
  bz_open_box('answer',null,'Why stay connected');
  ?>
  <p>Braven exists to see to it that the next generation of leaders will emerge from everywhere.</p>
  <p>Your experience in the Braven Accelerator this semester is part of a nationwide movement to ensure that leaders like you succeed on their career path and change the face of leadership across the nation.</p>
  <p>Braven is much more than a course or a one-time experience: now that you have completed the Braven Accelerator, you are ready be an active participant in #BravenNation!</p>
  <?php 
  bz_close_box();
  //
  bz_open_box('action');
  ?>
  <p>While your cohort will stop meeting week to week, we encourage you to keep in touch and continue to support each other’s paths. One way to lead your cohort in continued connection and communication is to become a Braven Cohort Captain. Read this description for this role:</p>  
  <div class="bz-example">
    <iframe src="https://docs.google.com/document/d/e/2PACX-1vQf1jqRVAJcAt0PJ2JWl0o0AopL8yJp4ox2IRl_kW8tNRmU5_MJzovx24OvjmG4-NHSdQXsfYJwdykg/pub?embedded=true" style="width:100%; height: 400px;"></iframe>
  </div>
  <?php
  bz_close_box();
  //
  bz_open_box('question', 'In the final Learning Lab, your cohort will determine which Fellow will be its Cohort Captain. Having read the requirements of the role, who do you think would be an effective Cohort Captain?');

    $items = array (
      array('content'=>'Me!',),
    );
    bz_make_cr_list($items);
    echo '<p>You can also nominate other people from your cohort you think would do a good job:</p>';
    bz_make_textarea(array('optional'=>true));
  bz_close_box();
  //
  bz_open_box('action', 'Here are some other ways to stay involved right now. Check each off once you’ve completed it.');
    $items = array(
array(
  'content'=>'<strong>Join <a href="https://www.linkedin.com/groups/7020311" target="_blank">Braven&rsquo;s LinkedIn group</a>.</strong> This is how we&rsquo;ll continue to stay in touch over time. Here, you&rsquo;ll find job postings, articles, helpful conversation threads, etc. ',
),
array(
  'content'=>'<strong>Join your regional Facebook group</strong>. You&rsquo;ve been a member of your chapter&rsquo;s Facebook group throughout the semester. Now, it&rsquo;s time to join hundreds of other Braven Fellows and Leadership Coaches in your <em>regional</em> network group. You&rsquo;ll hear about opportunities, events, shoutouts, and much more. Join your regional group here: <a href="https://www.facebook.com/groups/BravenBayArea/" target="_blank">Bay Area Network</a> / <a href="https://www.facebook.com/groups/BravenNationNYCNJ/" target="_blank">Newark Network</a> ',
),
array(
  'content'=>'<strong>Invite friends to apply for the next Braven Accelerator</strong>. Tell them about the impact Braven had on you, and then send them to <a href="https://www.bebraven.org/apply" target="_blank">bebraven.org/apply</a> to apply. Former Fellows are Braven&rsquo;s best advocates! ',
),
array(
  'content'=>'<strong>Indicate ways you want to stay engaged in the Post-Accelerator Survey</strong>, and the Braven staff will follow up. Remember, this survey is worth part of your professionalism grade! ',
),
);
    bz_make_cr_list($items, 'checklist', null, 'dont-mix');
  bz_close_box();
  //
  bz_open_box('pulse', 'Here are just a few of the opportunities you can look forward to as a Post-Accelerator Fellow (PAF). Which ones are most interesting to you? (check all that apply)');
    $items = array(
      array(
        'content'=>'Participate in a Design Thinking Hackathon hosted by a local company ',
      ),
      array(
        'content'=>'Become a leader on the Braven Club’s E-Board ',
      ),
      array(
        'content'=>'Attend Braven Club events such as networking events and workshops ',
      ),
      array(
        'content'=>'Become a Braven Brand Ambassador to spread the word about Braven on your campus ',
      ),
      array(
        'content'=>'Volunteer at future Accelerator events like Storytelling as Leadership or Hustle to Career Bootcamp ',
      ),
      array(
        'content'=>'Work one-on-one with a Professional Mentor in your career field to secure a strong first job after you graduate ',
      ),
    );
    bz_make_cr_list($items);
  bz_close_box();
  //
  bz_open_box('question','How can you make sure you won’t miss out on awesome Braven Post-Accelerator events and opportunities? (check all that apply)','Last Quick Question, ever');
    $items = array (
      array(
        'content'=>'Check your email regularly',
        'feedback'=>'We’ll be in touch! Don’t be a stranger ',
        'correctness'=>'correct',
      ),
      array(
        'content'=>'Check your Braven regional Facebook group regularly ',
        'feedback'=>'This is where we’ll post about upcoming opportunities and events ',
        'correctness'=>'correct',
      ),
      array(
        'content'=>'Look back at the Braven Portal ',
        'feedback'=>'You can always come back, but we won’t be updating it with PAF events ',
        'correctness'=>'incorrect',
      ),
      array(
        'content'=>'Ask your Leadership Coach ',
        'feedback'=>'Keep in touch with your LC! But s/he’s not the first person who will know about the latest opportunities ',
        'correctness'=>'incorrect',
      ),
    );
    bz_make_cr_list($items);
  bz_close_box();
  ?>
  <h2>Final three things</h2>
  <?php
  bz_open_box('flush');
  ?>
    <ol>
      <li>Remember to complete your Post-Accelerator Survey! You will receive an email with a link (check your spam/promotions folder just in case). <strong>Completing it is part of your professionalism grade for the course</strong>.</li>
      <li>Remember to turn in your <a href="/courses/1/assignments/711" target="_blank">Tackle Career Challenges Project</a> on time! <strong>It cannot be resubmitted for a higher grade.</strong></li>
      <li>See you at the final Learning Lab!</li>
    </ol>
  <div style="text-align: center;" class="full">
    <p>&nbsp;<br />&nbsp;<br /></p>
    <p>Stick a fork in this online module because you are&hellip;</p>
  <?php
  bz_close_box();
  ?>
  </div>
  </div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>