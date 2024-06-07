<?php
include_once("Entity\MovieSession.php");

class CinemaManagerSearchMovieSessionCTL
{

    function retrieveData($movieName)
    {
        $m = new MovieSession();
        $displayTable = $m->retrieveData($movieName);
        return $displayTable;
    }
}
