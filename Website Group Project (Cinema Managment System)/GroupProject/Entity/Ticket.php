<?php

include_once 'db.php';

class Ticket
{

	public function insertTicket($username, $movieName, $seatNo, $ticketType)
	{
		// connect to database
		global $con;

		try {
			$dateTime = '';
			$hallNo = '';
			$ticketPrice = '';

			// Getting the dateTime from tabele moviesession
			$sql = "SELECT screeningDateTime, hallNo FROM moviesession where movieName='$movieName'";
			$result = mysqli_query($con, $sql);

			while ($row = mysqli_fetch_assoc($result)) {
				$dateTime = $row['screeningDateTime'];
				$hallNo = $row['hallNo'];
			}

			// Getting the ticketPrice from table TicketType
			$sql = "SELECT ticketPrice FROM tickettype where ticketType='$ticketType'";
			$result = mysqli_query($con, $sql);


			while ($row = mysqli_fetch_assoc($result)) {
				$ticketPrice = $row['ticketPrice'];
			}

			// Insert the new ticket into table ticket
			$sql = "INSERT INTO ticket (ticketPrice, ticketType, movieName, screeningDateTime, seatNo, username, hallNo)
			VALUES ('$ticketPrice', '$ticketType', '$movieName', '$dateTime', '$seatNo', '$username', '$hallNo')";
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
