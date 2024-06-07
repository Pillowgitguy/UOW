<?php
include_once("Controller\CinemaManagerSearchMovieSessionCTL.php");
include("CinemaManagerNavBar.inc.php");
navbar("MovieSession");

function checkIfMovieExist()
{
    $movieName = $_GET['searchBar'];
    $msmsc = new CinemaManagerSearchMovieSessionCTL();
    $displayTable = $msmsc->retrieveData($movieName);
    echo $displayTable;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<div class="center-link">
    <h2>Search Results :</h2>
</div>

<form method="post" class="cm-search-bar">
    <label for="searchBar" class="bold">Search Bar:</label>
    <input type="text" name="searchBar" id="">
    <button name=search class="cm-search-movie-button"><span>Search</span></button>
</form>

<?php
if (isset($_POST["search"])) {
    $searchBar = $_POST['searchBar'];
    header("location: CinemaManagerSearchMovieSessionUI.php?searchBar=" . urlencode($searchBar));
}
if (isset($_POST["back"])) {
    header("location:CinemaManagerMovieSessionUI.php");
    exit();
}
checkIfMovieExist();
?>

<form method=post class="cm-search-bar">
    <button name=back class="cm-search-movie-button cm-back-movie-button"><span>Back</span></button>
</form>