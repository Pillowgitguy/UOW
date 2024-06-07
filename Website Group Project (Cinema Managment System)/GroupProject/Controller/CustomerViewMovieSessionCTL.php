<?php

include_once "Entity/MovieSession.php";

class CustomerViewMovieSessionCTL
{

	public function viewMovieDetails()
	{
		$movieDetails = new MovieSession();
		$movieA = $movieDetails->getMovieScreeningDetails();
		return $movieA;
	}
}
