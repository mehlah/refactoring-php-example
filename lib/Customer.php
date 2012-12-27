<?php

require_once 'Movie.php';
require_once 'Rental.php';

class Customer {
	private $_name;
	private $_rentals = [];

	public function __construct($name) {
		$this->_name = $name;
	}

	public function addRental(Rental $arg) {
		$this->_rentals[] = $arg;
	}

	public function getName() {
		return $this->_name;
	}

	public function statement() {
		$result = "Rental records for {$this->getName()} \n";

		foreach ($this->_rentals as $rental) {
			// show figures for this rental
			$result .= "{$rental->getMovie()->getTitle()} \t {$rental->getCharge()} \n";
		}

		$result .= "Amount owned is {$this->getTotalCharge()} \n";
		$result .= "You earned {$this->getTotalFrequentRenterPoints()} frequent renter points";

		return $result;
	}

	private function getTotalCharge() {
		$result = 0;
		foreach ($this->_rentals as $rental) {
			$result += $rental->getCharge();
		}
		return $result;
	}

	private function getTotalFrequentRenterPoints() {
		$result = 0;
		foreach ($this->_rentals as $rental) {
			$result += $rental->getFrequentRenterPoints();
		}
		return $result;
	}
}

?>