<?php
include_once("Entity/TicketType.php");

class CinemaManagerSuspendTicketTypeCTL
{

    function suspendTicketType($ticketType, $status)
    {
        $T = new TicketType();
        $results = $T->suspendTicketType($ticketType, $status);
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
