<?php
include_once("Entity/TicketType.php");

class CinemaManagerViewAllTicketTypesCTL
{
    function viewTicketTypes()
    {
        $up = new TicketType();
        $displayTable = $up->viewTicketTypes();
        return $displayTable;
    }
}
