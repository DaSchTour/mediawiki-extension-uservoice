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
        global $wgUservoiceVersion , $wgUservoiceKey, $wgUservoiceMode, $wgUservoicePrimColor, $wgUservoiceLinkColor, $wgUservoiceDefaultMode, $wgUservoiceID, $wgUservoiceLabel, $wgUservoiceTabColor, $wgUservoicePosition;
        
        if (empty($wgUservoiceVersion)) {
            $wgUservoiceVersion = 'new';
        }
        else {
        	if($wgUservoiceVersion != 'new' && $wgUservoiceVersion != 'old') {
        		echo 'value: ' . $wgUservoiceVersion . ' not allowed. Use "new" or "old".';
        	}
        }
        
        if ($wgUservoiceVersion == 'old') {
        
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
		}
		if ($wgUservoiceVersion == 'new') {
        
        $allowedValues = array(
        'mode'        => array('full','feedback','support'),
        'defaultmode' => array('feedback','support'),
        'position'    => array('top-left', 'top-right', 'bottom-left', 'bottom-right'),
        );
        
        if (empty($wgUservoicePosition)) {
            $wgUservoicePosition = 'top-right';
        }
        else {
            if(!in_array($wgUservoicePosition, $allowedValues['position'])) {
                echo 'value: ' . $wgUservoicePosition . ' not allowed';
            }
        }
        
		$html = "<script>
// Include the UserVoice JavaScript SDK (only needed once on a page)
UserVoice=window.UserVoice||[];(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/".$wgUservoiceKey.".js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})();

//
// UserVoice Javascript SDK developer documentation:
// https://www.uservoice.com/o/javascript-sdk
//

// Set colors
UserVoice.push(['set', {
  accent_color: '#448dd6',
  trigger_color: 'white',
  trigger_background_color: 'rgba(46, 49, 51, 0.6)'
}]);

// Identify the user and pass traits
// To enable, replace sample data with actual user traits and uncomment the line
UserVoice.push(['identify', {
  //email:      'john.doe@example.com', // User’s email address
  //name:       'John Doe', // User’s real name
  //created_at: 1364406966, // Unix timestamp for the date the user signed up
  //id:         123, // Optional: Unique id of the user (if set, this should not change)
  //type:       'Owner', // Optional: segment your users by type
  //account: {
  //  id:           123, // Optional: associate multiple users with a single account
  //  name:         'Acme, Co.', // Account name
  //  created_at:   1364406966, // Unix timestamp for the date the account was created
  //  monthly_rate: 9.99, // Decimal; monthly rate of the account
  //  ltv:          1495.00, // Decimal; lifetime value of the account
  //  plan:         'Enhanced' // Plan name for the account
  //}
}]);

// Add default trigger to the bottom-right corner of the window:
UserVoice.push(['addTrigger', { mode: 'satisfaction', trigger_position: '".$wgUservoicePosition."' }]);

// Or, use your own custom trigger:
//UserVoice.push(['addTrigger', '#id', { mode: 'satisfaction' }]);

// Autoprompt for Satisfaction and SmartVote (only displayed under certain conditions)
UserVoice.push(['autoprompt', {}]);
</script>";
		}
        return $html;
    }
}
