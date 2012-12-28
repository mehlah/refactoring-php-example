<?php

require_once 'Movie.php';

abstract class Price {
	abstract public function getPriceCode();
}

class ChildrensPrice extends Price {
	public function getPriceCode() {
		return Movie::CHILDREN;
	}
}

class NewReleasePrice extends Price {
	public function getPriceCode() {
		return Movie::NEW_RELEASE;
	}
}

class RegularPrice extends Price {
	public function getPriceCode() {
		return Movie::REGULAR;
	}
}

?>