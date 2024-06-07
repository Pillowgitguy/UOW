<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("CinemaRooms");
include "Controller/CinemaManagerCreateCinemaRoomCTL.php";

// for dropdown list
function retrieveAllcNameOption()
{
    $CinemaManagerCreateCinemaRoomCTL = new CinemaManagerCreateCinemaRoomCTL();
    $displayOption = $CinemaManagerCreateCinemaRoomCTL->retrieveAllCinema();
    echo $displayOption;
}

function createRoom($cinemaRoomNo, $cinemaName)
{
    $CinemaManagerCreateCinemaRoomCTL = new CinemaManagerCreateCinemaRoomCTL();
    return $CinemaManagerCreateCinemaRoomCTL->createNewRoom($cinemaRoomNo, $cinemaName);
}

if (isset($_POST["createRoom"])) {
    if ($_POST["cinemaRoomNo"] == "0" || $_POST["cinemaRoomNo"] == "" || preg_match('/[a-zA-Z]/', $_POST["cinemaRoomNo"]) || $_POST["cinemaName"] == "") {

        echo '<script>alert("Invalid Room Number / Cinema Name ! "); setTimeout(function(){ window.location.href = "CinemaManagerCreateCinemaRoomUI.php"; }, 300);</script>';
    } else {
        $result = createRoom($_POST["cinemaRoomNo"], $_POST["cinemaName"]);
        if ($result == true) {
            echo '<script>alert("New Cinema Room Added !"); setTimeout(function(){ window.location.href = "CinemaManagerViewCinemaRoomUI.php"; }, 300);</script>';
        } else {
            echo '<script>alert("Room Failed to be created. It may already exist! "); setTimeout(function(){ window.location.href = "CinemaManagerCreateCinemaRoomUI.php"; }, 300);</script>';
        }
    }
} else if (isset($_POST["cancel"])) {
    echo '<script>alert("Returning to previous page"); setTimeout(function(){ window.location.href = "CinemaManagerCinemaRoomsUI.php"; }, 300);</script>';
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
        <!-- <h1>Cinema Rooms</h1>
        <a href="CinemaManagerViewCinemaRoomUI.php">View All Cinema Halls</a>
        <a href="CinemaManagerCreateCinemaRoomUI.php">Add New Hall</a> -->
        <h1 class="center-link">Create Cinema Room</h1>
    </section>

    <div class="center-link">
        <ul class="infoTable">
            <li class="table-header">
                <div class="sCode" style="margin-left:60px">Hall Number</div>
                <div class="sName">Cinema Name</div>
            </li>

            <form action="CinemaManagerCreateCinemaRoomUI.php" method="post">
                <li class="table-row">

                    <input type="text" class="oddRow sCode" name="cinemaRoomNo" />

                    <select name="cinemaName" class="selectCinema" style="margin-top:0px">
                        <option value="" hidden>Select Cinema:</option>
                        <?php retrieveAllcNameOption(); ?>
                    </select>

                </li>

                <input type="submit" name="createRoom" value="Create Room" class="extra">
                <input type="submit" name="cancel" value="Cancel" class="extra">
            </form>

        </ul>
    </div>

</body>

</html>