<?php 
/* Functions for generating module html */

/* some global variables */
/* =============== */
$namespace;
$hlevel=2; 
$boxcounter = 1;
$for;

/* Generate opening tag and intro for a bz-box */
/* ==============================*/
function openbox($btype = 'question', $bintro = '', $btitle) {
  // Default titles per $type: 
  if (!$btitle) switch ($btype) {
    case 'question':
    $btitle = 'Quick Question';
    break;
    case 'answer':
    $btitle = 'Answer';break;
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
    $btitle = '';
  }

	// Open the box:
  echo '<div class="bz-box '.$btype.'">';
  echo '  <h'.$GLOBALS['hlevel'].' class="box-title">'.$btitle.'</h'.$GLOBALS['hlevel'].'>';
  echo '  <p>'.$bintro.'</p>';
  // Reset "for-" for "done" button interactivity:
	/*  (e.g. "for-checklist" may be set by makecrlist(), 
      but we don't want previous box's interaction to apply here )  */
    $GLOBALS['for'] = '';
  }

  function closebox() {
		// Generate a "done" button:
    echo '  <p><input class="bz-toggle-all-next '.$GLOBALS['for'].'" type="button" value="Done" data-bz-retained="'.$GLOBALS['module'].'-btn-'.$GLOBALS['boxcounter'].'" /></p>';
		// Increment box counter for naming data-bz-retained fields etc.:
    $GLOBALS['boxcounter']++;
		// Close the div:
    echo '</div>';
  }

  function makecrlist($items, $type, $instant = 'instant-feedback') {
    $inputtype = ($type == 'checklist') ? 'checkbox' : 'radio';
      if ( null == $instant ) {
        $GLOBALS['for'] = 'for-'.$type;
      }
    echo '<ul class="' . $type . ' ' . $instant . '">';

    foreach ($items as $key => $item) {
      if ($item['feedback']) {
        $item['feedback'] = '<p class="feedback inline">'.$item['feedback'].'</p>';
      }
      $itemname = $GLOBALS['module'].'-q'.$GLOBALS['boxcounter'];
      $itemname = ( 'checklist' == $type ) ? $itemname.'-'.$key : $itemname;
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
  ?>