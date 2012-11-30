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
 * Test case for class Tx_Buechertransport_Domain_Model_Library.
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
class Tx_Buechertransport_Domain_Model_LibraryTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Buechertransport_Domain_Model_Library
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Buechertransport_Domain_Model_Library();
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
	public function getSigelReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setSigelForStringSetsSigel() { 
		$this->fixture->setSigel('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getSigel()
		);
	}
	
	/**
	 * @test
	 */
	public function getDistributioncentreReturnsInitialValueForTx_Buechertransport_Domain_Model_City() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getDistributioncentre()
		);
	}

	/**
	 * @test
	 */
	public function setDistributioncentreForTx_Buechertransport_Domain_Model_CitySetsDistributioncentre() { 
		$dummyObject = new Tx_Buechertransport_Domain_Model_City();
		$this->fixture->setDistributioncentre($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getDistributioncentre()
		);
	}
	
}
?>