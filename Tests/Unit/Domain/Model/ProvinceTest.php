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
 * Test case for class Tx_Buechertransport_Domain_Model_Province.
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
class Tx_Buechertransport_Domain_Model_ProvinceTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Buechertransport_Domain_Model_Province
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Buechertransport_Domain_Model_Province();
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
	public function getCitiesReturnsInitialValueForObjectStorageContainingTx_Buechertransport_Domain_Model_City() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCities()
		);
	}

	/**
	 * @test
	 */
	public function setCitiesForObjectStorageContainingTx_Buechertransport_Domain_Model_CitySetsCities() { 
		$city = new Tx_Buechertransport_Domain_Model_City();
		$objectStorageHoldingExactlyOneCities = new Tx_Extbase_Persistence_ObjectStorage();
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
		$city = new Tx_Buechertransport_Domain_Model_City();
		$objectStorageHoldingExactlyOneCity = new Tx_Extbase_Persistence_ObjectStorage();
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
		$city = new Tx_Buechertransport_Domain_Model_City();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
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
	public function getReachablesReturnsInitialValueForObjectStorageContainingTx_Buechertransport_Domain_Model_City() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getReachables()
		);
	}

	/**
	 * @test
	 */
	public function setReachablesForObjectStorageContainingTx_Buechertransport_Domain_Model_CitySetsReachables() { 
		$reachable = new Tx_Buechertransport_Domain_Model_City();
		$objectStorageHoldingExactlyOneReachables = new Tx_Extbase_Persistence_ObjectStorage();
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
		$reachable = new Tx_Buechertransport_Domain_Model_City();
		$objectStorageHoldingExactlyOneReachable = new Tx_Extbase_Persistence_ObjectStorage();
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
		$reachable = new Tx_Buechertransport_Domain_Model_City();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
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