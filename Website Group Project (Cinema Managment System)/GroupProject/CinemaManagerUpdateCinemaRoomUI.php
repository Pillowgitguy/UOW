<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("CinemaRooms");
include "Controller/CinemaManagerUpdateCinemaRoomCTL.php";

function updateCinemaHallInfo($cinemaRoomNo, $cinemaName, $suspend)
{
    $CinemaManagerUpdateCinemaRoomCTL = new CinemaManagerUpdateCinemaRoomCTL();
    $result = $CinemaManagerUpdateCinemaRoomCTL->updateCinemaRoom($cinemaRoomNo, $cinemaName, $suspend);

    if ($result == true) {
        echo '<script>alert("SUCCESS: Room Info Changed !"); setTimeout(function(){ window.location.href = "CinemaManagerViewCinemaRoomUI.php"; }, 300);</script>';
    } else {
        echo '<script>alert("FAILED: Room Info failed to update !")</script>';
    }
}

if (isset($_POST["confirmChange"])) {

    if ($_POST["cinemaName"] != "") {
        updateCinemaHallInfo($_POST["cinemaRoomNo"], $_POST["cinemaName"], $_POST["suspend"]);
    }
} else if (isset($_POST["cancelChanges"])) {
    echo '<script>alert("No Changes Made! Returning to previous page"); setTimeout(function(){ window.location.href = "CinemaManagerViewCinemaRoomUI.php"; }, 300);</script>';
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
    <h2 class="center-link">Update Cinema Room Info</h2>

    <div class="center-link">
        <ul class="infoTable">
            <li class="table-header">
                <div class="sCode">Hall Number</div>
                <div class="sName">Cinema Name</div>
                <div class="sSTime">Is Suspended?</div>
            </li>

            <?php
            if (isset($_POST["editRoomInfo"])) {
            ?>
                <form action="CinemaManagerUpdateCinemaRoomUI.php" method="post">
                    <li class="table-row">
                        <div class="oddRow sCode"><?php echo $_POST["cinemaRoomNo"]; ?></div>
                        <input type="hidden" name="cinemaRoomNo" value="<?php echo $_POST['cinemaRoomNo']; ?>" />

                        <div class="sName"><?php echo $_POST["cinemaName"]; ?></div>
                        <input type="hidden" name="cinemaName" value="<?php echo $_POST['cinemaName']; ?>" />

                        <select name="suspend" class="sSTime" style="margin-top:0px;">
                            <option value="N">Unsuspend</option>
                        </select>

                    </li>

                    <input type="submit" name="confirmChange" value="Confirm Change">
                    <input type="submit" name="cancelChanges" value="Cancel Changes">
                </form>
        </ul>
    </div>
<?php } ?>
</body>

</html>