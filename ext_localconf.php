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


// Scheduler for importing existing data
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Tx_Buechertransport_Service_ImportTask'] = array(
	'extension' => $_EXTKEY,
	'title' => '(Alt-)Daten importieren',
	'description' => '(Alte) Daten ins Repository importieren'
);

	/* not correctly working solution for cli_mode (scheduler) */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Tx_Buechertransport_Command_ImportCommandController';

?>