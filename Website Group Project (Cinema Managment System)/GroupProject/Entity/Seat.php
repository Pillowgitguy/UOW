<?php

include 'db.php';

class Seat
{

	public function getSeats($movieName, $hallNo)
	{
		// connect to database
		global $con;

		$seats = "";

		try {
			$seat = array();
			$ticketSeat = array();
			$sql = "SELECT * FROM seat WHERE hallNo = '$hallNo';";
			$result = mysqli_query($con, $sql);

			// Go through database and count number of seats
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($seat, $row['seatNo']);
			}

			// Checking if seat is already taken
			$sql = "SELECT seatNo FROM ticket WHERE movieName = '$movieName' AND hallNo = '$hallNo';";
			$result = mysqli_query($con, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($ticketSeat, $row['seatNo']);
			}

			// Removing seats that are already taken
			$finalSeats = array_diff($seat, $ticketSeat);
			// Reindexing the array
			$finalSeats = array_values($finalSeats);

			$seats = "<option selected hidden>Please select an option</option>";

			$length = count($finalSeats);
			for ($x = 0; $x != $length; $x++) {
				$seats .= "<option value='" . $finalSeats[$x] . "'>" . $finalSeats[$x] . "</option>";
			}

			return $seats;
		} catch (mysqli_sql_exception $e) {
			return $seats;
		}
	}
}
