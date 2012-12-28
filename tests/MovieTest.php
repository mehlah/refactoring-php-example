<?php

require_once 'lib/Movie.php';

class MovieTest extends PHPUnit_Framework_TestCase {

	public function testName() {
		$sw = new Movie('Star Wars', Movie::REGULAR);
		$this->assertEquals('Star Wars', $sw->getTitle());
	}

	public function testPriceCode() {
		$sw = new Movie('Star Wars', Movie::REGULAR);
		$this->assertEquals(Movie::REGULAR, $sw->getPriceCode());

		$toystory = new Movie('Toy Story', Movie::CHILDREN);
		$this->assertEquals(Movie::CHILDREN, $toystory->getPriceCode());

		$skyfall = new Movie('Skyfall', Movie::NEW_RELEASE);
		$this->assertEquals(Movie::NEW_RELEASE, $skyfall->getPriceCode());
	}

	public function testInvalidPriceCode() {
		$this->setExpectedException('InvalidArgumentException');
		$killbill = new Movie('Kill Bill', 999);
	}

	public function testChargeRegular() {
		$sw = new Movie('Star Wars', Movie::REGULAR);
		$this->assertEquals(2, $sw->getCharge(1));
		$this->assertEquals(3.5, $sw->getCharge(3));
	}

	public function testChargeNewRelease() {
		$skyfall = new Movie('Skyfall', Movie::NEW_RELEASE);
		$this->assertEquals(6, $skyfall->getCharge(2));
	}

	public function testChargeChildren() {
		$toystory = new Movie('Toy Story', Movie::CHILDREN);
		$this->assertEquals(1.5, $toystory->getCharge(2));
		$this->assertEquals(1.5, $toystory->getCharge(3));
		$this->assertEquals(3, $toystory->getCharge(4));
	}
}

?>