<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("CinemaRooms");
include_once "Controller/CinemaManagerSearchCinemaRoomCTL.php";
include_once "Controller/CinemaManagerViewCinemaRoomCTL.php";

function searchForRoom($cinemaRoomNo)
{
    $CinemaManagerSearchCinemaRoomCTL = new CinemaManagerSearchCinemaRoomCTL();
    $tableContent = $CinemaManagerSearchCinemaRoomCTL->searchCinemaRoom($cinemaRoomNo);
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
        <h1 class="center-link">Search Cinema Rooms</h1>
    </section>

    <form class="searchSection cm-search-movie-bar" action="CinemaManagerSearchCinemaRoomUI.php" method="post">
        <label for=searchStudName class="bold">Search Bar:</label>
        <input type="text" class="searchStudName" name="cinemaRoomNo" placeholder="Cinema Room Number" />
        <button name="searchRoom" class="cm-search-movie-button"><span>Search</span></button>
    </form>

    <div class="center-link">
        <ul class="infoTable">
            <li class="table-header">
                <div class="sCode">Hall Number</div>
                <div class="sName">Cinema Name</div>
                <div class="sSTime">Is Suspended?</div>
            </li>

            <?php
            if (isset($_POST["searchRoom"])) {
                searchForRoom($_POST["cinemaRoomNo"]);
            }
            ?>
        </ul>
    </div>

</body>

</html>