<?php

namespace SUB\Buechertransport\Tests;
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
 ***************************************************************/

/**
 * Test case for class \SUB\Buechertransport\Domain\Model\Province.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Büchertransportdienst
 *
 * @author Dominic Simm <dominic.simm@sub.uni-goettingen.de>
 */
class ProvinceTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \SUB\Buechertransport\Domain\Model\Province
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \SUB\Buechertransport\Domain\Model\Province();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameForStringSetsName() { 
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getGeocodeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setGeocodeForStringSetsGeocode() { 
		$this->fixture->setGeocode('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getGeocode()
		);
	}
	
	/**
	 * @test
	 */
	public function getLatReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLatForStringSetsLat() { 
		$this->fixture->setLat('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLat()
		);
	}
	
	/**
	 * @test
	 */
	public function getLngReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLngForStringSetsLng() { 
		$this->fixture->setLng('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLng()
		);
	}
	
	/**
	 * @test
	 */
	public function getCitiesReturnsInitialValueForCity() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCities()
		);
	}

	/**
	 * @test
	 */
	public function setCitiesForObjectStorageContainingCitySetsCities() { 
		$city = new \SUB\Buechertransport\Domain\Model\City();
		$objectStorageHoldingExactlyOneCities = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneCities->attach($city);
		$this->fixture->setCities($objectStorageHoldingExactlyOneCities);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCities,
			$this->fixture->getCities()
		);
	}
	
	/**
	 * @test
	 */
	public function addCityToObjectStorageHoldingCities() {
		$city = new \SUB\Buechertransport\Domain\Model\City();
		$objectStorageHoldingExactlyOneCity = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneCity->attach($city);
		$this->fixture->addCity($city);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCity,
			$this->fixture->getCities()
		);
	}

	/**
	 * @test
	 */
	public function removeCityFromObjectStorageHoldingCities() {
		$city = new \SUB\Buechertransport\Domain\Model\City();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($city);
		$localObjectStorage->detach($city);
		$this->fixture->addCity($city);
		$this->fixture->removeCity($city);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCities()
		);
	}
	
	/**
	 * @test
	 */
	public function getReachablesReturnsInitialValueForCity() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getReachables()
		);
	}

	/**
	 * @test
	 */
	public function setReachablesForObjectStorageContainingCitySetsReachables() { 
		$reachable = new \SUB\Buechertransport\Domain\Model\City();
		$objectStorageHoldingExactlyOneReachables = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneReachables->attach($reachable);
		$this->fixture->setReachables($objectStorageHoldingExactlyOneReachables);

		$this->assertSame(
			$objectStorageHoldingExactlyOneReachables,
			$this->fixture->getReachables()
		);
	}
	
	/**
	 * @test
	 */
	public function addReachableToObjectStorageHoldingReachables() {
		$reachable = new \SUB\Buechertransport\Domain\Model\City();
		$objectStorageHoldingExactlyOneReachable = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneReachable->attach($reachable);
		$this->fixture->addReachable($reachable);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneReachable,
			$this->fixture->getReachables()
		);
	}

	/**
	 * @test
	 */
	public function removeReachableFromObjectStorageHoldingReachables() {
		$reachable = new \SUB\Buechertransport\Domain\Model\City();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($reachable);
		$localObjectStorage->detach($reachable);
		$this->fixture->addReachable($reachable);
		$this->fixture->removeReachable($reachable);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getReachables()
		);
	}
	
}
?>