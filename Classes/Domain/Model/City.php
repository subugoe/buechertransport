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
class Tx_Buechertransport_Domain_Model_City extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Name of the City
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Related Libraries
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_Library>
	 */
	protected $libraries;

	/**
	 * Geocode of the City
	 *
	 * @var string
	 */
	protected $geocode;

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
		$this->libraries = new Tx_Extbase_Persistence_ObjectStorage();
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
	 * Adds a Library
	 *
	 * @param Tx_Buechertransport_Domain_Model_Library $library
	 * @return void
	 */
	public function addLibrary(Tx_Buechertransport_Domain_Model_Library $library) {
		$this->libraries->attach($library);
	}

	/**
	 * Removes a Library
	 *
	 * @param Tx_Buechertransport_Domain_Model_Library $libraryToRemove The Library to be removed
	 * @return void
	 */
	public function removeLibrary(Tx_Buechertransport_Domain_Model_Library $libraryToRemove) {
		$this->libraries->detach($libraryToRemove);
	}

	/**
	 * Returns the libraries
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_Library> $libraries
	 */
	public function getLibraries() {
		return $this->libraries;
	}

	/**
	 * Sets the libraries
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_Library> $libraries
	 * @return void
	 */
	public function setLibraries(Tx_Extbase_Persistence_ObjectStorage $libraries) {
		$this->libraries = $libraries;
	}

	/**
	 * Returns the geocode
	 *
	 * @return string $geocode
	 */
	public function getGeocode() {
		return $this->geocode;
	}

	/**
	 * Sets the geocode
	 *
	 * @param string $geocode
	 * @return void
	 */
	public function setGeocode($geocode) {
		$this->geocode = $geocode;
	}

}
?>