<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
		$_EXTKEY,
		'Buechertransport',
		array(
			'Province' => 'list, show',
			
		),
		// non-cacheable actions
		array(
			'Province' => 'show, create, update, delete',
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

?>