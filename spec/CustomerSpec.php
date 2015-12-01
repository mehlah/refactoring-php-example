<?php

require_once 'lib/Customer.php';

describe("Customer", function() {

	beforeEach(function() {
		$this->customer = new Customer('Mehdi');
	});

	describe("->getName()", function() {

		it("returns the customer name", function() {

			expect($this->customer->getName())->toBe('Mehdi');

		});

	});

	describe("->statement()", function() {


		it("generates a regular movie receipt", function() {

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

			expect($this->customer->statement())->toBe($result);

		});

		it("generates a children movie receipt", function() {

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

			expect($this->customer->statement())->toBe($result);

		});

		it("generates a new release movie receipt", function() {

			$skyfall = new Movie('Skyfall', 1);

			$rental = new Rental($skyfall, 1);
			$this->customer->addRental($rental);

			$result  = "Rental records for Mehdi \n";
			$result .= "Skyfall \t 3 \n";
			$result .= "Amount owned is 3 \n";
			$result .= "You earned 1 frequent renter points";

			expect($this->customer->statement())->toBe($result);

		});

	});

});

?>