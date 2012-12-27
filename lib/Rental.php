<?php

require_once 'Movie.php';

class Rental {
	private $_movie;
	private $_daysRented;

	public function __construct(Movie $movie, $daysRented) {
		$this->_movie = $movie;
		$this->_daysRented = $daysRented;
	}

	public function getMovie() {
		return $this->_movie;
	}

	public function getDaysRented() {
		return $this->_daysRented;
	}

	public function getCharge() {
		$result = 0;

		switch ($this->getMovie()->getPriceCode()) {
			case Movie::REGULAR :
				$result += 2;
				if ($this->getDaysRented() > 2) {
					$result += ($this->getDaysRented() - 2) * 1.5;
				}
			break;
			case Movie::NEW_RELEASE :
				$result += $this->getDaysRented() * 3;
			break;
			case Movie::CHILDREN :
				$result += 1.5;
				if ($this->getDaysRented() > 3) {
					$result += ($this->getDaysRented() - 3) * 1.5;
				}
			break;
		}

		return $result;
	}

	public function getFrequentRenterPoints() {
		if (($this->getMovie()->getPriceCode() == Movie::NEW_RELEASE) &&
			($this->getDaysRented() > 1)) {
				return 2;
		} else {
			return 1;
		}
	}
}

?>