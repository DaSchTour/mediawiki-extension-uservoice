<?php
/** 
* @addtogroup Extensions 
*/
// Check environment
if ( !defined( 'MEDIAWIKI' ) ) {
	echo( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
	die( -1 );
}

/* Configuration */

// Credits
$wgExtensionCredits['other'][] = array (
	'path'=> __FILE__ ,
	'name'=>'Uservoice',
	'url'=>'https://github.com/DaSchTour/mediawiki-extension-uservoice',
	'description'=>'Adding uservoice.',
//	'descriptionmsg' => 'uservoice-desc',
	'author'=>'[http://www.daschmedia.de DaSch]',
	'version'=>'0.9.1',
);

$dir = dirname( __FILE__ ) . '/';

//$wgExtensionMessagesFiles['Uservoice']      = $dir . 'Uservoice.i18n.php';
//$wgExtensionMessagesFiles['UservoiceAlias'] = $dir . 'Uservoice.alias.php';

$wgAutoloadClasses[ 'UservoiceHooks' ]    = $dir . 'Uservoice.hooks.php';
$wgHooks['BeforePageDisplay'][] = 'UservoiceHooks::setupUservoice';
