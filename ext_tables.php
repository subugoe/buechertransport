<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Buechertransport',
	'Büchertransport'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Büchertransportdienst');

			t3lib_extMgm::addLLrefForTCAdescr('tx_buechertransport_domain_model_province', 'EXT:buechertransport/Resources/Private/Language/locallang_csh_tx_buechertransport_domain_model_province.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_buechertransport_domain_model_province');
			$TCA['tx_buechertransport_domain_model_province'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:buechertransport/Resources/Private/Language/locallang_db.xml:tx_buechertransport_domain_model_province',
					'label' => 'name',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Province.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_buechertransport_domain_model_province.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_buechertransport_domain_model_city', 'EXT:buechertransport/Resources/Private/Language/locallang_csh_tx_buechertransport_domain_model_city.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_buechertransport_domain_model_city');
			$TCA['tx_buechertransport_domain_model_city'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:buechertransport/Resources/Private/Language/locallang_db.xml:tx_buechertransport_domain_model_city',
					'label' => 'name',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/City.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_buechertransport_domain_model_city.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_buechertransport_domain_model_library', 'EXT:buechertransport/Resources/Private/Language/locallang_csh_tx_buechertransport_domain_model_library.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_buechertransport_domain_model_library');
			$TCA['tx_buechertransport_domain_model_library'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:buechertransport/Resources/Private/Language/locallang_db.xml:tx_buechertransport_domain_model_library',
					'label' => 'name',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Library.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_buechertransport_domain_model_library.gif'
				),
			);

?>