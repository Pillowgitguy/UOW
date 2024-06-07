<?php
include_once("Entity\MovieSession.php");

class CinemaManagerSuspendMovieSessionCTL
{

    function suspendMovieSession($movieName, $screeningDateTime)
    {
        $m = new MovieSession();
        $results = $m->suspendMovieSession($movieName, $screeningDateTime);
        return $results;
    }
}
