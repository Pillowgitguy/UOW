<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("CinemaRooms");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cinema Website </title>
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>
    <section>
        <h1 class="center-link">Cinema Rooms</h1>

        <div class="center-horizontal">
            <a href="CinemaManagerCreateCinemaRoomUI.php" class="link no-line">> Add New Cinema Room</a>
        </div>
        
        <div class="center-horizontal">
            <a href="CinemaManagerViewCinemaRoomUI.php" class="link no-line">> View All Cinema Rooms</a>
        </div>

        <div class="center-horizontal">
            <a href="CinemaManagerSearchCinemaRoomUI.php" class="link no-line">> Search Cinema Room</a>
        </div>
    </section>
</body>

</html>