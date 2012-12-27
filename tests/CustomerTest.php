<?php

require 'lib/Customer.php';

class CustomerTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->customer = new Customer('Mehdi');
	}

	public function testName() {
		$this->assertEquals('Mehdi', $this->customer->getName());
	}

	public function test_statement_regular_movies() {
		$sw = new Movie('Star Wars', 0);
		$st = new Movie('Star Trek', 0);

		$rental = new Rental($sw, 3);
		$rental2 = new Rental($st, 3);
		$this->customer->addRental($rental);
		$this->customer->addRental($rental2);

		$result  = "Rental records for Mehdi \n";
		$result .= "Star Wars \t 3.5 \n";
		$result .= "Star Trek \t 3.5 \n";
		$result .= "Amount owned is 7 \n";
		$result .= "You earned 2 frequent renter points";

		$this->assertEquals($result, $this->customer->statement());
	}

	public function test_statement_children_movies() {
		$cars = new Movie('Cars', 2);
		$toystory = new Movie('Toy Story', 2);

		$rental = new Rental($cars, 1);
		$rental2 = new Rental($toystory, 4);
		$this->customer->addRental($rental);
		$this->customer->addRental($rental2);

		$result  = "Rental records for Mehdi \n";
		$result .= "Cars \t 1.5 \n";
		$result .= "Toy Story \t 3 \n";
		$result .= "Amount owned is 4.5 \n";
		$result .= "You earned 2 frequent renter points";

		$this->assertEquals($result, $this->customer->statement());
	}

	public function test_statement_new_release_movies() {
		$skyfall = new Movie('Skyfall', 1);

		$rental = new Rental($skyfall, 1);
		$this->customer->addRental($rental);

		$result  = "Rental records for Mehdi \n";
		$result .= "Skyfall \t 3 \n";
		$result .= "Amount owned is 3 \n";
		$result .= "You earned 1 frequent renter points";

		$this->assertEquals($result, $this->customer->statement());
	}
}

?>