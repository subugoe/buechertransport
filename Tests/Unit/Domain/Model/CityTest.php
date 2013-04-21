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
 * Test case for class \SUB\Buechertransport\Domain\Model\City.
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
class CityTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \SUB\Buechertransport\Domain\Model\City
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \SUB\Buechertransport\Domain\Model\City();
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
	public function getLibrariesReturnsInitialValueForLibrary() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getLibraries()
		);
	}

	/**
	 * @test
	 */
	public function setLibrariesForObjectStorageContainingLibrarySetsLibraries() { 
		$library = new \SUB\Buechertransport\Domain\Model\Library();
		$objectStorageHoldingExactlyOneLibraries = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
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
		$library = new \SUB\Buechertransport\Domain\Model\Library();
		$objectStorageHoldingExactlyOneLibrary = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
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
		$library = new \SUB\Buechertransport\Domain\Model\Library();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
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