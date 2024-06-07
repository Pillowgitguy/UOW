<?php

include_once 'db.php';


class FoodAndDrinksTransactions
{

	// for displaying of table
	public function getFoodAndDrinks()
	{

		// connect to database
		global $con;

		$foodanddrink = "";

		try {
			// SQL query to select "foodanddrink" table
			$sql = "SELECT * FROM foodanddrink";
			$result = mysqli_query($con, $sql);

			// Array for the return
			$foodanddrinkArray = array();

			// Go through database row by row 
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($foodanddrinkArray, $row['itemName'], $row['itemPrice']);
			}

			// string to return
			$foodanddrink = "";

			$length = count($foodanddrinkArray);
			for ($y = 0; $y < $length; $y = $y + 2) {
				$foodanddrink .= "<tr>"
					. "<td>" . $foodanddrinkArray[$y] . "</td>"
					. "<td style='text-align:center'>" . $foodanddrinkArray[$y + 1] . "</td>"
					. "</tr>";
			}

			// Return the String
			return $foodanddrink;
		} catch (mysqli_sql_exception $e) {
			return $foodanddrink;
		}
	}

	// for displaying of form
	public function getFoodAndDrinksForPurchase()
	{

		// connect to database
		global $con;

		$foodandrinkforpurchase = "";

		try {
			// SQL query to select "foodanddrink" table
			$sql = "SELECT * FROM foodanddrink";
			$result = mysqli_query($con, $sql);

			// Array to the return
			$foodanddrinkArray = array();

			// Go through database row by row 
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($foodanddrinkArray, $row['itemName'], $row['itemPrice']);
			}

			// Return the String
			$foodandrinkforpurchase = "<option selected hidden>Please select an option</option>";

			$length = count($foodanddrinkArray);
			for ($x = 0; $x < $length; $x = $x + 2) {
				if ($x == -2) {
					$foodandrinkforpurchase .= "<option value='" . $foodanddrinkArray[$x] . "'>" . $foodanddrinkArray[$x] . "</option>";
				} else {
					$foodandrinkforpurchase .= "<option value='" . $foodanddrinkArray[$x] . "'>" . $foodanddrinkArray[$x] . "</option>";
				}
			}

			return $foodandrinkforpurchase;
		} catch (mysqli_sql_exception $e) {
			return $foodandrinkforpurchase;
		}
	}

	// for displaying of form
	public function getCinema()
	{
		// connect to database
		global $con;

		$cinema = "";

		try {
			// SQL query to select "moviehall" table
			$sql = "SELECT * FROM cinema";
			$result = mysqli_query($con, $sql);

			// Array to the return
			$cinemaArray = array();

			// Go through database row by row 
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($cinemaArray, $row['cinemaName']);
			}

			$length = count($cinemaArray);
			for ($x = 0; $x < $length; $x++) {
				$cinema .= "<option selected='selected' value='" . $cinemaArray[$x] . "'>" . $cinemaArray[$x] . "</option>";
			}

			return $cinema;
		} catch (mysqli_sql_exception $e) {
			return $cinema;
		}
	}

	public function insertPurchaseFoodAndDrinks($username, $fDNAme, $fDQuantity, $cinema)
	{
		// connect to database
		global $con;

		try {

			$itemPrice = '';

			// Getting the itemPrice from table foodanddrink
			$sql = "SELECT itemPrice FROM foodanddrink where itemName='$fDNAme'";
			$result = mysqli_query($con, $sql);

			// Assigning the itemPrice value
			while ($row = mysqli_fetch_assoc($result)) {
				$itemPrice = $row['itemPrice'];
			}

			// Insert the new foodanddrinkstransactions into table
			$sql = "INSERT INTO foodanddrinkstransactions (itemName, itemPrice, quantity, username, cinemaName)
			VALUES ('$fDNAme', '$itemPrice', '$fDQuantity', '$username', '$cinema')";
			$result = mysqli_query($con, $sql);

			// Check if sucessfully table was updated
			if (mysqli_affected_rows($con) > 0) {
				return true;
			} else {
				return false;
			}
		} catch (mysqli_sql_exception $e) {
			return false;
		}
	}
}
