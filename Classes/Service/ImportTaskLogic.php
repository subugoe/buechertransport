<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2011 Dominic Simm <dominic.simm@sub.uni-goettingen.de>
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
 * Importer für die (Alt-)Daten
 *
 * @author Dominic Simm <dominic.simm@sub.uni-goettingen.de>
 * @package Buechertransport
 * @subpackage Service
 */
class Tx_Buechertransport_Service_ImportTaskLogic extends Tx_Extbase_Core_Bootstrap {
        
	public function execute(&$pObj) {

		// set parent task object
		$this->pObj = $pObj;

		// set this sucker up!
		$this->setupFramework();

		// initalization
		$this->initRepositories();
                
		$success = true;
		$this->importer = t3lib_div::makeInstance('tx_buechertransport_controller_provincecontroller');
		$success = $this->importer->importAction();
		if (!$success) {
			t3lib_div::devLog('Buechertransport::Import-Task: Problem during execution. Stopping.' , 'buechertransport', 3);
		}

		// $this->tearDownFramework();
                
		return $success;

	}

	protected function setupFramework()     {

		$configuration = array(
			'extensionName' => 'buechertransport',
			'pluginName' => 'Scheduler',
			'settings' => '< plugin.tx_buechertransport',
			'controller' => 'Province',
			'switchableControllerActions' => array(
				 'Province' => array('actions' => 'import'),
		 		 'Termin' => array('actions' => 'update')
		 	)
		);

		$this->initialize($configuration);

	}

	protected function initRepositories() {
		$this->schulungRepository = $this->objectManager->get('tx_schulungen_domain_repository_cityrepository');
		$this->teilnehmerRepository = $this->objectManager->get('tx_schulungen_domain_repository_libraryrepository');
		$this->terminRepository = $this->objectManager->get('tx_schulungen_domain_repository_provincerepository');
	}


}

?>
