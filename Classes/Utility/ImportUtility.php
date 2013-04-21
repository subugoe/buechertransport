<?php
namespace SUB\Buechertransport\Utility;

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
 * Helper-Class for importing old data
 *
 * @author Dominic Simm <simm@sub.uni-goettingen.de>
 * @package buechertransport
 * @subpackage utility
 */

class ImportUtility extends \TYPO3\CMS\Extbase\Utility\ExtensionUtility {
    
	private $path = '';

	public static $provinces = array(
			'bayern' => 'Bayern',
			'berlin' => 'Berlin',
			'brandenburg' => 'Brandenburg',
			'bremen' => 'Bremen',
			'bw' => 'Baden-Württemberg',
			'hamburg' => 'Hamburg',
			'hessen' => 'Hessen',
			'mvp' => 'Mecklenburg-Vorpommern',
			'niedersachsen' => 'Niedersachsen',
			'nrw' => 'Nordrhein-Westfalen',
			'rheinland' => 'Rheinland-Pfalz',
			'saarland' => 'Saarland',
			'sachsen' => 'Sachsen',
			'sachsenanhalt' => 'Sachsen-Anhalt',
			'schleswig' => 'Schleswig-Holstein',
			'thueringen' => 'Thüringen'
		);

	public function __construct() {
		$this->path = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('buechertransport') . 'Resources/Public/ImportData/';
	}

	public function getCSVFiles() {

		t3lib_div::devLog('Import-Task: Successful utility call.' , 'buechertransport', -1, array($this->path));
		$dir = array();
		if ($handle = opendir($this->path)) {
		    while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != ".." && preg_match('/.csv$/', $file)) {
			        if (preg_match('/_bibs.txt.csv$/', $file)) {
			            array_unshift($dir, $file);
					}	else 	{
			            array_push($dir, $file);
					}
		        }
		    }
		    closedir($handle);
		}
		return $dir;
	}
	
	/* All libraries in the province
	 * Assumes that the CSV-files have three rows
	 * city; library; signature;
	 */
	public function readBibsCSV($file) {
		$pattern = '/([A-Za-zÄäÖöÜü]+)([0-9]+)|([0-9]+)([A-Za-zÄäÖöÜü]+)/';
		$csv = array();
		if (file_exists($this->path . $file)) {
			if (($handle = fopen($this->path . $file, "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
					array_push($csv, array(
						'city' => trim($data[0]),
						'libr' => trim($data[1]),
						'abbr' => preg_replace($pattern, '$1 $2', trim($data[2])),
					));
			    }
			    fclose($handle);
			}		
		}
		return $csv;
	}

	/* All libraries, that are reachable from the province
	 * Assumes that the CSV-files have four rows
	 * city; library; signature; distribution-centre
	 */
	public function readReachableCSV($file) {
		$pattern = '/([A-Za-zÄäÖöÜü]+)([0-9]+)|([0-9]+)([A-Za-zÄäÖöÜü]+)/';
		$csv = array();
		if (file_exists($this->path . $file)) {
			if (($handle = fopen($this->path . $file, "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
					array_push($csv, array(
						'city' => trim($data[0]),
						'libr' => trim($data[1]),
						'abbr' => preg_replace($pattern, '$1 $2', trim($data[2])),
						'dist' => trim($data[3])
					));
			    }
			    fclose($handle);
			}		
		}
		return $csv;
	}

	public static function convert($file) {

		$csv = array();
		if (file_exists($file)) {
			$content = file_get_contents($file);
			$arr = explode("\n", $content);
			for ($i=0; $i<ceil(sizeof($arr)/4); $i++) {
				$bias = 4*$i;
				$csv[$i] = $arr[$bias] . ';' . $arr[$bias+1] . ';' . $arr[$bias+2] . ';' . $arr[$bias+3];
			}
			$data = implode("\n", $csv);
			file_put_contents($file . '.csv', $data);
		}
		return 0;

	}

}

// Test::Conversions
// $obj = new Tx_Buechertransport_Utility_ImportUtility();
// print_r($obj::$provinces);
// $file = '../../Resources/Public/ImportData/mvp.txt.csv';
// Tx_Buechertransport_Utility_ImportUtility::convert($file);
// Tx_Buechertransport_Utility_ImportUtility::import($file);

?>
