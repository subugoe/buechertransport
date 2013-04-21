<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Dominic Simm <simm@sub-goettingen.de>, Goettingen State Library
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

	public $pi_checkCHash = TRUE;		

	/**
	 * Returns a menu-string/array of all provinces 
	 *
	 * @param $content
	 * @param $conf
	 * @return array the new array
	 */
	// public function provinces($content = '', $conf = array()) {
	public function provinces($menuArr, $conf) {

		// global $TSFE;
		// $this->page_id = $GLOBALS['TSFE']->id;
	
		// Turn off caching
		// $this->pi_USER_INT_obj = 0;

		// Inheritage of title image => without effect
		// $menuArr[0]['tx_nkwsubmenu_picture_follow'] = 1;

		// Get the provinces
		$results = $this->getProvinces();

		$params = t3lib_div::_GP('tx_buechertransport_buechertransport');
  	    $curPage = isset($params['province']) ? intval($params['province']) : -1;
  
		if(count($menuArr) > 0)	{
			foreach ($results as $key => $province) {
				$menuArr[$key]['title'] = $province['name'];
				$menuArr[$key]['id'] = $province['uid'];
				$menuArr[$key]['uid'] = $menuArr[0]['pid'];	
				$menuArr[$key]['ITEM_STATE'] = 'NO';
				if ($curPage == $province['uid']) {
					$menuArr[$key]['ITEM_STATE'] = 'ACT';
				}
				// Calculate cHash
				$link = $this->pi_linkTP($province['name'], $urlParameters = array('tx_buechertransport_buechertransport[action]' => 'show', 'tx_buechertransport_buechertransport[controller]' => 'Province', 'tx_buechertransport_buechertransport[province]' => $province['uid']), $cache = 1, $altPageId = 0);
				$urlParameters = explode('&amp;', $link);
				// Assumes that last param is cHash
				preg_match('/^cHash=([a-z0-9]+)/', $urlParameters[count($urlParameters)-1], $reg_result);
				$menuArr[$key]['cHash'] = $reg_result[1];
				// foreach ($urlParameters as $key => $param) {
				// 	// echo $param . "<br>";
				// 	if (preg_match('/^cHash=([a-z0-9]+)/', $param, $reg_result)
				// 		$menuArr[$key]['cHash'] = $reg_result[1];
				// }
			}
		}

		// echo count($menuArr) . ' ';
		// echo "<pre>";
		// print_r($menuArr);
		// print_r($conf);
		// echo "</pre>";
		// print_r("<br>");

		return $menuArr;

		// // Menue als String
		// $content = ''; 
		// foreach ($results as $key => $province) {
		// 	$link = $this->pi_linkTP($province['name'], array('tx_buechertransport_buechertransport[action]=show&tx_buechertransport_buechertransport[controller]=Province&tx_buechertransport_buechertransport[province]' => $province['uid']), 1);
		// 	if ($curPage == $province['uid']) {
		// 		$params = array(
		// 			'title' => $province['name'],
		// 			'class' => "submenu-highlight-parent submenu-trigger"
		// 		);
		// 		$link = $this->local_cObj->addParams($link, $params);
		// 		$content .= '<li class="submenu-l1 selected">' . $link . '</li>' . "\n";	
		// 	}	else {
		// 		$content .= '<li class="submenu-l1">' . $link . '</li>' . "\n";	
		// 	}
		// }
		// return $content;

	}

	/**
	 * Returns an array of all provinces
	 *
	 * @return array
	 */
	public function getProvince($uid) {

		$query = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'uid, name',
			'tx_buechertransport_domain_model_province',
			' deleted=0 AND hidden=0 AND uid=' .  intval($uid),
			'',
			'name ASC',
			''
		);

		if ($row = mysql_fetch_assoc($query)) {
			return $row;
		}	else 	{
			return NULL;
		}

	}

	/**
	 * Returns an array of all provinces
	 *
	 * @return array
	 */
	public function getProvinces() {

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