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
class Tx_Buechertransport_Controller_LibraryController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * libraryRepository
	 *
	 * @var Tx_Buechertransport_Domain_Repository_LibraryRepository
	 */
	protected $libraryRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$libraries = $this->libraryRepository->findAll();
		$this->view->assign('libraries', $libraries);
	}

	/**
	 * action new
	 *
	 * @param $newLibrary
	 * @dontvalidate $newLibrary
	 * @return void
	 */
	public function newAction(Tx_Buechertransport_Domain_Model_Library $newLibrary = NULL) {
		$this->view->assign('newLibrary', $newLibrary);
	}

	/**
	 * action create
	 *
	 * @param $newLibrary
	 * @return void
	 */
	public function createAction(Tx_Buechertransport_Domain_Model_Library $newLibrary) {
		$this->libraryRepository->add($newLibrary);
		$this->flashMessageContainer->add('Your new Library was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $library
	 * @return void
	 */
	public function editAction(Tx_Buechertransport_Domain_Model_Library $library) {
		$this->view->assign('library', $library);
	}

	/**
	 * action update
	 *
	 * @param $library
	 * @return void
	 */
	public function updateAction(Tx_Buechertransport_Domain_Model_Library $library) {
		$this->libraryRepository->update($library);
		$this->flashMessageContainer->add('Your Library was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $library
	 * @return void
	 */
	public function deleteAction(Tx_Buechertransport_Domain_Model_Library $library) {
		$this->libraryRepository->remove($library);
		$this->flashMessageContainer->add('Your Library was removed.');
		$this->redirect('list');
	}

	/**
	 * injectLibraryRepository
	 *
	 * @param Tx_Buechertransport_Domain_Repository_LibraryRepository $libraryRepository
	 * @return void
	 */
	public function injectLibraryRepository(Tx_Buechertransport_Domain_Repository_LibraryRepository $libraryRepository) {
		$this->libraryRepository = $libraryRepository;
	}

}
?>