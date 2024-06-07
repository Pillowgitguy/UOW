<?php
include_once("Entity/TicketType.php");

class CinemaManagerCreateNewTicketTypeCTL
{

    function createNewTicketType($ticketType, $ticketPrice, $status)
    {
        $T = new TicketType();
        $results = $T->createNewTicketType($ticketType, $ticketPrice, $status);
        return $results;
    }
}
