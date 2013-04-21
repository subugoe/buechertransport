<?php
namespace SUB\Buechertransport\ViewHelpers;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Dominic Simm <simm@sub.uni-goettingen.de>
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
 * ************************************************************* */

/**
 * Class to reduce set of reachables to the cities which lie outside the province
 *
 * @author Dominic Simm <simm@sub.uni-goettingen.de>
 * @package buechertransport
 * @subpackage viewhelper
 */

class OutliersViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Reduce reachables to cities outside the province
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Buechertransport_Domain_Model_City> $reachables 
	 * @param Tx_Buechertransport_Domain_Model_Province $province 
	 * @return 
	 */
	public function render($reachables, $province) {
		// foreach ($province->getCities() as $key => $city) {
		// 	if ( count($reachables->findByName($city->getName())) > 0 )	{
		// 		$reachables->remove($city);
		// 	}
		// }
		return $reachables;
	}

}

?>
