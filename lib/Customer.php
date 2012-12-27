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
		$totalAmount = 0;
		$frequentRenterPoints = 0;
		$rentals = $this->_rentals;

		$result = "Rental records for {$this->getName()} \n";

		foreach ($rentals as $rental) {
			$frequentRenterPoints += $rental->getFrequentRenterPoints();

			// show figures for this rental
			$result .= "{$rental->getMovie()->getTitle()} \t {$rental->getCharge()} \n";

			$totalAmount += $rental->getCharge();
		}

		$result .= "Amount owned is {$totalAmount} \n";
		$result .= "You earned {$frequentRenterPoints} frequent renter points";

		return $result;
	}
}

?>