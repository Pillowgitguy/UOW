<?php
include_once("Entity\MovieSession.php");

class CinemaManagerCreateMovieSessionCTL
{
    function fetchHalls()
    {
        $m = new MovieSession();
        $results = $m->fetchHalls();
        return $results;
    }

    function createMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo)
    {
        $m = new MovieSession();
        $results = $m->createMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo);
        return $results;
    }
}
