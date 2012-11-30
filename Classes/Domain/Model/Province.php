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
class Tx_Buechertransport_Domain_Model_Province extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Name of the Province
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Description of the Province
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * Related Cities
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City>
	 */
	protected $cities;

	/**
	 * Related Cities
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City>
	 */
	protected $reachables;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->cities = new Tx_Extbase_Persistence_ObjectStorage();
		
		$this->reachables = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Adds a City
	 *
	 * @param Tx_Buechertransport_Domain_Model_City $city
	 * @return void
	 */
	public function addCity(Tx_Buechertransport_Domain_Model_City $city) {
		$this->cities->attach($city);
	}

	/**
	 * Removes a City
	 *
	 * @param Tx_Buechertransport_Domain_Model_City $cityToRemove The City to be removed
	 * @return void
	 */
	public function removeCity(Tx_Buechertransport_Domain_Model_City $cityToRemove) {
		$this->cities->detach($cityToRemove);
	}

	/**
	 * Returns the cities
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City> $cities
	 */
	public function getCities() {
		return $this->cities;
	}

	/**
	 * Sets the cities
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City> $cities
	 * @return void
	 */
	public function setCities(Tx_Extbase_Persistence_ObjectStorage $cities) {
		$this->cities = $cities;
	}

	/**
	 * Adds a City
	 *
	 * @param Tx_Buechertransport_Domain_Model_City $reachable
	 * @return void
	 */
	public function addReachable(Tx_Buechertransport_Domain_Model_City $reachable) {
		$this->reachables->attach($reachable);
	}

	/**
	 * Removes a City
	 *
	 * @param Tx_Buechertransport_Domain_Model_City $reachableToRemove The City to be removed
	 * @return void
	 */
	public function removeReachable(Tx_Buechertransport_Domain_Model_City $reachableToRemove) {
		$this->reachables->detach($reachableToRemove);
	}

	/**
	 * Returns the reachables
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City> $reachables
	 */
	public function getReachables() {
		return $this->reachables;
	}

	/**
	 * Sets the reachables
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City> $reachables
	 * @return void
	 */
	public function setReachables(Tx_Extbase_Persistence_ObjectStorage $reachables) {
		$this->reachables = $reachables;
	}

}
?>