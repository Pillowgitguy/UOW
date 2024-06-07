<?php
include_once("Entity\MovieSession.php");

class CinemaManagerUpdateMovieSessionCTL
{
    // for dropdown list
    function fetchHalls()
    {
        $m = new MovieSession();
        $results = $m->fetchHalls();
        return $results;
    }

    function updateMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo, $suspend)
    {
        $m = new MovieSession();
        $results = $m->updateMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo, $suspend);
        return $results;
    }
}
