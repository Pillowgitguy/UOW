<?php
include_once("Entity/TicketType.php");

class CinemaManagerSearchTicketTypeCTL
{
    function searchTicketType($ticketType)
    {
        $s = new TicketType();
        $displayTable = $s->searchTicketType($ticketType);
        return $displayTable;
    }
}
