<?php
namespace SUB\Buechertransport\Command;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Dominic Simm <simm@sub.uni-goettingen.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Geocoding for the (old) buechertransport data
 *
 * @author Dominic Simm <simm@sub.uni-goettingen.de>
 * @package buechertransport
 * @subpackage command
 */

/**
 * Command Controller with the import command; reads the (old) CSV-data and puts it into the database / repositories
 */
class GeocodeCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController {
 
	/**
	* Geocoder command
	*
	* Adds to all provinces and cities their geo-coordinates via Google Maps API
	* @param string $cmd Command to be executed [run, ...]
	* @return boolean
	*/
	public function GeocodeCommand($cmd) {
		t3lib_div::devLog('Geocode-Task: Successful scheduler call.' , 'buechertransport', -1);
		$success = false;

		$this->setupFramework();
		// Control the configuration [CONFIGURATION_TYPE_FRAMEWORK, CONFIGURATION_TYPE_SETTINGS, CONFIGURATION_TYPE_FULL_TYPOSCRIPT]
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		t3lib_div::devLog('Geocode-Task: Got ExtbaseFrameworkConfiguration.' , 'buechertransport', -1, $extbaseFrameworkConfiguration);

		$this->initRepositories();
		t3lib_div::devLog('Geocode-Task: Repositories initialized.' , 'buechertransport', -1);

		$provinceObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('SUB\\Buechertransport\\Controller\\ProvinceController');
		t3lib_div::devLog('Geocode-Task: ProvinceController instantiated.' , 'buechertransport', -1);

		// $success = $provinceObj->geocodeCityAction($this);
		// $success = $provinceObj->geocodeProvinceAction($this);
		$success = true;
		if (!$success) {
			t3lib_div::devLog('Buechertransport::Geocode-Task: Problem during execution. Stopping.' , 'buechertransport', 3);
		}

		return $success;
	}

	protected function setupFramework()     {
		$this->configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
		t3lib_div::devLog('Geocode-Task: Configuration-Manager instantiated.' , 'buechertransport', -1);
		$configuration = array(
			'extensionName' => 'buechertransport',
			'pluginName' => 'Scheduler',
			'settings' => '< plugin.tx_buechertransport',
			'controller' => 'Province',
			'switchableControllerActions' => array(
				 'Province' => array('actions' => 'import, create, update, delete'),
				 'City' => array('actions' => 'create, update, delete'),
				 'Library' => array('actions' => 'create, update, delete')
   			),
			'persistence' => array(
				'storagePid' => 1800
			)
		);
		$this->configurationManager->setConfiguration($configuration); 
	}

	protected function initRepositories() {
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\PersistenceManager');
		$this->provinceRepository = $this->objectManager->get('SUB\\Buechertransport\\Domain\\Repository\\ProvinceRepository');
		$this->cityRepository = $this->objectManager->get('SUB\\Buechertransport\\Domain\\Repository\\CityRepository');
		$this->libraryRepository = $this->objectManager->get('SUB\\Buechertransport\\Domain\\Repository\\LibraryRepository');
	}
   
}

?>
