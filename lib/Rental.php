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
}

?>