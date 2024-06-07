<?php
include_once("Controller\CinemaManagerSuspendMovieSessionCTL.php");

function suspendMovieSession()
{
    $movieName = $_GET['movieName'];
    $screeningDateTime = $_GET['screeningDateTime'];
    $msmsc = new CinemaManagerSuspendMovieSessionCTL();
    $results = $msmsc->suspendMovieSession($movieName, $screeningDateTime);
    if ($results == true) {
        header("location: CinemaManagerViewMovieSessionUI.php");
    }
}
suspendMovieSession();
