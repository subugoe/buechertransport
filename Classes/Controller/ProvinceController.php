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
			if(count($obj->provinceRepository->getRemovedObjects()) > 0)	{
				t3lib_div::devLog('Import-Task: Truncating successful.' , 'buechertransport', -1);
			}	else 	{
				t3lib_div::devLog('Import-Task: Truncating failed.' , 'buechertransport', 3);
			}
		}

		// Add imported data
		$cities = array(); $libs = array();
		foreach ($files as $key => $file) {
			$name = explode('.', $file);
			$province = t3lib_div::makeInstance('Tx_Buechertransport_Domain_Model_Province');
			$province->setName($importer::$provinces[$name[0]]);
			t3lib_div::devLog('Import-Task: Set successful province name.' , 'buechertransport', -1); //, array($importer::$provinces, $name));
			$obj->provinceRepository->add($province);
			
			$csv = $importer->readCSV($file);
			t3lib_div::devLog("Import-Task: CSV-Datei $file gelesen." , 'buechertransport', -1); //, $csv);
			// break;

			// Split data into several classes (province, city, library)
			foreach ($csv as $ln => $line) {
				$city = NULL;
				if (!in_array($line['city'], array_keys($cities)))	{
				// if (count($city = $obj->cityRepository->findByName($line['city'])) == 0)	{					
					// array_push($cities, $line['city']);
					$city = t3lib_div::makeInstance('Tx_Buechertransport_Domain_Model_City');
					$city->setName($line['city']);
					$obj->cityRepository->add($city);
					$province->addCity($city);
					t3lib_div::devLog('Import-Task: City ' . $line['city'] . ' added.' , 'buechertransport', -1);
					$cities[$line['city']] = $city;
				}	else 	{
					// $city = $obj->cityRepository->findByName($line['city']);	// very slow
					$city = $cities[$line['city']];
					$province->addCity($city);
					t3lib_div::devLog('Import-Task: City ' . $line['city'] . ' found in Repository.' , 'buechertransport', -1);
				}

				// if ($city instanceof Tx_Buechertransport_Domain_Model_City)	{
					if (!in_array($line['libr'], array_keys($libs)))	{
					// if (count($lib = $obj->libraryRepository->findByName($line['libr'])) == 0)	{
					// 	array_push($libs, $line['libr']);
						$lib = t3lib_div::makeInstance('Tx_Buechertransport_Domain_Model_Library');
						$lib->setName($line['libr']);
						$lib->setSigel($line['abbr']);
						t3lib_div::devLog('Import-Task: Library attributes set.' , 'buechertransport', -1);

						// if ($distCentre = $obj->cityRepository->findByName($line['dist']))	{
						if ($distCentre = $cities[$line['dist']])	{
							;
						}	else 	{
							$distCentre = t3lib_div::makeInstance('Tx_Buechertransport_Domain_Model_City');
							$distCentre->setName($line['dist']);
							$obj->cityRepository->add($distCentre);
							$cities[$line['libr']] = $distCentre;
							t3lib_div::devLog('Import-Task: Added new distCentre ' . $line['dist'] . ' to CityRepository.' , 'buechertransport', -1);
						}
						$lib->addDistributioncentre($distCentre);
						t3lib_div::devLog('Import-Task: Library attributes set.' , 'buechertransport', -1);

						$obj->libraryRepository->add($lib);
						t3lib_div::devLog('Import-Task: Added to LibraryRepository.' , 'buechertransport', -1);
						$city->addLibrary($lib);
						t3lib_div::devLog('Import-Task: Library attached to city.' , 'buechertransport', -1);
						// $obj->cityRepository->update($city);
						// t3lib_div::devLog('Import-Task: Library ' . $line['libr'] . ' added.' , 'buechertransport', -1);
						$libs[$line['libr']] = $lib;
					}	else 	{
						$lib = $libs[$line['libr']];
						$city->addLibrary($lib);
						t3lib_div::devLog('Import-Task: Library attached to city.' , 'buechertransport', -1);
					}
				// }
			}
			// break;
		}
		$obj->persistenceManager->persistAll();

		// $obj->flashMessageContainer->add('Your data has been successfully imported.');
		return true;
	}

}
?>