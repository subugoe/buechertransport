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

// require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('buechertransport') . 'Resources/Private/Scripts/BuecherTransportScripts.php');

/**
 * Helper-Class to use Sidebar-Hooks
 *
 * @author Dominic Simm <simm@sub.uni-goettingen.de>
 * @package buechertransport
 * @subpackage utility
 */

class SidebarUtility extends \TYPO3\CMS\Extbase\Utility\ExtensionUtility {
    
	/**
	 * Generiert die weiteren Links für die Sidebar (nkwsubmenu_2)
	 * Wenn man sich auf einer Seite mit der Extension befindet 
	 *
	 * @param string &$content 	Current content of the submenu
	 * @param object &$obj 		TYPO3 Environment object
	 * @return void
	 */
	public function hookFunc(&$content, &$obj)		 {

		// Get / Check environment (params)
		$params = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_buechertransport_buechertransport');
  	    $curPage = isset($params['province']) ? intval($params['province']) : -1;

  	    // Is a region selected?
  	    if ($curPage > -1) {

			// Overwrite / Extend previous sidemenu-content
			$content = '';

			$province = \user_buechertransport::getProvince($curPage);
			$actions = ''; $locallang = '';
			if ($params['action'] == 'show') {
				$actions = array('showReachables', 'showMap');
				$locallang = array('reachables', 'maps');
			}	elseif ($params['action'] == 'showReachables')	{
				$actions = array('show', 'showMap');
				$locallang = array('cities', 'maps');
			}	else {
				$actions = array('show', 'showReachables');
				$locallang = array('cities', 'reachables');				
			}

			foreach ($actions as $key => $action) {
				// Generate link
				$title = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_buechertransport_domain_model_province.' . $locallang[$key], 'buechertransport');
				$link = $obj->pi_linkTP($title, $urlParameters = array('tx_buechertransport_buechertransport[action]' => $action, 'tx_buechertransport_buechertransport[controller]' => 'Province', 'tx_buechertransport_buechertransport[province]' => $province['uid']), $cache = 1, $altPageId = 0);
				$content .= '<li>' . $link . '</li>' . "\n";
			}
			
  	    }	else 	{
  	    	$content .= '';
  	    }

	}

}

?>
