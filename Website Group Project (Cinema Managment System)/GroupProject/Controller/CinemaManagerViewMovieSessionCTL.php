<?php
include_once("Entity\MovieSession.php");

class CinemaManagerViewMovieSessionCTL
{

    function managerRetrieveMovieSession()
    {
        $movieSession = new MovieSession();
        $displayTable = $movieSession->managerRetrieveMovieSession();
        return $displayTable;
    }
}
