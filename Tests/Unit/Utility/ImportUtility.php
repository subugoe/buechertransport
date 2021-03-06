<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Dominic Simm <dominic.simm@sub.uni-goettingen.de>, Goettingen State Library
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
 * ************************************************************* */

/**
 * Helper-Class for Importing data
 *
 * @version $Id: ImportUtility.php 1590 2012-11-12 17:38:19Z simm $
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Buechertransport_Utility_ImportUtility {
    
	static public function sortByName($array)	{
		return usort($array, 'Tx_Schulungen_Utility_Array::usortByName');		
	}
	static public function usortByName($a, $b)	{
		return strnatcasecmp($a->getName(), $b->getName());		
	}

	static public function import($file) {
		
		if (file_exists($file)) {
			$content = file_get_contents($file);
			$arr = explode("\n", $content); 
			$csv = array();
			for ($i=0; $i<ceil(sizeof($arr)/4); $i++) {
				$bias = 4*$i;
				$csv[$i] = array($arr[$bias], $arr[$bias+1], $arr[$bias+2], $arr[$bias+3]);
				// print_r($csv[$i]);
			}
			$data = implode("\n", implode(";", $csv));
			print_r($data);
			// file_put_contents($file, $data);
		}


	}
 
}

?>