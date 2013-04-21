<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'SUB.' . $_EXTKEY,
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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'SUB.' . $_EXTKEY,
	'Scheduler',
	array(
		'Province' => 'import, geocode, create, update, delete',
		'City' => 'create, update, delete',
		'Library' => 'create, update, delete'
	)
);

// Extbase-Scheduler for importing existing data
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Tx_Buechertransport_Command_ImportCommandController';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Tx_Buechertransport_Command_GeocodeCommandController';

// Hooks
$TYPO3_CONF_VARS['EXTCONF']['nkwsubmenu']['extendTOC'][$_EXTKEY] = 'EXT:SUB.'.$_EXTKEY.'/Classes/Utility/SidebarUtility.php:SUB\Buechertransport\Utility\SidebarUtility->hookFunc';

// EID
$TYPO3_CONF_VARS['FE']['eID_include'][$_EXTKEY] = 'EXT:' . $_EXTKEY . '/Resources/Public/eId/maps.php';

// Deactivating Extbase Reflection Cache (only for Development!!!)
$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase_reflection']['backend'] = 't3lib_cache_backend_NullBackend';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase_object']['backend'] = 't3lib_cache_backend_NullBackend';

?>