<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2011 Dominic Simm <simm@sub.uni-goettingen.de>
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
 * Importer für die (Alt-)Daten
 *
 * @author Dominic Simm <dominic.simm@sub.uni-goettingen.de>
 * @package Buechertransport
 * @subpackage Service
*/
class Tx_Buechertransport_Service_ImportTask extends tx_scheduler_Task {

	/**
	 * Method executed from the Scheduler.
	 * @return  boolean TRUE if success, otherwise FALSE
	 */
	public function execute() {
	
		/* Trying the tutorial: Reason #10 for choosing TYPO3: ExtBase + Scheduler = WIN */
		$reminder = t3lib_div::makeInstance('Tx_Schulungen_Service_SendRemindersTaskLogic');
		$reminder->execute($this);
		return TRUE;

	}

}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/buechertransport/Classes/Service/ImportTask.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/buechertransport/Classes/Service/ImportTask.php']);
}
?>