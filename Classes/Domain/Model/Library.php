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
class Tx_Buechertransport_Domain_Model_Library extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Name of the Library
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Sigel of the Library
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $sigel;

	/**
	 * The related DistributionCentre (City)
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City>
	 */
	protected $distributioncentre;

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
	 * Returns the sigel
	 *
	 * @return string $sigel
	 */
	public function getSigel() {
		return $this->sigel;
	}

	/**
	 * Sets the sigel
	 *
	 * @param string $sigel
	 * @return void
	 */
	public function setSigel($sigel) {
		$this->sigel = $sigel;
	}

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
		$this->distributioncentre = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a City
	 *
	 * @param Tx_Buechertransport_Domain_Model_City $distributioncentre
	 * @return void
	 */
	public function addDistributioncentre(Tx_Buechertransport_Domain_Model_City $distributioncentre) {
		$this->distributioncentre->attach($distributioncentre);
	}

	/**
	 * Removes a City
	 *
	 * @param Tx_Buechertransport_Domain_Model_City $distributioncentreToRemove The City to be removed
	 * @return void
	 */
	public function removeDistributioncentre(Tx_Buechertransport_Domain_Model_City $distributioncentreToRemove) {
		$this->distributioncentre->detach($distributioncentreToRemove);
	}

	/**
	 * Returns the distributioncentre
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City> $distributioncentre
	 */
	public function getDistributioncentre() {
		return $this->distributioncentre;
	}

	/**
	 * Sets the distributioncentre
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City> $distributioncentre
	 * @return void
	 */
	public function setDistributioncentre(Tx_Extbase_Persistence_ObjectStorage $distributioncentre) {
		$this->distributioncentre = $distributioncentre;
	}

}
?>