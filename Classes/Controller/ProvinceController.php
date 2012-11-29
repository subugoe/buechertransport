<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Dominic Simm <dominic.simm@sub.uni-goettingen.de>, SUB Göttingen
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 ***************************************************************/

/**
 *
 *
 * @package buechertransport
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Buechertransport_Controller_ProvinceController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * provinceRepository
	 *
	 * @var Tx_Buechertransport_Domain_Repository_ProvinceRepository
	 */
	protected $provinceRepository;

	/**
	 * injectProvinceRepository
	 *
	 * @param Tx_Buechertransport_Domain_Repository_ProvinceRepository $provinceRepository
	 * @return void
	 */
	public function injectProvinceRepository(Tx_Buechertransport_Domain_Repository_ProvinceRepository $provinceRepository) {
		$this->provinceRepository = $provinceRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$provinces = $this->provinceRepository->findAll();
		$this->view->assign('provinces', $provinces);
	}

	/**
	 * action show
	 *
	 * @param Tx_Buechertransport_Domain_Model_Province $province
	 * @dontvalidate $province
	 * @return void
	 */
	public function showAction(Tx_Buechertransport_Domain_Model_Province $province) {
		t3lib_div::devLog('Show: Successful action call.' , 'buechertransport', -1);
		$this->view->assign('province', $province);
	}

	/**
	 * action new
	 *
	 * @param $newProvince
	 * @dontvalidate $newProvince
	 * @return void
	 */
	public function newAction(Tx_Buechertransport_Domain_Model_Province $newProvince = NULL) {
		$this->view->assign('newProvince', $newProvince);
	}

	/**
	 * action create
	 *
	 * @param $newProvince
	 * @return void
	 */
	public function createAction(Tx_Buechertransport_Domain_Model_Province $newProvince) {
		$this->provinceRepository->add($newProvince);
		$this->flashMessageContainer->add('Your new Province was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $province
	 * @return void
	 */
	public function editAction(Tx_Buechertransport_Domain_Model_Province $province) {
		$this->view->assign('province', $province);
	}

	/**
	 * action update
	 *
	 * @param $province
	 * @return void
	 */
	public function updateAction(Tx_Buechertransport_Domain_Model_Province $province) {
		$this->provinceRepository->update($province);
		$this->flashMessageContainer->add('Your Province was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $province
	 * @return void
	 */
	public function deleteAction(Tx_Buechertransport_Domain_Model_Province $province) {
		$this->provinceRepository->remove($province);
		$this->flashMessageContainer->add('Your Province was removed.');
		$this->redirect('list');
	}

	/**
	 * action import
	 *
	 * @param boolean $flushDB Shall the database be flushed or updated?
	 * @param Tx_Buechertransport_Command_ImportCommandController $obj
	 * @return boolean
	 */
	public function importAction($flushDB = false, Tx_Buechertransport_Command_ImportCommandController &$obj) {
		
		$importer = t3lib_div::makeInstance('Tx_Buechertransport_Utility_ImportUtility');
		t3lib_div::devLog('Import-Task: Successful action call.' , 'buechertransport', -1);
		
		// Get CSV-files 
		$files = $importer->getCSVFiles();
		if(($num = count($files)) > 0)	{			
			t3lib_div::devLog("Import-Task: $num CSV-Dateien gefunden." , 'buechertransport', -1); //, $files);
		}	else {
			t3lib_div::devLog('Import-Task: Keine CSV-Dateien.' , 'buechertransport', 3);			
		}

		// Empty SQL-tables
		if($flushDB)	{
			$obj->provinceRepository->flush();
			$obj->cityRepository->flush();
			$obj->libraryRepository->flush();
			t3lib_div::devLog('Import-Task: Truncated tables.' , 'buechertransport', 0);
		}

		// Import data into the database 
		$cities = array(); $libs = array();
		foreach ($files as $key => $file) {

			$bib = ''; $csv = ''; 
			if(preg_match('/_bibs.txt.csv$/', $file))	{
				$bib = $importer->readBibsCSV($file);
				// t3lib_div::devLog("Import-Task: CSV-Datei $file gelesen." , 'buechertransport', -1, $bib);

				$name = explode('_', $file);	// get province name
				$province = t3lib_div::makeInstance('Tx_Buechertransport_Domain_Model_Province');
				$province->setName($importer::$provinces[$name[0]]);
				$obj->provinceRepository->add($province);
			}	else {
				$csv = $importer->readReachableCSV($file);
				// t3lib_div::devLog("Import-Task: CSV-Datei $file gelesen." , 'buechertransport', -1, $csv);
			}

			// Split data into several classes (province, city, library)
			// Add Cities and Libraries
			foreach ($bib as $ln => $line) {
				$city = NULL;
				if (!in_array($line['city'], array_keys($cities)))	{
					$city = t3lib_div::makeInstance('Tx_Buechertransport_Domain_Model_City');
					$city->setName($line['city']);
					$obj->cityRepository->add($city);
					$province->addCity($city);
					// t3lib_div::devLog('Import-Task: City ' . $line['city'] . ' added.' , 'buechertransport', -1);
					$cities[$line['city']] = $city;
				}	else 	{
					$city = $cities[$line['city']];
				}

				if (!in_array($line['abbr'], array_keys($libs)))	{
					$lib = t3lib_div::makeInstance('Tx_Buechertransport_Domain_Model_Library');
					$lib->setName($line['libr']);
					$lib->setSigel($line['abbr']);
					// t3lib_div::devLog('Import-Task: Library attributes set.' , 'buechertransport', -1);

					$obj->libraryRepository->add($lib);
					// t3lib_div::devLog('Import-Task: Added to LibraryRepository.' , 'buechertransport', -1);
					$city->addLibrary($lib);
					// t3lib_div::devLog('Import-Task: Library attached to city.' , 'buechertransport', -1);
					$libs[$line['abbr']] = $lib;
				}
			}

			// Add distribution centres
			foreach ($csv as $ln => $line) {
				// Does the library exist
				if (in_array($line['abbr'], array_keys($libs)))	{
					// Does the city exist
					if (!in_array($line['dist'], array_keys($cities)))	{
						$distCentre = t3lib_div::makeInstance('Tx_Buechertransport_Domain_Model_City');
						$distCentre->setName($line['dist']);
						$obj->cityRepository->add($distCentre);
						$cities[$line['dist']] = $distCentre;
						// t3lib_div::devLog('Import-Task: Added new distCentre ' . $line['dist'] . ' to CityRepository.' , 'buechertransport', -1);
					}	else 	{
						$distCentre = $cities[$line['dist']];
						// t3lib_div::devLog('Import-Task: Found distCentre ' . $line['dist'] . ' in CityRepository.' , 'buechertransport', -1);
					}
					if ( ($lib = $libs[$line['abbr']]) != NULL)	{;
						// t3lib_div::devLog('Import-Task: '. $line['abbr'] .' : Get Library object.' , 'buechertransport', -1, array($lib));
						$lib->addDistributioncentre($distCentre);
						// t3lib_div::devLog('Import-Task: DistCentre '. $line['abbr'] .' added to Library.' , 'buechertransport', -1);
					}
				}
			}
		}
		// Store everything to database
		$obj->persistenceManager->persistAll();
		t3lib_div::devLog("Import-Task: Provinces, Cities and Libraries stored." , 'buechertransport', -1, array($cities, $libs));

		// $obj->flashMessageContainer->add('Your data has been successfully imported.');
		return true;
	}

}
?>
