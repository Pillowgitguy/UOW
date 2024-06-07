<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("MovieSession");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>
    <section class="center-link">
        <h1>Movie Sessions</h1>
    </section>

    <div class="center-horizontal">
        <a href="CinemaManagerCreateMovieSessionUI.php" class="link no-line">> Create Movie Session</a>
    </div>
    <div class="center-horizontal">
        <a href="CinemaManagerViewMovieSessionUI.php" class="link no-line">> View Movie Session</a>
    </div>
</body>

</html>