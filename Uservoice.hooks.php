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
        $html = <<<USERVOICE
    <!-- UserVoice JavaScript SDK (only needed once on a page) -->
<script>(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/{$wgUservoiceKey}.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()</script>

<!-- A tab to launch the Classic Widget -->
<script>
UserVoice = window.UserVoice || [];
UserVoice.push(['showTab', 'classic_widget', {
  mode: '{$wgUservoiceMode}',
  primary_color: '{$wgUservoicePrimColor}',
  link_color: '{$wgUservoiceLinkColor}',
  default_mode: '{$wgUservoiceDefaultMode}',
  forum_id: {$wgUservoiceID},
  tab_label: '{$wgUservoiceLabel}',
  tab_color: '{$wgUservoiceTabColor}',
  tab_position: '{$wgUservoicePosition}',
  tab_inverted: false
}]);
</script>
USERVOICE;
        return $html;
    }
}
