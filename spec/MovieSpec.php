<?php

require_once 'lib/Movie.php';

describe("Customer", function() {

	beforeEach(function() {
		$this->customer = new Customer('Mehdi');
	});

	describe("->getName()", function() {

		it("returns the movie name", function() {

			$sw = new Movie('Star Wars', Movie::REGULAR);
			expect($sw->getTitle())->toBe('Star Wars');

		});

	});

	describe("->getPriceCode()", function() {

		it("returns the `Movie::REGULAR` price for regular movies", function() {

			$sw = new Movie('Star Wars', Movie::REGULAR);
			expect($sw->getPriceCode())->toBe(Movie::REGULAR);

		});

		it("returns the `Movie::CHILDREN` price for children's movies", function() {

			$toystory = new Movie('Toy Story', Movie::CHILDREN);
			expect($toystory->getPriceCode())->toBe(Movie::CHILDREN);

		});

		it("returns the `Movie::NEW_RELEASE` price for newly released movies", function() {

			$skyfall = new Movie('Skyfall', Movie::NEW_RELEASE);
			expect($skyfall->getPriceCode())->toBe(Movie::NEW_RELEASE);

		});

		it("throws an `InvalidArgumentException` when using an invalid price code", function() {

			$closure = function() {
				$killbill = new Movie('Kill Bill', 999);
			};

			expect($closure)->toThrow(new InvalidArgumentException("Incorrect Price Code"));

		});

	});

	describe("->getCharge()", function() {

		it("gets regular movie charge", function() {

			$sw = new Movie('Star Wars', Movie::REGULAR);
			expect($sw->getCharge(1))->toBe(2);
			expect($sw->getCharge(3))->toBe(3.5);

		});

		it("gets children movie charge", function() {

			$toystory = new Movie('Toy Story', Movie::CHILDREN);
			expect($toystory->getCharge(2))->toBe(1.5);
			expect($toystory->getCharge(3))->toBe(1.5);
			expect($toystory->getCharge(4))->toBe(3.0);

		});

		it("gets new released movie charge", function() {

			$skyfall = new Movie('Skyfall', Movie::NEW_RELEASE);
			expect($skyfall->getCharge(2))->toBe(6);

		});

	});

});
