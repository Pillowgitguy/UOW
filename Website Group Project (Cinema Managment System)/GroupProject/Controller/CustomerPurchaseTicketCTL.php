<?php

include_once "Entity/MovieSession.php";
include_once "Entity/Seat.php";
include_once "Entity/TicketType.php";
include_once "Entity/Ticket.php";

class CustomerPurchaseTicketCTL
{

	// for dropdown list of seats
	public function selectSeat($movieName, $hallNo)
	{
		$seat = new Seat();
		$gSeats = @$seat->getSeats($movieName, $hallNo);
		return $gSeats;
	}

	// for dropdown list of ticket types
	public function selectTicketType()
	{
		$ticketType = new TicketType();
		$gTT = $ticketType->getTicketTypes();
		return $gTT;
	}

	public function ticketCreation($username, $movieName, $seatNo, $ticketType)
	{
		$ticket = new Ticket();
		// @ --> To suppress warning messages when customer did not select all options
		$result = @$ticket->insertTicket($username, $movieName, $seatNo, $ticketType);

		return $result;
	}
}
