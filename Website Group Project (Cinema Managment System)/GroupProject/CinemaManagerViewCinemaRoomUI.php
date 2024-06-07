<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("CinemaRooms");
include_once "Controller/CinemaManagerViewCinemaRoomCTL.php";

function viewAllRoom()
{
    $CinemaManagerViewCinemaRoomCTL = new CinemaManagerViewCinemaRoomCTL();
    $tableContent = $CinemaManagerViewCinemaRoomCTL->retrieveAllCinemaRoom();
    echo $tableContent;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cinema Website </title>
    <link rel="stylesheet" href="./css/topNav.css">
    <link rel="stylesheet" href="./css/infoTable.css">
</head>

<body>
    <section>
        <h1 class="center-link">Viewing All Cinema Rooms</h1>
    </section>

    <div class="center-link">
        <ul class="infoTable">
            <li class="table-header">
                <div class="sCode">Hall Number</div>
                <div class="sName">Cinema Name</div>
                <div class="sSTime">Is Suspended?</div>
                <div class="extra"></div>
                <div class="extra"></div>
            </li>

            <?php

                viewAllRoom();

            ?>
        </ul>
    </div>

</body>

</html>