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
 * Test case for class Tx_Buechertransport_Domain_Model_City.
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
class Tx_Buechertransport_Domain_Model_CityTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Buechertransport_Domain_Model_City
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Buechertransport_Domain_Model_City();
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
	public function getLibrariesReturnsInitialValueForObjectStorageContainingTx_Buechertransport_Domain_Model_Library() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getLibraries()
		);
	}

	/**
	 * @test
	 */
	public function setLibrariesForObjectStorageContainingTx_Buechertransport_Domain_Model_LibrarySetsLibraries() { 
		$library = new Tx_Buechertransport_Domain_Model_Library();
		$objectStorageHoldingExactlyOneLibraries = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneLibraries->attach($library);
		$this->fixture->setLibraries($objectStorageHoldingExactlyOneLibraries);

		$this->assertSame(
			$objectStorageHoldingExactlyOneLibraries,
			$this->fixture->getLibraries()
		);
	}
	
	/**
	 * @test
	 */
	public function addLibraryToObjectStorageHoldingLibraries() {
		$library = new Tx_Buechertransport_Domain_Model_Library();
		$objectStorageHoldingExactlyOneLibrary = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneLibrary->attach($library);
		$this->fixture->addLibrary($library);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneLibrary,
			$this->fixture->getLibraries()
		);
	}

	/**
	 * @test
	 */
	public function removeLibraryFromObjectStorageHoldingLibraries() {
		$library = new Tx_Buechertransport_Domain_Model_Library();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($library);
		$localObjectStorage->detach($library);
		$this->fixture->addLibrary($library);
		$this->fixture->removeLibrary($library);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getLibraries()
		);
	}
	
}
?>