<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Dominic Simm <simm@sub-goettingen.de>, Goettingen State Library
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

require_once(PATH_tslib . 'class.tslib_pibase.php');

/**
 * Description 
 *
 * @author Dominic Simm <simm@sub-goettingen.de>, Goettingen State Library
 */
class user_buechertransport extends tslib_pibase {

	/**
	 * Returns a string of all provinces 
	 *
	 * @param $content
	 * @param $conf
	 */
	public function provinces($content = '', $conf = array()) {

		global $TSFE;
		$this->local_cObj = $TSFE->cObj; // cObject
		$this->page_id = $GLOBALS['TSFE']->id;

		$results = $this->getProvinces();

		$content = '';
		foreach ($results as $province) {
			$link = $this->pi_linkTP($province['name'], array('tx_buechertransport_buechertransport[action]=show&tx_buechertransport_buechertransport[controller]=Province&tx_buechertransport_buechertransport[province]' => $province['uid']), 1);
			$content .= '<li class="submenu-l1">' . $link . '</li>' . "\n";
		}
		// <a href="faecher-naturwissenschaften-mathematik-und-informatik/forstwissenschaften/datenbanken/" class="submenu-trigger">Datenbanken</a></li>

		return $content;
	}

	/**
	 * Returns an array of all provinces
	 *
	 * @return array
	 */
	protected function getProvinces() {

		$query = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'uid, name',
			'tx_buechertransport_domain_model_province',
			' deleted=0 AND hidden=0',
			'',
			'name ASC',
			''
		);

		$results = array();
		while ($row = mysql_fetch_assoc($query)) {
			array_push($results, $row);
		}

		return $results;
	}

}
?>