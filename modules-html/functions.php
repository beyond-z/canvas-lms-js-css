<?php 
/* Functions for generating module html */

/* Init some global variables */
/* ========================== */

$hlevel=3; 
$boxcounter = 1;
$for;
$innercounter = 0;

// Get namespace from the module's file:
try {
  $GLOBALS['namespace'] = $ns;
} catch (Exception $e) {
  echo 'Oops, looks like $ns namespace is not defined in the module php!';
  echo $e->getMessage();
}


/* Generate opening tag and intro for a bz-box */
/* ============================================*/
function bz_open_box($btype = 'question', $bintro = '', $btitle) {
  // Default titles per $type: 
  if (!$btitle) switch ($btype) {
    case 'question':
      $btitle = 'Quick Question';
      break;
    case 'answer':
      $btitle = 'Answer';
      break;
    case 'video':
      $btitle = 'Watch This';
      break;
    case 'read':
      $btitle = 'Story Time';
      break;
    case 'reflection':
      $btitle = 'Get to know yourself';
      break;
    case 'action':
      $btitle = 'Take a real step right now';
      break;
    case 'pulse':
      $btitle = 'Pulse Check';
      break;
    default: 
      $btitle = '&nbsp;';
  }

	// Open the box:
  echo '<div class="bz-box '.$btype.'">';
  echo '  <h'.$GLOBALS['hlevel'].' class="box-title">'.$btitle.'</h'.$GLOBALS['hlevel'].'>';
  echo '  <p>'.$bintro.'</p>';
  // Reset "for-" for "done" button interactivity:
	/*  (e.g. "for-checklist" may be set by bz_make_cr_list(), 
      but we don't want previous box's interaction to apply here )  */
  $GLOBALS['for'] = '';
  // Reset inner box counter used for numbering multiple fields in one box:
  $GLOBALS['innercounter'] = 1;
}

/* Generate Done button and closing tag for a bz-box */
/* ==================================================*/

function bz_close_box($addbutton = true) {
	// Generate a "done" button:
  if ($addbutton) echo '  <p><input class="bz-toggle-all-next '.$GLOBALS['for'].'" type="button" value="Done" data-bz-retained="'.$GLOBALS['namespace'].'-btn-'.$GLOBALS['boxcounter'].'" /></p>';
	// Increment box counter for naming data-bz-retained fields etc.:
  $GLOBALS['boxcounter']++;
  $GLOBALS['innercounter'] = 0;
	// Close the div:
  echo '</div>';
}

/* Generate a sequential ID for a field */
/* ==================================== */
function bz_make_id($hold = null) {
  // Increment, unless we don't want to (e.g. for radios that share a name)
  if(!$hold) 
    $GLOBALS['innercounter']++;
  $itemname = $GLOBALS['namespace'].'-q'.$GLOBALS['boxcounter'].'-'.$GLOBALS['innercounter'];
  return $itemname;
}

/* Generate a checklist or radio-list */
/* ===================================*/

/* $items looks like this:
  $items = array(
    array(
      'correctness' => 'correct',
      'content' => '',
      'feedback' => ''
    ),
  );
*/
function bz_make_cr_list($items, $type = 'checklist', $instant = 'instant-feedback', $addlclasses = '') {
  $GLOBALS['innercounter']++;
  $inputtype = ($type == 'checklist') ? 'checkbox' : 'radio';
    if ( null == $instant ) {
      $GLOBALS['for'] = 'for-'.$type;
    }
  echo '<ul class="' . $type . ' ' . $instant . ' ' . $addlclasses . '">';

  foreach ($items as $key => $item) {
    if ($item['feedback']) {
      $item['feedback'] = '<p class="feedback inline">'.$item['feedback'].'</p>';
    }
    $itemname = ( 'checklist' == $type ) ? bz_make_id() : bz_make_id('hold');
    echo  '<li class="'
    . $item['correctness']
    .'"><input type="'.$inputtype
    .'" data-bz-retained="'.$itemname.'" name="'.$itemname
    .'" value="option'.$key.'" />'
    .$item['content']
    .$item['feedback']
    .'</li>';
  }
  echo '</ul>';
}

function bz_make_textarea($args){
  $GLOBALS['innercounter']++;
  /*
  $args = array (
    'optional' => false,
    'other' => false,
  );
  */
  $itemname = bz_make_id();
  $optionalclass = ($args['optional']) ? ' bz-optional-magic-field ' : '';
  $otherclass = ($args['other']) ? ' checklist-other ' : '';
  if ($args['other']) {
    echo '<input class="bz-optional-magic-field" type="checkbox" data-bz-retained="'.$itemname.'-other" />';
    echo '  <strong>Other:</strong><br />';
  }
  echo '<textarea data-bz-retained="'.$itemname.'-t" class="'.$optionalclass.$otherclass.'"></textarea>';
}


function bz_make_multi_radios($items, $cats = array(1 => 'Poor',2 => 'Below average',3 => 'Averge',4 => 'Above average',5 => 'Excellent',), $instant = 'instant-feedback' ) {
  $GLOBALS['innercounter']++;
  $itemname = bz_make_id();
  echo '<table class="multi-radios '.$instant.'">';
  echo '  <thead>';
  echo '    <tr><th>&nbsp;</th>';
      foreach($cats as $rank => $caption) {
        $thcontent = (!empty($caption)) ? '<span class="bz-has-tooltip" title="'.$caption.'">'.$rank.'</span>' : $rank;
        echo '<th>'.$thcontent.'</th>';
      }
  echo '    </tr>';
  foreach ($items as $key => $item) {
    $itemcontent = (is_array($item)) ? $item['content'] : $item;
    echo '<tr>';
    echo '<td>'.$itemcontent.'</td>';
    foreach ($cats as $catkey => $cat) {
      $answerclass = ($catkey == $item['answer']) ? ' class="correct"' : ' class="incorrect"';
      echo '<td'.$answerclass.'><input type="radio" data-bz-retained="'.$itemname.'-'.$key.'" name="'.$itemname.'-'.$key.'" value="'.$catkey.'" /></td>';
    }
    echo '</tr>';
  }
  echo '  </thead>';
  echo '</table>';
}

function bz_make_instant_range_table($items){
  $GLOBALS['innercounter']++;
  ?>
  <table class="no-zebra instant-range-feedback" style="table-layout: fixed;">
    <tbody>

      <?php
      foreach($items as $key => $item) {
        ?>
          <tr>
            <td style="font-size: 0.8em; text-align: center; width: 58%;">&nbsp;</td>
            <td style="font-size: 0.8em; text-align: center; width: 7%;">n/a</td>
            <td style="font-size: 0.8em; text-align: center; width: 7%;">1</td>
            <td style="font-size: 0.8em; text-align: center; width: 7%;">2</td>
            <td style="font-size: 0.8em; text-align: center; width: 7%;">3</td>
            <td style="font-size: 0.8em; text-align: center; width: 7%;">4</td>
            <td style="font-size: 0.8em; text-align: center; width: 7%;">5</td>
          </tr>
          <tr class="inputs-row">
            <td><?php echo $item[0];?></td>
            <td colspan="6">
              <input max="5" min="0" step="1" type="range" value="0" data-bz-retained="<?php $GLOBALS['innercounter']++; echo bz_make_id(); ?>" />
              <div class="display-value"><span class="current-value">&nbsp;</span></div>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <div class="feedback" data-bz-range-flr="0" data-bz-range-clg="3"><p><?php echo $item[1];?></p></div>
              <div class="feedback" data-bz-range-flr="3" data-bz-range-clg="5"></div>
            </td>
          </tr>
        <?php 
      } ?>

    </tbody>
  </table>
  <?php
}

function bz_embed_video($source, $videoid, $duration, $caption, $transcript, $instructions) {
  $src;
  switch ($source) {
    case 'youtube':
    case 'yt':
      $src = 'https://www.youtube.com/embed/';
      $videoid = $videoid . '?rel=0';
      break;
    case 'vimeo':
    case 'vm':
      $src = 'https://player.vimeo.com/video/';
      break;
    default:
      $src = $source;
      break;
  }

  ?>
    <figure>
      <iframe src="<?php echo $src . $videoid; ?>" allowfullscreen="allowfullscreen"></iframe>
      <figcaption><?php echo $caption; ?><span class="media-duration"><?php echo $duration; ?></span>
        <?php if($instructions) { ?>
          <div class="media-instructions">
            <?php echo $instructions; ?>
          </div>
        <?php } ?>
        <?php if($transcript) { ?>
          <div class="transcript">
            <?php echo $transcript; ?>
          </div>
        <?php } ?>
      </figcaption>
    </figure>
  <?php 
}

function bz_make_match_table($items, $headings, $addlclasses){
  echo '<table class="sort-to-match '. $addlclasses .'">';
    if (!empty($headings)) {
      echo '<thead><tr>';
      foreach ($headings as $heading) {
        echo '<th>'.$heading.'</th>';
      }
      echo '</tr></thead>';
    }
    echo '<tbody>';
    foreach ($items as $item) {
      echo '<tr>';
      foreach ($item as $cell) {
        echo '<td>'.$cell.'</td>';
      }
      echo '</tr>';
    }
    echo '</tbody>';
  echo '</table>';
  $GLOBALS['for'] = 'for-match';
}

?>
