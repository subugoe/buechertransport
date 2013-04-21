<?php
namespace SUB\Buechertransport\ViewHelpers;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Dominic Simm <dominic.simm@sub.uni-goettingen.de>
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

class UrlViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Gibt mit '+'-getrennten String zurück
	 *
	 * @param string $param 
	 * @return 
	 */
	public function render($param) {
		return preg_replace('/[\W]+/', '+', $param);
	}

}

?>
