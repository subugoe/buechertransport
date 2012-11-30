<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
		$_EXTKEY,
		'Buechertransport',
		array(
			'Province' => 'list, show, showReachables, showMap',
			
		),
		// non-cacheable actions
		array(
			'Province' => 'create, update, delete',
			'City' => 'create, update, delete',
			'Library' => 'create, update, delete',
			
		)
);

Tx_Extbase_Utility_Extension::configurePlugin(
		$_EXTKEY,
		'Scheduler',
		array(
			'Province' => 'import, create, update, delete',
			'City' => 'create, update, delete',
			'Library' => 'create, update, delete'
		)
);

// Extbase-Scheduler for importing existing data
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Tx_Buechertransport_Command_ImportCommandController';

// Hooks
$TYPO3_CONF_VARS['EXTCONF']['nkwsubmenu']['extendTOC'][$_EXTKEY] = 'EXT:'.$_EXTKEY.'/Classes/Utility/SidebarUtility.php:Tx_Buechertransport_Utility_SidebarUtility->hookFunc';
// $TYPO3_CONF_VARS['EXTCONF']['nkwsubmenu']['addImages'][$_EXTKEY] = 'EXT:'.$_EXTKEY.'/pi1/class.tx_patenschaften_pi1.php:tx_patenschaften_pi1->hookPicFunc';

?>