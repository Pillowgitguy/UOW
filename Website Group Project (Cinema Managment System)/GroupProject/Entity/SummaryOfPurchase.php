<?php

include_once 'db.php';

class SummaryOfPurchase
{
	public function getSummaryOfPurchase($username)
	{
		// connect to database
		global $con;

		$summaryOfPurchase = "";

		$ticketsBought = '<h3 class="cust-summary-title">Tickets</h3>';

		try {
			// SQL query to select "ticket" table
			$sql = "SELECT * FROM ticket where username = '$username'";
			$result = mysqli_query($con, $sql);

			// Array tof tickets
			$ticketsBoughtArray = array();

			// Go through database row by row 
			while ($row = mysqli_fetch_assoc($result)) {
				array_push(
					$ticketsBoughtArray,
					$row['ticketNo'],
					$row['ticketPrice'],
					$row['ticketType'],
					$row['movieName'],
					$row['screeningDateTime'],
					$row['seatNo'],
					$row['hallNo'],
					$row['timePurchased']
				);
			}

			$length = count($ticketsBoughtArray);
			$ticketsBought .= "<table style class='cust-view-summary-table'>
									<tr>
									<th>Ticket No.</th>
									<th>Ticket Price</th>
									<th>Ticket Type</th>
									<th>Movie Name</th>
									<th>DateTime</th>
									<th>Seat No.</th>
									<th>Hall No.</th>
									<th>timePurchased</th>
									</tr>";

			for ($y = 0; $y < $length; $y = $y + 8) {
				$ticketsBought .= "<tr>"
					. "<td>" . $ticketsBoughtArray[$y] . "</td>"
					. "<td>" . $ticketsBoughtArray[$y + 1] . "</td>"
					. "<td>" . $ticketsBoughtArray[$y + 2] . "</td>"
					. "<td>" . $ticketsBoughtArray[$y + 3] . "</td>"
					. "<td>" . $ticketsBoughtArray[$y + 4] . "</td>"
					. "<td>" . $ticketsBoughtArray[$y + 5] . "</td>"
					. "<td>" . $ticketsBoughtArray[$y + 6] . "</td>"
					. "<td>" . $ticketsBoughtArray[$y + 7] . "</td>"
					. "</tr>";
			}
			$ticketsBought .= "</table><br>";

			$FDBought = '<h3 class="cust-summary-title">Food And Drinks:</h3>';

			// SQL query to select "foodanddrinkstransactions" table
			$sql = "SELECT * FROM foodanddrinkstransactions where username = '$username'";
			$result = mysqli_query($con, $sql);

			// Array of food and drinks
			$FDBoughtArray = array();

			// Go through database row by row 
			while ($row = mysqli_fetch_assoc($result)) {
				array_push(
					$FDBoughtArray,
					$row['foodDrinkId'],
					$row['itemName'],
					$row['itemPrice'],
					$row['quantity'],
					$row['purchaseTime'],
					$row['cinemaName']
				);
			}

			$length = count($FDBoughtArray);
			$FDBought .= "<table class='cust-view-summary-table'>
								<tr>
								<th>Receipt Number</th>
								<th>Item Name</th>
								<th>Item price</th>
								<th>Quantity</th>
								<th>Total Price</th>
								<th>Purchase Time</th>
								<th>cinemaName</th>
								</tr>";

			for ($y = 0; $y < $length; $y = $y + 6) {
				$FDBought .= "<tr>"
					. "<td>" . $FDBoughtArray[$y] . "</td>"
					. "<td>" . $FDBoughtArray[$y + 1] . "</td>"
					. "<td>" . $FDBoughtArray[$y + 2] . "</td>"
					. "<td>" . $FDBoughtArray[$y + 3] . "</td>"
					. "<td>" . $FDBoughtArray[$y + 2] * $FDBoughtArray[$y + 3] . "</td>"
					. "<td>" . $FDBoughtArray[$y + 4] . "</td>"
					. "<td>" . $FDBoughtArray[$y + 5] . "</td>"
					. "</tr>";
			}
			$FDBought .= "</table>";

			$summaryOfPurchase = $ticketsBought . $FDBought;

			return $summaryOfPurchase;
		} catch (mysqli_sql_exception $e) {
			return $summaryOfPurchase;
		}
	}
}
