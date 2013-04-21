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
class Province extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Name of the Province
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Description of the Province
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * Geocode of the Province
	 *
	 * @var \string
	 */
	protected $geocode;

	/**
	 * Latitude of the Province
	 *
	 * @var \string
	 */
	protected $lat;

	/**
	 * Longitude of the Province
	 *
	 * @var \string
	 */
	protected $lng;

	/**
	 * Related Cities
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\City>
	 */
	protected $cities;

	/**
	 * Related Cities
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\City>
	 */
	protected $reachables;

	/**
	 * __construct
	 *
	 * @return Province
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
		$this->cities = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		
		$this->reachables = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
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
	 * Adds a City
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $city
	 * @return void
	 */
	public function addCity(\SUB\Buechertransport\Domain\Model\City $city) {
		$this->cities->attach($city);
	}

	/**
	 * Removes a City
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $cityToRemove The City to be removed
	 * @return void
	 */
	public function removeCity(\SUB\Buechertransport\Domain\Model\City $cityToRemove) {
		$this->cities->detach($cityToRemove);
	}

	/**
	 * Returns the cities
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\City> $cities
	 */
	public function getCities() {
		return $this->cities;
	}

	/**
	 * Sets the cities
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\City> $cities
	 * @return void
	 */
	public function setCities(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $cities) {
		$this->cities = $cities;
	}

	/**
	 * Adds a City
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $reachable
	 * @return void
	 */
	public function addReachable(\SUB\Buechertransport\Domain\Model\City $reachable) {
		$this->reachables->attach($reachable);
	}

	/**
	 * Removes a City
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $reachableToRemove The City to be removed
	 * @return void
	 */
	public function removeReachable(\SUB\Buechertransport\Domain\Model\City $reachableToRemove) {
		$this->reachables->detach($reachableToRemove);
	}

	/**
	 * Returns the reachables
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\City> $reachables
	 */
	public function getReachables() {
		return $this->reachables;
	}

	/**
	 * Sets the reachables
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\City> $reachables
	 * @return void
	 */
	public function setReachables(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $reachables) {
		$this->reachables = $reachables;
	}

	/**
	 * Returns the Distributioncentres of current the Province
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\City> $distCentres
	 */
	public function getLocalDistributionCentres() {
		$addedCities = array();
		$distCentres = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
		foreach ($this->cities as $city) {
		   	foreach ($city->getLibraries() as $lib) {
		   		$name = $lib->getDistributioncentre()->getName();
		   		if (!in_array($name, $addedCities)) {
			   		$distCentres->attach($lib->getDistributioncentre());
			   		array_push($lib->getDistributioncentre(), $addedCities);
		   		}
		   	}
		}  
		return $distCentres;
	}

	/**
	 * Returns the Distributioncentres of all reachable Provinces
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\SUB\Buechertransport\Domain\Model\City> $distCentres
	 */
	public function getGlobalDistributionCentres() {
		$addedCities = array();
		$distCentres = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
		foreach ($this->reachables as $city) {
		   	foreach ($city->getLibraries() as $lib) {
		   		if ($lib->getDistributioncentre() != NULL) {
			   		$name = $lib->getDistributioncentre()->getName();
			   		if (!in_array($name, $addedCities)) {
				   		$distCentres->attach($lib->getDistributioncentre());
				   		array_push($name, $addedCities);
			   		}
				} 
		   	}
		}  
		return $distCentres;
	}

	/**
	 * Returns the Distributioncentres of the reachable Provinces from $city
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City> $cities
	 */
	public function getSpecificReachableCities() {
		// Instantiate Repositories
		$cityRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('SUB\\Buechertransport\\Domain\\Repository\\CityRepository');
		$libraryRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('SUB\\Buechertransport\\Domain\\Repository\\LibraryRepository');

		$city = 'Göttingen';
		$cities = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
		$cityObj = $cityRepository->findOneByName($city);
		if ($cityObj != NULL)	{
			$libs = $libraryRepository->findByDistributioncentre($cityObj);
		   	foreach ($libs as $lib) {
		   		$cities->attach($lib->getCity());
		   	}
		}
		return $cities;
	}

	/**
	 * Returns the reachable Provinces from $city
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_Province> $provinces
	 */
	public function getSpecificReachableProvinces() {
		// Instantiate Repositories
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('SpecificReachableProvinces. Landing' , 'buechertransport', -1);
		$cityRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('SUB\\Buechertransport\\Domain\\Repository\\CityRepository');
		$libraryRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('SUB\\Buechertransport\\Domain\\Repository\\LibraryRepository');
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('SpecificReachableProvinces. Init Repos' , 'buechertransport', -1);

		$addedProvinces = array();
		$city = 'Göttingen';
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('SpecificReachableProvinces. Init new Object-Storage' , 'buechertransport', -1);
		$provinces = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('SpecificReachableProvinces. Select City' , 'buechertransport', -1);
		$cityObj = $cityRepository->findOneByName($city);
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('SpecificReachableProvinces.' , 'buechertransport', -1);
		if ($cityObj != NULL)	{
			$libs = $libraryRepository->findByDistributioncentre($cityObj);
		   	foreach ($libs as $lib) {
		   		$name = $lib->getCity()->getProvince()->getName();
		   		if (!in_array($name, $addedProvinces)) {
			   		$provinces->attach($lib->getCity()->getProvince());
			   		array_push($name, $addedProvinces);
		   		}
		   	}
		}
		return $provinces;
	}

}
?>