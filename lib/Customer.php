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
			$thisAmount = $this->amountFor($rental);

			// add frequent renter points
			$frequentRenterPoints++;

			// add bonus for a two days new release rental
			if (($rental->getMovie()->getPriceCode() == Movie::NEW_RELEASE) &&
				($rental->getDaysRented() > 1)) {
					$frequentRenterPoints++;
			}

			// show figures for this rental
			$result .= "{$rental->getMovie()->getTitle()} \t {$thisAmount} \n";

			$totalAmount += $thisAmount;
		}

		$result .= "Amount owned is {$totalAmount} \n";
		$result .= "You earned {$frequentRenterPoints} frequent renter points";

		return $result;
	}

	private function amountFor(Rental $rental) {
		$thisAmount = 0;

		switch ($rental->getMovie()->getPriceCode()) {
			case Movie::REGULAR :
				$thisAmount += 2;
				if ($rental->getDaysRented() > 2) {
					$thisAmount += ($rental->getDaysRented() - 2) * 1.5;
				}
			break;
			case Movie::NEW_RELEASE :
				$thisAmount += $rental->getDaysRented() * 3;
			break;
			case Movie::CHILDREN :
				$thisAmount += 1.5;
				if ($rental->getDaysRented() > 3) {
					$thisAmount += ($rental->getDaysRented() - 3) * 1.5;
				}
			break;
		}

		return $thisAmount;
	}
}

?>