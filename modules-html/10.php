<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Module 9 Design Thinking Sprint</title>
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
<div class="bz-module">
    <h2 id="why">Why is this important?</h2>
    <div class="bz-box question">
        <h3 class="box-title">Quick Question</h3>
        <p>It's your first month on the job and you are confronted with a big, hairy problem to solve. You feel that this is your time to shine (or fail). Which of the following is true? (check all that apply)</p>
        <ul class="checklist instant-feedback">
            <li class="correct"><input type="checkbox" data-bz-retained="dts-q01-1" />You're more likely to identify the best solution and act on it by not leaving things up to chance.</li>
            <li class="correct"><input type="checkbox" data-bz-retained="dts-q01-2" />Using a <span class="bz-has-tooltip" title="Methodical, using a plan">systemic</span> approach will lead to solutions that are less subjective and less impacted by biases or perceptions.</li>
            <li class="correct"><input type="checkbox" data-bz-retained="dts-q01-3" />You will find it easier to present your solution to the rest of the team if it's backed by a clear rationale.</li>
            <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q01-4" />You will have to rely on luck to figure things out.</li>
            <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q01-5" />You will use process of elimination and try all sorts of things that don't work.</li>
        </ul>
        <p>
          <input class="bz-toggle-all-next for-checklist" type="button" value="Done" data-bz-retained="dts-btn-01" />
        </p>
      </div>
      <div class="bz-box video">
        <h3 class="box-title">Watch this</h3>
        <div class="tbd">[Video testimonial of a Braven team member talking about trying to solve a problem without a framework and then how much easier it got when using a systemic approach]</div>
        <p>
          <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-02" />
        </p>    
    </div>
    <div class="bz-box question empathize">
        <h3 class="box-title">See it from their perspective</h3>
        <p>You're interviewing a candidate for a role at your company. You want to know how he approaches problems, because problem-solving is a daily, if not constant task at your workplace. You present the candidate with a typical problem you encounter at your company, and ask how he would approach it. What do you hope to hear?</p>
        <ul class="radio-list instant-feedback">
            <li class="correct"><input type="radio" data-bz-retained="dts-q-03-r" name="dts-q-03-r" value="1" />A description of the logical, step-by-step framework he would follow to solve the problem <p class="feedback inline">Correct! You want to see how he wraps his head around problems and that he approaches them systematically.</p></li>
            <li class="incorrect"><input type="radio" data-bz-retained="dts-q-03-r" name="dts-q-03-r" value="2" />He won't sleep until he solves the problem <p class="feedback inline">You want to know that he will work smart, not just work hard. Being well-rested is important for solving problems well!</p></li>
            <li class="incorrect"><input type="radio" data-bz-retained="dts-q-03-r" name="dts-q-03-r" value="3" />He will ask the appropriate person at the company for help <p class="feedback inline">You want to know how he would try to solve the problem before asking for help. Asking for help isn't a bad thing, but if he's always reliant on others to solve problems for him, he won't be an asset to the team.</p></li>
            <li class="incorrect"><input type="radio" data-bz-retained="dts-q-03-r" name="dts-q-03-r" value="4" />A list of all the possible solutions <p class="feedback inline">This might make you think he jumps to conclusions without any process, which could mean he a) will make a lot of mistakes, and b) will waste a lot of time until he finds the right solution (if he ever does).</p></li>
        </ul>
        <p>
          <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-03" />
        </p>
    </div>
    <blockquote>
      "My mom was a quintessential businesswoman. She taught me problem-solving. She can solve any problem."
      <p class="quote-source">Obiageli Ezekwesili, co-founder of Transparency International</p>
    </blockquote>
    <h2 id="how">How do I do this?</h2>
    <p>You may already know some approaches to systematic problem solving, and even if you don't, you may have some good problem-solving instincts. This module will walk you through an approach you may not be as familiar with &mdash; Design Thinking &mdash; which can help you solve some of the big, hairy problems you'll probably encounter in work and in life.</p>
    <h3>How do I solve problems effectively?</h3>
    <div class="bz-box question">
      <h4 class="box-title">Quick Question</h4>
      <p>What are the traits of effective problem-solvers? (check all that apply)</p>
      <ul class="checklist instant-feedback">
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q05-1" />A solutions-oriented mindset <p class="feedback inline">Effective problem-solvers believe there is a solution for almost every problem and they believe in their capacity to create positive change. They believe in their own ability to find solutions. </p></li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q05-2" />Positive attitude <p class="feedback inline">Effective problem-solvers value optimism and not giving up. They embrace a sense of possibility and curiosity when confronted with problems. They celebrate the journey and value the learning process which can sometimes involve being wrong or making mistakes. Their sense of self-worth isn't dependent on the solutions they land on. </p></li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q05-3" />Critical thinking skills <p class="feedback inline">Problem-solving draws on critical thinking and your ability to use knowledge, facts, and data to effectively solve problems. This does not mean you need to have immediate answers but it does mean you have methods to think on your feet, assess problems, and find solutions.</p> </li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q05-4" />Creativity <p class="feedback inline">Problem-solving relied on creative thinking and your ability to find innovative solutions.</p> </li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q05-5" />Adaptability <p class="feedback inline">Effective problem-solvers are flexible in their approach to finding a solution. They embrace the iterative process: They solicit input, act on feedback, consider new information and ultimately land on a better solution that way. They can also change their approach based on the type of situation they are faced with.</p></li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q05-6" />Self-sufficiency <p class="feedback inline">While problem-solving will require autonomy, it cannot be done all alone. Seeking feedback and other voices along the way will result in a better solution.</p></li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q05-7" />Sticking to one framework <p class="feedback inline">Effective problem-solvers leverage a variety of techniques to define problems and identify solutions.</p> </li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q05-8" />Having all the answers<p class="feedback inline">No one has all the answers, and keeping an open mind during the process of defining and solving a problem is likely to generate better solutions.</p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-05" />
      </p>
    </div>
    <div class="bz-box reflection">
      <h4 class="box-title">Get to know yourself</h4>
      <p>How would you rate yourself on these effective problem-solving traits? </p>
      <table class="multi-radios">
        <thead>
          <tr>
            <th rowspan="2">Trait</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
          </tr>
          <tr>
            <th colspan="2" style="font-size: 0.9em; border-right: none;">Poor</th>
            <th colspan="3" style="font-size: 0.9em; text-align: right; border-left: none;">Excellent</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><p><strong>A solutions-oriented mindset</strong></p><p>Effective problem-solvers believe there is a solution for almost every problem and they believe in their capacity to create positive change. They believe in their own ability to find solutions.</p></td>
            <td><input name="dts-q-06-1" type="radio" value="1" data-bz-retained="ace-q-06-1" /></td>
            <td><input name="dts-q-06-1" type="radio" value="2" data-bz-retained="ace-q-06-1" /></td>
            <td><input name="dts-q-06-1" type="radio" value="3" data-bz-retained="ace-q-06-1" /></td>
            <td><input name="dts-q-06-1" type="radio" value="4" data-bz-retained="ace-q-06-1" /></td>
            <td><input name="dts-q-06-1" type="radio" value="5" data-bz-retained="ace-q-06-1" /></td>
          </tr>
          <tr>
            <td><p><strong>Positive attitude</strong></p><p>Effective problem-solvers value optimism and not giving up. They embrace a sense of possibility and curiosity when confronted with problems. They celebrate the journey and value the learning process which can sometimes involve being wrong or making mistakes. Their sense of self-worth isn't dependent on the solutions they land on. </p></td>
            <td><input name="dts-q-06-2" type="radio" value="1" data-bz-retained="ace-q-06-2" /></td>
            <td><input name="dts-q-06-2" type="radio" value="2" data-bz-retained="ace-q-06-2" /></td>
            <td><input name="dts-q-06-2" type="radio" value="3" data-bz-retained="ace-q-06-2" /></td>
            <td><input name="dts-q-06-2" type="radio" value="4" data-bz-retained="ace-q-06-2" /></td>
            <td><input name="dts-q-06-2" type="radio" value="5" data-bz-retained="ace-q-06-2" /></td>
          </tr>
          <tr>
            <td><p><strong>Critical thinking skills</strong></p><p>Problem-solving draws on critical thinking and your ability to use knowledge, facts, and data to effectively solve problems. This does not mean you need to have immediate answers but it does mean you have methods to think on your feet, assess problems, and find solutions. </p></td>
            <td><input name="dts-q-06-3" type="radio" value="1" data-bz-retained="ace-q-06-3" /></td>
            <td><input name="dts-q-06-3" type="radio" value="2" data-bz-retained="ace-q-06-3" /></td>
            <td><input name="dts-q-06-3" type="radio" value="3" data-bz-retained="ace-q-06-3" /></td>
            <td><input name="dts-q-06-3" type="radio" value="4" data-bz-retained="ace-q-06-3" /></td>
            <td><input name="dts-q-06-3" type="radio" value="5" data-bz-retained="ace-q-06-3" /></td>
          </tr>
          <tr>
            <td><p><strong>Creativity</strong></p><p>Problem-solving relied on creative thinking and your ability to find innovative solutions.</p></td>
            <td><input name="dts-q-06-4" type="radio" value="1" data-bz-retained="ace-q-06-4" /></td>
            <td><input name="dts-q-06-4" type="radio" value="2" data-bz-retained="ace-q-06-4" /></td>
            <td><input name="dts-q-06-4" type="radio" value="3" data-bz-retained="ace-q-06-4" /></td>
            <td><input name="dts-q-06-4" type="radio" value="4" data-bz-retained="ace-q-06-4" /></td>
            <td><input name="dts-q-06-4" type="radio" value="5" data-bz-retained="ace-q-06-4" /></td>
          </tr>
          <tr>
            <td><p><strong>Adaptability</strong></p><p>Effective problem-solvers are flexible in their approach to finding a solution. They embrace the iterative process: They solicit input, act on feedback, consider new information and ultimately land on a better solution that way. They can also change their approach based on the type of situation they are faced with.</p></td>
            <td><input name="dts-q-06-5" type="radio" value="1" data-bz-retained="ace-q-06-5" /></td>
            <td><input name="dts-q-06-5" type="radio" value="2" data-bz-retained="ace-q-06-5" /></td>
            <td><input name="dts-q-06-5" type="radio" value="3" data-bz-retained="ace-q-06-5" /></td>
            <td><input name="dts-q-06-5" type="radio" value="4" data-bz-retained="ace-q-06-5" /></td>
            <td><input name="dts-q-06-5" type="radio" value="5" data-bz-retained="ace-q-06-5" /></td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-06" />
      </p>     
    </div>
    <p>We all have strengths and weaknesses when it comes to these traits. Now you know which traits need more practice, and luckily the last part of the Braven Accelerator is all about practicing problem-solving!</p>
    <h4>Problem Solving Frameworks</h4>
    <div class="bz-box video">
      <h5 class="box-title">Watch this</h5>
      <figure>
        <iframe src="https://player.vimeo.com/video/128205749" allowfullscreen></iframe>
        <figcaption>
          <p>A quick look at three commonly used problem-solving tools: the Scientific Method, Outcomes-Causes-Solutions, and Design Thinking.<span class="media-duration">6:20</span></p>
          <p class="media-instructions">Closed captions available</p>
        </figcaption>
      </figure>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-07" />
      </p>     
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>Match the framework to what it does:</p> 
      <table class="sort-to-match">
        <tbody>
          <tr>
            <td>Experiment to explore observations and facts and answer questions</td>
            <td>Scientific Method</td>
          </tr>
          <tr>
            <td>Identify the root causes of a problem</td>
            <td>Outcomes-Causes-Solutions (OCS)</td>
          </tr>
          <tr>
            <td>Solve human-centered problems through innovation</td>
            <td>Design Thinking</td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next for-match" type="button" value="Done" data-bz-retained="dts-btn-08" />
      </p>     
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>You're in charge of budgeting at your company, and you notice that the team spent more last month than what was allowed for in the budget. Which problem-solving framework would you choose to quickly diagnose the cause of the over-expenditure and how to fix it?</p>
      <ul class="radio-list instant-feedback">
        <li class="incorrect"><input type="radio" name="dts-q08b-r" data-bz-retained="dts-q08b-r" value="1" />Scientific Method <p class="feedback inline">Conducting an experiment is not the best way to quickly diagnose the root cause of this problem.</p></li>
        <li class="correct"><input type="radio" name="dts-q08b-r" data-bz-retained="dts-q08b-r" value="2" />OCS <p class="feedback inline">Correct! The OCS method will allow you to determine the causes of the outcome, potentially by digging into the monthly expenditures, and come up with appropriate solutions for those root causes.</p> </li>
        <li class="incorrect"><input type="radio" name="dts-q08b-r" data-bz-retained="dts-q08b-r" value="3" />Design Thinking <p class="feedback inline">While this is a human-centered problem, spending the time to empathize with users is not the fastest way to diagnose the root cause of the expenditure problem.</p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-08b" />
      </p>     
    </div>
    <h3>How do I use the Design Thinking framework?</h3>
    <div class="bz-box question">
      <h4 class="box-title">Quick Question</h4>
      <p>Which of these questions <strong>cannot</strong> be answered using the Design Thinking framework? </p>
      <ul class="radio-list instant-feedback">
        <li class="incorrect"><input type="radio" name="dts-q09-r" data-bz-retained="dts-q09-r" value="1" />How might we design a more comfortable mattress?</li>
        <li class="incorrect"><input type="radio" name="dts-q09-r" data-bz-retained="dts-q09-r" value="2" />How might we provide shelter to refugees in host countries?</li>
        <li class="incorrect"><input type="radio" name="dts-q09-r" data-bz-retained="dts-q09-r" value="3" />How might we increase the revenue of our company's core product?</li>
        <li class="correct"><input type="radio" name="dts-q09-r" data-bz-retained="dts-q09-r" value="4" />How might we identify my mother's illness?
        <p class="feedback inline">Correct. While this problem is about a human, it would require you to delve into the biology of the human body, which is not best solved with Design Thinking.</p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-09" />
      </p>     
    </div>
    <p>In addition to solving human-centered problems, Design Thinking is a great approach for tackling complex, persistent problems that are difficult to frame because it asks us to spend more time listening to users and defining the problem than building solutions. We stay away from "jumping to conclusions" too quickly because if we don't adequately understand the problem, we might build an unnecessary solution that doesn't work or that no one uses.</p>
    <div class="bz-box question">
      <h4 class="box-title">Quick Question</h4>
      <p>Why do you suppose we're diving deep into Design Thinking in this course?</p>
      <ul class="checklist instant-feedback">
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q09b-1" />I'll be using Design Thinking later in the course.</li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q09b-2" />Many workplaces use the Design Thinking framework for problem solving.</li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q09b-3" />Design Thinking will let me practice skills that are transferrable (e.g. brainstorming, empathy-based research, defining a problem).</li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q09b-4" />Because it's the most useful framework for solving problems in a professional setting.<p class="feedback inline">No single framework is "the most useful" because different frameworks are optimized for different types of problems. </p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-09b" />
      </p>
    </div>
    <div class="bz-box answer">
      <h4 class="box-title">Who uses Design Thinking?</h4>
      <p>Wonder which companies/organizations use Design Thinking? Here are just a few:</p>
      <ul class="dont-mix">
        <li>LinkedIn</li>
        <li>IBM</li>
        <li>Intuit</li>
        <li>Teach for America</li>
        <li>Braven (!)</li>
        <li>San Francisco Opera House</li>
      </ul>    
    </div>
    <div class="bz-box video">
      <h4 class="box-title">Watch this</h4>
      <figure>
        <iframe src="https://www.youtube.com/embed/pPi3E9mVlXo?rel=0" allowfullscreen></iframe>
        <figcaption><p>Watch this video that features a team at the successful consulting firm, IDEO. They use the Design Thinking framework to build a better shopping cart. <br /><strong>Fair warning:</strong>This video is a news clip from the 90s, so be prepared for some awesome outfits!</p>
          <p class="media-duration">8:13</p>
          <p class="media-instructions">Closed captions available (auto-generated)</p>
        </figcaption>
      </figure>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-11" />
      </p>     
    </div>
    <blockquote>
      "What we &mdash; as design thinkers &mdash; have is this creative confidence that, when given a difficult problem, we have a methodology that enables us to come up with a solution that nobody has [done] before." 
      <p class="quote-source">David Kelly, founder of IDEO</p>
    </blockquote>
    <div class="bz-box question">
      <h4 class="box-title">Quick Question</h4>
      <p>Now that you've seen Design Thinking in action, match the steps of the Design Thinking process to their descriptors.</p>
      <table class="sort-to-match">
        <tbody>
          <tr>
            <td>This is the foundation of human-centered design. It is the ability to step into someone else's shoes and understand that person's experiences and feelings. You start here in the Design Thinking process to deeply understand your users and their needs. When you do this well, you can uncover needs that users themselves might not even know they have.</td>
            <td>Empathize</td>
          </tr>
          <tr>
            <td>This can sometimes be the toughest part of the design process! However, it is also the most critical because it allows you to explicitly express the problem you are trying to solve. It involves unpacking and synthesizing your user­-centered, empathy-­based findings into compelling needs and insights, and, based on this understanding, coming up with an actionable problem statement.</td>
            <td>Define</td>
          </tr>
          <tr>
            <td>This is brainstorming: generating as many different ideas as you can to solve the problem you have defined. This part of Design Thinking challenges you to step beyond obvious solutions and uncover unexplored and unexpected areas, increasing your innovation potential. When you do this in teams, you are also harnessing the collective perspectives and strengths of everyone on your team.</td>
            <td>Ideate</td>
          </tr>
          <tr>
            <td>This step is about putting your ideas into rough physical or digital form so that users can test your ideas and you can refine your solution. This step is never done just in your head; instead, you have to build out your solution. </td>
            <td>Prototype</td>
          </tr>
          <tr>
            <td>You do this with users to learn from their experience and gain more insight to later refine your prototypes. When users provide you with feedback, you are able to improve your solution.</td>
            <td>Test</td>
          </tr>
          <tr>
            <td>Take the information you learned through testing to iterate on your prototype.</td>
            <td>Refine</td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next for-match" type="button" value="Done" data-bz-retained="dts-btn-12" />
      </p>     
    </div>
    <h4>Empathize</h4>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>Which quotation explains what it means to empathize?</p>
      <ul class="radio-list instant-feedback">
        <li class="correct"><input type="radio" name="dts-q13-r" data-bz-retained="dts-q13-r" value="1" />&ldquo;You never really understand a person until you consider things from his point of view &mdash; until you climb into his skin and walk around in it.&rdquo;  &mdash; from <i>To Kill a Mockingbird</i> by Harper Lee</li>
        <li class="incorrect"><input type="radio" name="dts-q13-r" data-bz-retained="dts-q13-r" value="2" />&ldquo;There is some good in this world, and it's worth fighting for.&rdquo; &mdash; from <i>The Two Towers</i> by J.R.R. Tolkien</li>
        <li class="incorrect"><input type="radio" name="dts-q13-r" data-bz-retained="dts-q13-r" value="3" />&ldquo;It's our choices that show what we truly are, far more than our abilities.&rdquo; &mdash; from <i>Harry Potter and the Chamber of Secrets</i> by J.K. Rowling</li>
        <li class="incorrect"><input type="radio" name="dts-q13-r" data-bz-retained="dts-q13-r" value="4" />&ldquo;Yes: I am a dreamer. For a dreamer is one who can only find his way by moonlight, and his punishment is that he sees the dawn before the rest of the world.&rdquo; &mdash; from The <i>Critic as Artist</i> by Oscar Wilde</li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-13" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">Empathy is the foundation of the human-centered design process</h5>
      <p>Empathy is the foundation of the human-centered design process.</p>
      <p>You need to understand the people whose problems you're trying to solve (typically defined as "<i>users</i>" of a product, service, or system), in order to build a solution they can use. And you must build empathy for who they are and what's important to them. Effective Design Thinking takes you, your ideas, your tastes, and your assumptions out of this important first step and puts the user at the center of your curiosity and innovation.</p>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-14" />
      </p>     
    </div>
    <div class="bz-box action">
      <h5 class="box-title">Let's practice a bit: identify users</h5>
      <p>Imagine you were hired by a hospital to improve the hospital waiting room experience. First watch this video about the variety of people who come and go through a hospital to better understand their needs, motivations, and frustrations.</p>
      <figure>
        <iframe src="https://www.youtube.com/embed/cDDWvj_q-o8?rel=0" allowfullscreen></iframe>
        <figcaption>
          <p class="media-duration">4:23</p>
          <p class="media-instructions">(No audible text)</p>
          <p class="screenreader-only">The video shows various people at a hospital waiting room. If you can't see the video you can use your past exeperience and your knowledge of what hospitals are like to answer the following questions.</p>
        </figcaption>
      </figure>
      <p>Who are the users of the hospital waiting room? Identify <strong>at least five</strong> types of people in the video who are affected by the waiting room and have a stake in it being improved.</p>
      <ol class="dont-mix">
        <li><textarea data-bz-retained="dts-q15-1" ></textarea></li>
        <li><textarea data-bz-retained="dts-q15-2" ></textarea></li>
        <li><textarea data-bz-retained="dts-q15-3" ></textarea></li>
        <li><textarea data-bz-retained="dts-q15-4" ></textarea></li>
        <li><textarea data-bz-retained="dts-q15-5" ></textarea></li>
        <li><textarea data-bz-retained="dts-q15-6" class="bz-optional-magic-field" ></textarea></li>
        <li><textarea data-bz-retained="dts-q15-7" class="bz-optional-magic-field" ></textarea></li>
        <li><textarea data-bz-retained="dts-q15-8" class="bz-optional-magic-field" ></textarea></li>
      </ol>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-15" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">Answer</h5>
      <p>Compare your answers to the partial list below:</p>
      <ul class="dont-mix">
        <li>Patients (in various phyisical and emotional conditions)</li>
        <li>Family members of patients (from various <span class="bz-has-tooltip" title="Age, gender, ethnicity, socio-economic status, educational attainment, etc.">demographics</span> and in various emotional states)</li>
        <li>Doctors</li>
        <li>Nurses</li>
        <li>People (other than family) helping the patients, such as a private nurse or a friend</li>
        <li>Administrative staff (fomr various roles and seniority levels)</li>
        <li>Security guards</li>
        <li>Pets</li>
        <li>Delivery people (flowers, medical supplies, food, refilling the vending machines)</li>
      </ul>
    </div>
    <div class="bz-box action">
      <h5 class="box-title">Now let's try out a helpful tool: the empathy map</h5>
      <p>To empathize means to know what users are saying, doing, thinking, and feeling, and most importantly: understanding why.</p>
      <p>An empathy map can help you organize the information you gather about your users. The deeper you go, the more likely you will get to the root problem, and be able to build a solution that solves it effectively.</p>
      <p>Select one of the users from the hospital waiting room and fill out this empathy map for him/her:</p>
      <table class="equal-column-widths no-zebra">
        <tbody>
          <tr>
            <td>
              <h6>Say</h6>
              <p>What are some quotes and defining words your user said?)</p>
              <textarea data-bz-retained="dts-q16-1" ></textarea>
            </td>
            <td>
              <h6>Think</h6>
              <p>What might your user be thinking? What does this tell you about his or her beliefs?)</p>
              <textarea data-bz-retained="dts-q16-2" ></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <h6>Do</h6>
              <p>What actions and behaviors did you notice?)</p>
              <textarea data-bz-retained="dts-q16-3" ></textarea>
            </td>
            <td>
              <h6>Feel</h6>
              <p>What emotions might your user be feeling?)</p>
              <textarea data-bz-retained="dts-q16-4" ></textarea>
            </td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-16" />
      </p>     
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>There are many ways to build empathy for the users in a given problem. Select the best ways to do this. (check all that apply)</p>
      <ul class="checklist instant-feedback">
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q17-1 /">Observation <p class="feedback inline">You can learn a lot just by watching behaviors.</p></li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q17-2 /">Immersion <p class="feedback inline">Become the user, <em>literally</em>.</p></li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q17-3 /">Asking and listening <p class="feedback inline">You can interact with your users through both scheduled encounters and immersive experiences- through interviews and authentic relationships. Be curious and ask "why?" Seek stories that reveal the user's experience and emotions. By probing beneath the surface, you can find out how people really think and feel underneath what they are doing and saying.</p></li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q17-4 /">Surveying <p class="feedback inline">Surveying users can give a general idea of their thoughts, but it won't allow you to go as deep as you need to when empathizing. </p></li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q17-5 /">Data <p class="feedback inline">Data can give helpful information about trends, but it won't help you empathize with individual users.</p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-17" />
      </p>     
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>Interviewing users is a common way to build empathy. Sort the following kinds of questions you may ask during an interview into Effective or Ineffective.</p>
      <table class="multi-radios instant-feedback">
        <thead>
          <tr>
            <th>Question</th><th>Effective</th><th>ineffective</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Short</td>
            <td class="correct"><input type="radio" name="dts-q18-r03" data-bz-retained="dts-q18-r03" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q18-r03" data-bz-retained="dts-q18-r03" value="0" /></td>
          </tr>
          <tr>
            <td>Binary (yes/no)</td>
            <td class="incorrect"><input type="radio" name="dts-q18-r07" data-bz-retained="dts-q18-r07" value="1" /></td>
            <td class="correct"><input type="radio" name="dts-q18-r07" data-bz-retained="dts-q18-r07" value="0" /></td>
          </tr>
          <tr>
            <td>Open-ended</td>
            <td class="correct"><input type="radio" name="dts-q18-r01" data-bz-retained="dts-q18-r01" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q18-r01" data-bz-retained="dts-q18-r01" value="0" /></td>
          </tr>
          <tr>
            <td>Encourage stories</td>
            <td class="correct"><input type="radio" name="dts-q18-r06" data-bz-retained="dts-q18-r06" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q18-r06" data-bz-retained="dts-q18-r06" value="0" /></td>
          </tr>
          <tr>
            <td>Neutral</td>
            <td class="correct"><input type="radio" name="dts-q18-r02" data-bz-retained="dts-q18-r02" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q18-r02" data-bz-retained="dts-q18-r02" value="0" /></td>
          </tr>
          <tr>
            <td>Uncover the user's perspective on solutions</td>
            <td class="incorrect"><input type="radio" name="dts-q18-r10" data-bz-retained="dts-q18-r10" value="1" /></td>
            <td class="correct"><input type="radio" name="dts-q18-r10" data-bz-retained="dts-q18-r10" value="0" /></td>
          </tr>
          <tr>
            <td>Long</td>
            <td class="incorrect"><input type="radio" name="dts-q18-r09" data-bz-retained="dts-q18-r09" value="1" /></td>
            <td class="correct"><input type="radio" name="dts-q18-r09" data-bz-retained="dts-q18-r09" value="0" /></td>
          </tr>
          <tr>
            <td>"Why?"</td>
            <td class="correct"><input type="radio" name="dts-q18-r05" data-bz-retained="dts-q18-r05" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q18-r05" data-bz-retained="dts-q18-r05" value="0" /></td>
          </tr>
          <tr>
            <td>Uncover the user's motivations, frustrations, and needs</td>
            <td class="correct"><input type="radio" name="dts-q18-r04" data-bz-retained="dts-q18-r04" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q18-r04" data-bz-retained="dts-q18-r04" value="0" /></td>
          </tr>
          <tr>
            <td>Biased</td>
            <td class="incorrect"><input type="radio" name="dts-q18-r08" data-bz-retained="dts-q18-r08" value="1" /></td>
            <td class="correct"><input type="radio" name="dts-q18-r08" data-bz-retained="dts-q18-r08" value="0" /></td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-18" />
      </p>     
    </div>
    <div class="bz-box question">
      <h5 class="box-title">How to ask questions that give you insights</h5>
      <p>Let's take a man who has been waiting for three hours in the hospital waiting room video and let's imagine that his name is Martin and he is waiting for his wife to complete hip replacement surgery &mdash; a complicated, long, and risky procedure.</p>
      <p>Which of the following questions will help you best understand Martin's needs, motivations, and frustrations?</p>
      <ul class="radio-list instant-feedback">
        <li class="correct"><input type="radio" name="dts-q19-r" data-bz-retained="dts-q19-r" value="1" />What is it like waiting here? <p class="feedback inline">Correct! This is an open-ended question that would help you uncover Martin's needs, motivations, and frustrations.</p></li>
        <li class="incorrect"><input type="radio" name="dts-q19-r" data-bz-retained="dts-q19-r" value="2" />What would make the waiting room better?<p class="feedback inline">This question is asking for solutions, whereas you should be trying to understand the problem(s) at this stage.</p></li>
        <li class="incorrect"><input type="radio" name="dts-q19-r" data-bz-retained="dts-q19-r" value="3" />Do you feel scared?<p class="feedback inline">This is a binary, yes/no question, which doesn't usually help get to a deeper understanding on its own.</p></li>
        <li class="incorrect"><input type="radio" name="dts-q19-r" data-bz-retained="dts-q19-r" value="4" />Don't you think the waiting room is a dull place?<p class="feedback inline">This inserts your bias into the question, which will sway the answer you receive.</p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-19" />
      </p>     
    </div>
    <blockquote>
      How can you solve a problem if you don't fully understand what the problem is?
    </blockquote>
    <h4>Define</h4>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>In many problem-solving frameworks you begin with a well-defined problem before trying to solve it. Why in Design Thinking do we empathize with users <em>before</em> defining the problem we're trying to solve?</p>
      <ul class="radio-list instant-feedback">
        <li class="correct"><input type="radio" name="dts-q20-r" data-bz-retained="dts-q20-r" value="1" />By empathizing, we may uncover the real root problem our users face. <p class="feedback inline">Our research illuminates user's needs, which helps us define the actual problem and design solutions that actually solve it. </p></li>
        <li class="incorrect"><input type="radio" name="dts-q20-r" data-bz-retained="dts-q20-r" value="2" />We typically don't know what the challenge is when we start. <p class="feedback inline">You only dig into the Design Thinking process when you know there is a problem to solve. However, it might not be a well-defined problem. </p></li>
        <li class="incorrect"><input type="radio" name="dts-q20-r" data-bz-retained="dts-q20-r" value="3" />Users are the best people to provide potential solutions. <p class="feedback inline">Users sometimes have great ideas of how to solve their own problems, but often they don't have enough distance from the problem to have a fresh perspective. </p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-20" />
      </p>     
    </div>
    <div class="bz-box key">
      <h5 class="box-title">The problem statement template</h5>
      <p>The first step in defining the problem in Design Thinking is to create a problem statement using this structure:</p>
      <div class="bz-example">
        <strong>[USER]</strong> needs a way to <strong>[USER'S NEED]</strong> because unexpectedly, in his/her world, <strong>[SURPRISING INSIGHT]</strong>
      </div>
      <p>Label the different parts of the following problem statement.</p>
      <table class="sort-to-match">
        <tbody>
          <tr>
            <td>User</td>
            <td>Tony, who loves Popeye's</td>
          </tr>
          <tr>
            <td>User's need</td>
            <td>stop eating fried chicken</td>
          </tr>
          <tr>
            <td>Surprising insight</td>
            <td>his high cholesterol might lead to a heart attack</td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next for-match" type="button" value="Done" data-bz-retained="dts-btn-21" />
      </p>     
    </div>
    <div class="bz-box">
      <h6>USER</h6>
      <p>In the problem statement, you'll notice that the user is very specific. Instead of saying "People" or "Obese students," the user is defined as "Tony, who loves Popeye's."</p>
    </div>
    <div class="bz-box">
      <h6>USER'S NEED</h6>
      <p class="tbd">This should be <em>a verb</em> that connects to a deeper emotion, which can inspire a brand new solution. In the example above, the user's need is to stop eating fried chicken. Another (deeper) need is to lower his cholesterol. A noun suggests an assumed solution, which narrows the options for possible solutions too early in the process. For example saying "Tony needs a low-cholesterol food option" will make us focus on questions such as what type of sandwich Tony should choose at Popeye's, but might block out ideas such as increasing exercise, taking cholesterol-reducing drugs, changing Tony's diet, or a mix of the above.</p>
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p class="tbd">INSERT IMAGE</p>
      <p>What is this girl's need?</p>
      <ul class="radio-list">
        <li class="incorrect"><input type="radio" name="dts-q22-r" data-bz-retained="dts-q22-r" value="1" />She needs a ladder.</li>
        <li class="incorrect"><input type="radio" name="dts-q22-r" data-bz-retained="dts-q22-r" value="2" />She needs a book.</li>
        <li class="incorrect"><input type="radio" name="dts-q22-r" data-bz-retained="dts-q22-r" value="3" />She needs a longer arm. </li>
        <li class="correct"><input type="radio" name="dts-q22-r" data-bz-retained="dts-q22-r" value="4" />She needs to earn an A on her English test.</li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-22" />
      </p>     
    </div>
    <div class="bz-box">
      <h6>SURPRISING INSIGHT</h6>
      <p>This describes what you've learned about the user and his/her need.</p>
      <p>Insights combine observation with intuition. It should be surprising, not trivial. And it should not the same as the need ("Tony needs to reduce his cholesterol because he has high cholesterol" doesn't help us much). If the insight is not surprising, seek something bigger or more challenging to help inspire innovative solutions. In the example about Tony, the insight is that he could die if he doesn't change his eating habits &mdash; his high cholesterol could lead to a heart attack.</p>
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>Which of the following is a good problem statement?</p>
      <ul class="radio-list instant-feedback">
        <li class="correct"><input type="radio" name="dts-q23-r" data-bz-retained="dts-q23-r" value="1" />Shoppers who are parents of toddlers need a way to keep their children close to them because unexpectedly, in their world, when they fully focus on the task of grocery shopping, there is a good chance they could lose their children inside the store. <p class="feedback inline">Correct! </p></li>
        <li class="incorrect"><input type="radio" name="dts-q23-r" data-bz-retained="dts-q23-r" value="2" />Shoppers who are parents of toddlers need seats for their children in their shopping cart because unexpectedly, in their world, when they fully focus on the task of grocery shopping, there is a good chance they could lose their children inside the store. <p class="feedback inline">The need is a noun and it assumes what the solution should be. </p></li>
        <li class="incorrect"><input type="radio" name="dts-q23-r" data-bz-retained="dts-q23-r" value="3" />Adults need a way to keep their children close to them because unexpectedly, in their world, when they fully focus on the task of grocery shopping, there is a good chance they could lose their children inside the store. <p class="feedback inline">The user is not specific enough. </p></li>
        <li class="incorrect"><input type="radio" name="dts-q23-r" data-bz-retained="dts-q23-r" value="4" />Shoppers who are parents of toddlers need a way to keep their children close to them because unexpectedly, in their world, children can't be left unattended. <p class="feedback inline">The insight is not surprising.  </p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-23" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">Characteristics of a Good Problem Statement:</h5>
      <ul>
        <li>Gets at the core of a real problem and keeps it simple!</li>
        <li>Is the root cause <span class="tbd">(to find a root cause use the five whys method: define a problem; ask "why is this happening / why is this a problem?" to define a deeper problem; repeat at least five times)</span></li>
        <li>Provides focus for your team</li>
        <li>Inspires anyone who might influence the solution</li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-24" />
      </p>     
    </div>
    <div class="bz-box action">
      <h5 class="box-title">Let's practice formulating a good problem statement</h5>
      <p>Let's go back to Martin who has been waiting for three hours in the hospital waiting room for his wife to come out of hip replacement surgery. Based on empathy data, how might we define the problem? Jot down your own problem statement here. (you might want to quickly make an Empathy Map for Martin first)</p>
      <p>
        <textarea data-bz-retained="dts-q26-t"></textarea>
      </p>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-26" />
      </p>     
    </div>
    <div class="bz-box key">
      <h5 class="box-title">"How might we" questions</h5>
      <p>"How might we..." (HMW) questions are short questions based in your problem statement that launch brainstorms in the next step of the Design Thinking process. They should be broad enough that there is a wide range of solutions, but narrow enough that the team is provoked to think of specific, unique ideas.</p>
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Qucik Question</h5>
      <p>Rate the following the HMW questions:</p>
      <table class="multi-radios instant-feedback">
        <thead>
          <tr>
            <th>Question</th>
            <th>Too broad</th>
            <th>Just right</th>
            <th>Too narrow</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>How might we wake up using an alarm clock?</td>
            <td class="incorrect"><input type="radio" name="dts-q29-r1" data-bz-retained="dts-q29-r1" value="2" /></td>
            <td class="incorrect"><input type="radio" name="dts-q29-r1" data-bz-retained="dts-q29-r1" value="1" /></td>
            <td class="correct"><input type="radio" name="dts-q29-r1" data-bz-retained="dts-q29-r1" value="0" /></td>
          </tr>
          <tr>
            <td>How might we save the world?</td>
            <td class="correct"><input type="radio" name="dts-q29-r2" data-bz-retained="dts-q29-r2" value="2" /></td>
            <td class="incorrect"><input type="radio" name="dts-q29-r2" data-bz-retained="dts-q29-r2" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q29-r2" data-bz-retained="dts-q29-r2" value="0" /></td>
          </tr>
          <tr>
            <td>How might we slow the human impact on global warming? </td>
            <td class="incorrect"><input type="radio" name="dts-q29-r3" data-bz-retained="dts-q29-r3" value="2" /></td>
            <td class="correct"><input type="radio" name="dts-q29-r3" data-bz-retained="dts-q29-r3" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q29-r3" data-bz-retained="dts-q29-r3" value="0" /></td>
          </tr>
          <tr>
            <td>How might we design a more wheelchair-friendly school?</td>
            <td class="incorrect"><input type="radio" name="dts-q29-r4" data-bz-retained="dts-q29-r4" value="2" /></td>
            <td class="correct"><input type="radio" name="dts-q29-r4" data-bz-retained="dts-q29-r4" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q29-r4" data-bz-retained="dts-q29-r4" value="0" /></td>
          </tr>
          <tr>
            <td>How might we redesign dessert?</td>
            <td class="correct"><input type="radio" name="dts-q29-r5" data-bz-retained="dts-q29-r5" value="2" /></td>
            <td class="incorrect"><input type="radio" name="dts-q29-r5" data-bz-retained="dts-q29-r5" value="1" /></td>
            <td class="incorrect"><input type="radio" name="dts-q29-r5" data-bz-retained="dts-q29-r5" value="0" /></td>
          </tr>
          <tr>
            <td>How might we create a cone to eat ice cream without dripping? </td>
            <td class="incorrect"><input type="radio" name="dts-q29-r6" data-bz-retained="dts-q29-r6" value="2" /></td>
            <td class="incorrect"><input type="radio" name="dts-q29-r6" data-bz-retained="dts-q29-r6" value="1" /></td>
            <td class="correct"><input type="radio" name="dts-q29-r6" data-bz-retained="dts-q29-r6" value="0" /></td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-29" />
      </p>     
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>Going back to Martin, if the problem statement we decide upon is <em>Martin needs to safeguard his back while in the waiting room because he has a severe herniated disc</em>, what HMW question would you propose?</p>
      <p>
        <textarea data-bz-retained="dts-q30-t"></textarea>
      </p>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-30" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">Answer</h5>
      <p>Some possibilities are:</p>
      <ul>
        <li>HMW provide more comfortable seating in the waiting room?</li>
        <li>HMW accommodate various modes of <span class="bz-has-tooltip" title="relating to or designed for efficiency and comfort">ergonomically</span>-friendly waiting (not just sitting)?</li>
      </ul>
    </div>
    <h4>Ideate</h4>
    <div class="bz-box video">
      <h4 class="box-title">Watch this</h4>
      <figure>
        <iframe src="https://www.youtube.com/embed/rLYq4DnSgz0?rel=0" allowfullscreen></iframe>
        <figcaption>
          The main tool for ideation is brainstorming. Watch this video of a team brainstorming. Once you get an idea of what is going on, move to the next question.
          <span class="media-duration">8:19</span>
          <span class="media-instructions">(mostly inaudible dialog)</span>
          <p class="screenreader-only">The video shows a person standing in the middle of a group. She is the scribe, writing on post-it notes all the ideas that people around her are coming up with. Then she sticks the notes randomly on a board for everyone to see. Most of the time people take turns coming up with ideas, in "popcorn" style. The atmosphere is energetic and people seem to enjoy coming up with all kinds of crazy ideas at a quick pace. No one is critiquing or judging any of the ideas. Every suggestion is posted.</p>
        </figcaption>
      </figure>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-31" />
      </p> 
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>Now that you've seen brainstorming in action, what do you think are the rules of brainstorming? (check all that apply)</p>
      <ul class="checklist">
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q31-01" />Defer judgment (just put it up on the board)</li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q31-02" />Go for quantity</li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q31-03" />One conversation at a time</li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q31-04" />Stay at headline level (jot down just a few words or a picture to capture the idea) </li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q31-05" />Build on the ideas of others</li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q31-06" />Stay on topic </li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q31-07" />Encourage wild ideas </li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q31-08" />Limit yourself to only what is feasible </li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q31-09" />Work independently </li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q31-10" />Only share fully-baked ideas </li>
      </ul>
      <p>
        <input class="bz-toggle-all-next for-checklist" type="button" value="Done" data-bz-retained="dts-btn-31b" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">How to brainstorm like a pro</h5>
      <p>Here is the general procedure for brainstorming:</p>
      <ul>
        <li>Pick one "how might we" question to start with.</li>
        <li>Invest energy in a short period of time, like 15 to 30 minutes of high engagement, or rapid 5 minute bursts.</li>
        <li>Capture ideas by selecting a scribe to record ALL ideas for all to see, or have each person write down and share his/her ideas as they come up.</li>
        <li>Shoot for as many ideas as you can in a limited amount of time. For example, aim for 50 ideas in 20 minutes. In brainstorming, quantity matters more than quality, and this is a way to force your team to focus on quantity.</li>
        <li>When idea generation slows down, move to another round of brainstorming by considering another "how might we" or adding a constraint. Constraints usually start with "What if..." and create boundaries, which leads to more ideas you might not have thought of otherwise.</li>

      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-31b" />
      </p>     
    </div>
    <div class="bz-box action">
      <h5 class="box-title">Let's practice a bit of brainstorming</h5>
      <p>Here's a snapshot taken in the first minute of a brainstorm for: "How might we accommodate various modes of <span class="bz-has-tooltip" title="relating to or designed for efficiency and comfort">ergonomically</span>-friendly waiting?"</p>
      <p class="tbd">INSERT IMAGE</p>
      <p>What 3 ideas would you add to this brainstorm?</p>
      <ol class="dont-mix">
        <li><textarea data-bz-retained="dts-q32-t1" ></textarea></li>
        <li><textarea data-bz-retained="dts-q32-t1" ></textarea></li>
        <li><textarea data-bz-retained="dts-q32-t1" ></textarea></li>
      </ol>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-32" />
      </p>     
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>You can't always prototype <em>all</em> the ideas you've generated through brainstroming.</p>
      <p>The wilder ideas usually serve to open new creative directions, but prototyping them might be a waste of resources. Other ideas might not seem promising enough even if they are feasible.</p>
      <p>The following are helpful methods for narrowing down the list after brainstorming is over. Match the method description to its title:</p>
      <table class="sort-to-match">
        <tbody>
          <tr>
            <th>
              Vote
            </th>
            <td>
              Each team member gets to "star" about three ideas that he or she is attracted to. All team members to have a voice in this process. The highest rated ideas move on to the prototype stage.
            </td>
          </tr>
          <tr>
            <th>
              Merge and extract
            </th>
            <td>
              Create clusters of ideas that might work together well as prototypes, combine conceptually similar ideas (e.g.: "these ideas are all about making a better chair, and those are all about waiting while standing"), and try to pull out features or themes as <span class="bz-has-tooltip" title="Higher-order ideas">meta-ideas</span>.
            </td>
          </tr>
          <tr>
            <th>
              Sort by abstractness
            </th>
            <td>
              Groups ideas or sort them along a continuum from <em>the rational choice</em> through <em>most likely to delight</em> and all the way <em>the long shot</em>. Then choose one or two ideas from each of these groups, to ensure you're innovating and not just prototyping the most expected ideas.
            </td>
          </tr>
          <tr>
            <th>
              Sort by medium/tools
            </th>
            <td>
              Choose ideas that inspire you to prototype in different form factors or using different processes: a physical prototype, a digital prototype, an experience prototype, etc. Choose at least one idea for each.
            </td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next for-match" type="button" value="Done" data-bz-retained="dts-btn-33" />
      </p>     
    </div>
    <div class="bz-box key">
      <h5 class="box-title">Keep in mind</h5>
      <p>Try not to select only the most feasible solutions. If you feel an idea has strong potential you can always try to brainstorm questions such as "HMW reduce the cost?", "HMW simplify this further?"</p>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-34" />
      </p>     
    </div>
    <blockquote>"I made 5,127 prototypes of my vaccum[-cleaner] before I got it right. There were 5,126 failures. But I learned from each one. That's how I came up with a solution."<p class="quote-source">James Dyson</p></blockquote>
    <h4>Prototype</h4>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>Here are some examples of prototypes.</p>
      <table class="equal-column-widths">
        <tbody>
          <tr>
            <td>
              <p class="tbd">INSERT IMAGE 1</p>
            </td>
            <td>
              <p class="tbd">INSERT IMAGE 2</p>
            </td>
          </tr>
          <tr>
            <td>
              <p class="tbd">INSERT IMAGE 3</p>
            </td>
            <td>
              <p class="tbd">INSERT IMAGE 4</p>
            </td>
          </tr>
        </tbody>
      </table>
      <p>Seeing these examples, what is true of prototypes? (select all that apply)</p>
      <ul class="checklist instant-feedback">
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q35-1" />They take physical or digital form </li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q35-2" />Users can interact with them </li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q35-3" />They're rough; they're not perfect </li>
        <li class="correct"><input type="checkbox" data-bz-retained="dts-q35-4" />They allow you to test your solutions with users </li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q35-5" />You explain your idea for a prototype to users </li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q35-6" />They're polished </li>
        <li class="incorrect"><input type="checkbox" data-bz-retained="dts-q35-7" />They take a long time to make </li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-35" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">Why this matters</h5>
      <p>Early prototyping allows designers to fail early (and cheaply). By creating a prototype and putting it in the hands of users, designers can spot problems early. </p>
    </div>
    <div class="bz-box action">
      <h5 class="box-title">How to prototype</h5>
      <p>Let's say this is one of the ideas we chose to prototype for Martin's back pain problem in the waiting room:</p>
      <div class="bz-example">A stretching wall with an instructional poster in a dedicated area of the room</div>
      <p>How might you prototype this idea? What would you make or build?</p>
      <p>
        <textarea data-bz-retained="dts-q36-t"></textarea>
      </p>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-36" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">Some possible prototypes</h5>
      <ul>
        <li>Draw a sketch of the wall, showing the poster with stretching instructions and some accessories for stretching, such as an exercize ball and foam rollers.</li>
        <li>Put together a mockup out of cardboard or plywood and throw in some accessories, which users could interact with.</li>
        <li>Draw a floor plan to show how much space this area would take</li>
        <li>Simulate the area in an actual waiting room or in a separate space.</li>
        <li>&hellip;</li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-37" />
      </p>
    </div>
    <blockquote>Prototype as if you know you're right, and test as if you know you're wrong.</blockquote>
    <h4>Test</h4>
    <div class="bz-box read">
      <h5 class="box-title">Story Time</h5>
      <div class="bz-example">Desiree followed the Design Thinking framework to create a new product for her company. She conducted her empathy-based research, she defined the problem, brainstormed with her team, and created a prototype. She skipped the testing phase of the process, because she was confident in her prototype, and she turned her rough prototype into the final product to put in front of customers.</div>
      <p>What might happen because she skipped the testing phase?</p>
      <ul class="radio-list instant-feedback">     
        <li class="correct"><input type="radio" name="dts-q38-r" data-bz-retained="dts-q38-r" value="1" />Her prototype might not actually solve the problem, and customers may not buy the product.</li>
        <li class="incorrect"><input type="radio" name="dts-q38-r" data-bz-retained="dts-q38-r" value="2" />She won't have enough empathy-based research to define the problem.</li>
        <li class="incorrect"><input type="radio" name="dts-q38-r" data-bz-retained="dts-q38-r" value="3" />She won't know if she received a good grade.</li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-38" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">Testing is about embracing failure</h5>
      <p>Testing is a tool for learning, gradually improving, and getting to a working solution that is tried and true.</p>
      <p>There are three reasons to test your prototypes:</p>
      <ol class="dont-mix">
        <li><strong>To learn</strong> from users' experience of your prototype and inform the refine phase and the next iteration of your prototype even if it means going back to the drawing board</li>
        <li><strong>To accelerate</strong> the learning process by providing additional opportunities to learn about users often through deeper engagement and observation that yield unexpected insights</li>
        <li><strong>To uncover</strong> instances when individuals and teams failed to frame problems correctly, which may invalidate favored solutions (i.e. the proposed solution didn't solve the actual problem)</li>
      </ol>    
    </div>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>There are three steps you can follow to test your prototypes. Arrange these steps in the correct order.</p>
      <table class="sort-to-match">
        <tbody>
          <tr>
            <th>1</th>
            <td><strong>Create a testing protocol</strong>. To create your protocol, you will need to think about what methods or procedures you will use to test, what questions you will ask, and how you will gather data and keep notes. You will also consider how you will minimize bias or mistaking your experience for your users'. One way to do this is to ask your users to try out the prototype without explicit guidance and observe what they do</td>
          </tr>
          <tr>
            <th>2</th>
            <td><strong>Collect and synthesize data</strong>. Your data will reveal if your prototype was successful or not. It should help you find out what your users thought and if anything needs to be changed.</td>
          </tr>
          <tr>
            <th>3</th>
            <td><strong>Reflect on your results.</strong> Understand why your prototype succeeded or failed will help you decide what to do next. </td>
          </tr>
        </tbody>
      </table>
      <p>
        <input class="bz-toggle-all-next for-match" type="button" value="Done" data-bz-retained="dts-btn-40" />
      </p>     
    </div>
    <h4>Refine</h4>
    <div class="bz-box question">
      <h5 class="box-title">Quick Question</h5>
      <p>What is <strong>NOT</strong> true about refining your prototype?</p>
      <ul class="multi-radios">
        <li class="correct"><input type="radio" name="dts-q41-r" data-bz-retained="dts-q41-r" value="1" /> Refine is the last step in the Design Thinking process.<p class="feedback inline">Correct. Refine is not necessarily the last step in the Design Thinking process, since it may take you back to redefining the problem or testing another version of your prototype.</p></li>
        <li class="incorrect"><input type="radio" name="dts-q41-r" data-bz-retained="dts-q41-r" value="2" /> You need to refine your prototype - and possibly over and over - to get a solid working solution.<p class="feedback inline">This is true about refining your prototype.</p></li>
        <li class="incorrect"><input type="radio" name="dts-q41-r" data-bz-retained="dts-q41-r" value="3" /> Refine is the step in the Design Thinking process where you take what you learned from testing and from user feedback and improve upon your solution.<p class="feedback inline">This is true about refining your prototype.</p></li>
      </ul>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-41" />
      </p>     
    </div>
    <div class="bz-box action">
      <h5 class="box-title">Let's give refining a quick try</h5>
      <div class="bz-example">In the testing phase, we got feedback back from Martin that he didn't necessarily need a large stretching area or an exercise ball or a foam roller. He said that it would be sufficient to have a wall with enough space to stand and do some standing stretches. Hanging a poster about stretches would be helpful to indicate to people that it was a stretching area, so people wouldn't wonder what he was doing. But the suggested stretches illustrated on the poster would have to be pretty universal and easy to understand. And while back stretches would help him, it wouldn't meet everyone's needs so we might want to provide a variety of stretches, or just leave it to users to look up stretches on their smartphones.</div>
      <p>Based on Martin's feedback, what would you do next?</p>
      <p>
        <textarea data-bz-retained="dts-q42-t"></textarea>
      </p>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-42" />
      </p>     
    </div>
    <div class="bz-box answer">
      <h5 class="box-title">Some possible next steps are:</h5>
      <ol>
        <li>Ditch the more elaborate prototypes. This is good news because it would be less expensive to execute a simpler solution.</li>
        <li>Further develop the initial prototype of a stretching wall by getting into the details: specify the amount of space needed, visual cues to direct attention to the wall, location and style of the instructional poster, what stretches the poster would include, how other proposed activities might be communicated, etc.</li>
        <li>Then have Martin experience the wall again!</li>
      </ol>
      <p>
        <input class="bz-toggle-all-next" type="button" value="Done" data-bz-retained="dts-btn-43" />
      </p>     
    </div>

    <h2 id="wrap-up">Wrap-up</h2>
    <div>
        <p>In this module we looked at problem-solving, a skill that's highly valued in the workplace. Then we explored a specific problem-solving framework called Design Thinking, which is optimized for coming up with ideas for new or improved products, services, and experiences.</p>
        <p>Then we went over the six steps of the Design Thinking process:</p>
        <ol>
            <li><strong>Empathize</strong> &mdash; We went over why you have to get a good snese of who the user(s) are and what their current experience is. You can use an Empathy Map to explore what they're thinking, feeling, doing, and saying. We also looked at what kinds of questions work best to mine users for helpful insights on the problems they're facing:
              <ul>
                <li>Open-ended</li>
                <li>Non-biased</li>
                <li>Aiming to uncover needs/wants/frustrations</li>
              </ul>
            </li>
            <li><strong>Define</strong> &mdash; We saw that the <em>presenting problem</em> ("I have a headache") is hardly ever the <em>root problem</em> ("My vision is blurry, which strains my eyes, which causes headaches"). Getting the problem definition right is a must for actually coming up with an effective solution (presecription glasses) rather than a superficial fix (painkillers). We practiced using the Problem Statement template ("[<em>User</em>] needs to [<em>user need</em>] because [<em>surprising insight</em>]") to help focus your work and lead to promising How Might We (HMW) questions.</li>
            <li><strong>Ideate</strong> &mdash; We looked at the brainstorming method of ideation and listed some best practices to get the most out of it:
              <ul>
                <li>Defer judgment </li>
                <li>Go for quantity </li>
                <li>One conversation at a time</li>
                <li>Headline (jot down just a few words or a picture to capture the idea) </li>
                <li>Build on the ideas of others</li>
                <li>Stay on topic </li>
                <li>Encourage wild ideas </li>
              </ul>
            <p>We also considered several methods to narrow down the list of ideas once you're done brainstorming:</p>
              <ul>
                <li>Vote (each team member "stars" about three favorite ideas)</li>
                <li>Merge and Extract (combine ideas that can work together, find overarching themes)</li>
                <li>Sort by abstractness (and make sure to keep wild ideas in the running)</li>
                <li>Sort by medium/tools</li>
              </ul>
            </li>
            <li><strong>Prototype</strong> &mdash; We looked at the most important practices in prototyping:
              <ul>
                <li>Use it to "fail early" &mdash; to quickly see what works and what doesn't</li>
                <li>Make something people can interact with or at least visualize</li>
                <li>Use any medium or tools that gets you "quick and dirty" prototypes you can test and evaluate</li>
              </ul>
            </li>
            <li><strong>Test</strong> &mdash; We looked at why we test and how to do it (create a protocol, collect data, reflect to understand)</li>
            <li><strong>Refine</strong> &mdash; We took a quick look at what refining looks like, and noted that it's not always the end of the process, but could lead to redefining the problem or building new prototypes for testing.</li>
        </ol>
        <h3>Next Steps:</h3>
        <ul>
            <li>Make sure you submit your <a href="#" class="tbd">Hustle to Career Project</a> before Learning Lab this week!</li>
            <li>You also should have completed your first 1:1 coaching conversation with your LC by this point.</li>
        </ul>
    </div>
</div>
<script src="../new-ui-sandbox.js"></script>
<progress max="100" id="bz-progress-bar" value="14"></progress>
</body>
</html>