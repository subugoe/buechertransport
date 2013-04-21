<?php
namespace SUB\Buechertransport\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Dominic Simm <dominic.simm@sub.uni-goettingen.de>, SUB Göttingen
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
class City extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Province of the City
	 *
	 * @var \SUB\Buechertransport\Domain\Model\Province
	 */
	protected $province;

	/**
	 * Name of the City
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Geocode of the City
	 *
	 * @var \string
	 */
	protected $geocode;

	/**
	 * Latitude of the City
	 *
	 * @var \string
	 */
	protected $lat;

	/**
	 * Longitude of the City
	 *
	 * @var \string
	 */
	protected $lng;

	/**
	 * Related Libraries
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\Library>
	 */
	protected $libraries;

	/**
	 * __construct
	 *
	 * @return City
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->libraries = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the geocode
	 *
	 * @return \string $geocode
	 */
	public function getGeocode() {
		return $this->geocode;
	}

	/**
	 * Sets the geocode
	 *
	 * @param \string $geocode
	 * @return void
	 */
	public function setGeocode($geocode) {
		$this->geocode = $geocode;
	}

	/**
	 * Returns the lat
	 *
	 * @return \string $lat
	 */
	public function getLat() {
		return $this->lat;
	}

	/**
	 * Sets the lat
	 *
	 * @param \string $lat
	 * @return void
	 */
	public function setLat($lat) {
		$this->lat = $lat;
	}

	/**
	 * Returns the lng
	 *
	 * @return \string $lng
	 */
	public function getLng() {
		return $this->lng;
	}

	/**
	 * Sets the lng
	 *
	 * @param \string $lng
	 * @return void
	 */
	public function setLng($lng) {
		$this->lng = $lng;
	}

	/**
	 * Adds a Library
	 *
	 * @param \SUB\Buechertransport\Domain\Model\Library $library
	 * @return void
	 */
	public function addLibrary(\SUB\Buechertransport\Domain\Model\Library $library) {
		$this->libraries->attach($library);
	}

	/**
	 * Removes a Library
	 *
	 * @param \SUB\Buechertransport\Domain\Model\Library $libraryToRemove The Library to be removed
	 * @return void
	 */
	public function removeLibrary(\SUB\Buechertransport\Domain\Model\Library $libraryToRemove) {
		$this->libraries->detach($libraryToRemove);
	}

	/**
	 * Returns the libraries
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\Library> $libraries
	 */
	public function getLibraries() {
		return $this->libraries;
	}

	/**
	 * Sets the libraries
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\Library> $libraries
	 * @return void
	 */
	public function setLibraries(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $libraries) {
		$this->libraries = $libraries;
	}

	/**
	 * Returns the province
	 *
	 * @return \SUB\Buechertransport\Domain\Model\Province $province
	 */
	public function getProvince() {
		return $this->province;
	}

}
?>