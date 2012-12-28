<?php

require_once 'Price.php';

class Movie {
	const CHILDREN = 2;
	const REGULAR = 0;
	const NEW_RELEASE = 1;

	private $_title;
	private $_price;

	public function __construct($title, $priceCode) {
		$this->_title = $title;
		$this->setpriceCode($priceCode);
	}

	public function getPriceCode() {
		return $this->_price->getPriceCode();
	}

	public function setPriceCode($arg) {
		switch ($arg) {
			case self::REGULAR :
				$this->_price = new RegularPrice;
			break;
			case self::CHILDREN :
				$this->_price = new ChildrensPrice;
			break;
			case self::NEW_RELEASE :
				$this->_price = new NewReleasePrice;
			break;
			default :
				throw new InvalidArgumentException('Incorrect Price Code');
		}
	}

	public function getTitle() {
		return $this->_title;
	}

	public function getCharge($daysRented) {
		$result = 0;

		switch ($this->getPriceCode()) {
			case Movie::REGULAR :
				$result += 2;
				if ($daysRented > 2) {
					$result += ($daysRented - 2) * 1.5;
				}
			break;
			case Movie::NEW_RELEASE :
				$result += $daysRented * 3;
			break;
			case Movie::CHILDREN :
				$result += 1.5;
				if ($daysRented > 3) {
					$result += ($daysRented - 3) * 1.5;
				}
			break;
		}

		return $result;
	}

	public function getFrequentRenterPoints($daysRented) {
		if (($this->getPriceCode() == Movie::NEW_RELEASE) && ($daysRented > 1)) {
				return 2;
		} else {
			return 1;
		}
	}
}

?>