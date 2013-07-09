<?php
/**
 * Javascript Slideshow
 * Javascript Slideshow Hooks
 *
 * @author 		@See $wgExtensionCredits
 * @license		GPL
 * @package		FormatNum
 * @addtogroup  Extensions
 * @link		http://www.mediawiki.org/wiki/Extension:FormatNum
 *
 **/

class UservoiceHooks {
	/**
	 * Setup parser function
	 * @param parser from mediawiki
	 * @return must return true for next prasers
	 **/
	public static function setupUservoice( OutputPage &$out, Skin &$skin ) {
	   $script = UservoiceHooks::addUservoice();
       $out->addScript( $script );
       return true;
	}
    public static function addUservoice () {
        global $wgUservoiceKey, $wgUservoiceMode, $wgUservoicePrimColor, $wgUservoiceLinkColor, $wgUservoiceDefaultMode, $wgUservoiceID, $wgUservoiceLabel, $wgUservoiceTabColor, $wgUservoicePosition;
        
        $allowedValues = array(
        'mode'        => array('full','feedback','support'),
        'defaultmode' => array('feedback','support'),
        'position'    => array('top-left', 'top-right', 'middle-left', 'middle-right', 'bottom-left', 'bottom-right'),
        );
        
        if (empty($wgUservoicMode)) {
            $wgUservoiceMode = 'full';
        }
        else {
            if(!in_array($wgUservoiceMode, $allowedValues['mode'])) {
                echo 'value: ' . $wgUservoiceMode . ' not allowed';
            }
        }
        if (empty($wgUservoiceDefaultMode)) {
            $wgUservoiceDefaultMode = 'feedback';
        }
        else {
            if(!in_array($wgUservoiceDefaultMode, $allowedValues['defaultmode'])) {
                echo 'value: ' . $wgUservoiceDefaultMode . ' not allowed';
            }
        }
        if (empty($wgUservoicePosition)) {
            $wgUservoicePosition = 'middle-right';
        }
        else {
            if(!in_array($wgUservoicePosition, $allowedValues['position'])) {
                echo 'value: ' . $wgUservoicePosition . ' not allowed';
            }
        }
        
        $html = "<!-- UserVoice JavaScript SDK (only needed once on a page) -->
<script>(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/".$wgUservoiceKey.".js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()</script>
<!-- A tab to launch the Classic Widget -->
<script>
UserVoice = window.UserVoice || [];
UserVoice.push(['showTab', 'classic_widget', {
  mode: '".$wgUservoiceMode."',
  primary_color: '".$wgUservoicePrimColor."',
  link_color: '".$wgUservoiceLinkColor."',";
  if ($wgUservoiceMode === 'full') {
    $html .= "default_mode: '" . $wgUservoiceDefaultMode . "',";
  }
  $html .= "forum_id: ".$wgUservoiceID.",
  tab_label: '".$wgUservoiceLabel."',
  tab_color: '".$wgUservoiceTabColor."',
  tab_position: '".$wgUservoicePosition."',
  tab_inverted: false
}]);
</script>";
        return $html;
    }
}
