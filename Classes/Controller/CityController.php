<?php
namespace SUB\Buechertransport\Controller;

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
class CityController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * cityRepository
	 *
	 * @var \SUB\Buechertransport\Domain\Repository\CityRepository
	 * @inject
	 */
	protected $cityRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$cities = $this->cityRepository->findAll();
		$this->view->assign('cities', $cities);
	}

	/**
	 * action new
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $newCity
	 * @dontvalidate $newCity
	 * @return void
	 */
	public function newAction(\SUB\Buechertransport\Domain\Model\City $newCity = NULL) {
		$this->view->assign('newCity', $newCity);
	}

	/**
	 * action create
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $newCity
	 * @return void
	 */
	public function createAction(\SUB\Buechertransport\Domain\Model\City $newCity) {
		$this->cityRepository->add($newCity);
		$this->flashMessageContainer->add('Your new City was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $city
	 * @return void
	 */
	public function editAction(\SUB\Buechertransport\Domain\Model\City $city) {
		$this->view->assign('city', $city);
	}

	/**
	 * action update
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $city
	 * @return void
	 */
	public function updateAction(\SUB\Buechertransport\Domain\Model\City $city) {
		$this->cityRepository->update($city);
		$this->flashMessageContainer->add('Your City was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \SUB\Buechertransport\Domain\Model\City $city
	 * @return void
	 */
	public function deleteAction(\SUB\Buechertransport\Domain\Model\City $city) {
		$this->cityRepository->remove($city);
		$this->flashMessageContainer->add('Your City was removed.');
		$this->redirect('list');
	}

}
?>