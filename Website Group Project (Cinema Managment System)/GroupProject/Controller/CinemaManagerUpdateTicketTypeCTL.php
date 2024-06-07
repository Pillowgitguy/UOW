<?php
include_once("Entity/TicketType.php");
class CinemaManagerUpdateTicketTypeCTL
{

    function editTicketType($ticketType, $ticketPrice)
    {
        $T = new TicketType();
        $results = $T->editTicketType($ticketType, $ticketPrice);
        return $results;
    }

    // for dropdown list
    function retrieveTicketType()
    {
        $T = new TicketType();
        $results = $T->retrieveTicketType();
        return $results;
    }
}
