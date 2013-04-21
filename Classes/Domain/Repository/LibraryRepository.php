<?php
namespace SUB\Buechertransport\Domain\Repository;

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
class LibraryRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * flush
	 *
	 * @return
	 */
	public function flush() {
		$query = $this->createQuery();
		$query->getQuerySettings()->setReturnRawQueryResult(true);
		// $query->statement('TRUNCATE TABLE `tx_buechertransport_library_city_mm`');
		// $query->execute();
		$query->statement('TRUNCATE TABLE `tx_buechertransport_domain_model_library`');
		return $query->execute();
	}
	
}
?>