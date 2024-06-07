<?php
session_start();
include_once 'Controller\CinemaManagerSuspendCinemaRoomCTL.php';


function suspendCinemaHall($cinemaRoomNo)
{
    $CinemaManagerSuspendCinemaRoomCTL = new CinemaManagerSuspendCinemaRoomCTL();
    $result = $CinemaManagerSuspendCinemaRoomCTL->suspendRoom($cinemaRoomNo);

    if ($result == true) {
        echo '<script>alert("SUCCESS: Room suspended !"); setTimeout(function(){ window.location.href = "CinemaManagerViewCinemaRoomUI.php"; }, 50);</script>';
    } else {
        echo '<script>alert("FAIL: Room fail to suspend !"); setTimeout(function(){ window.location.href = "CinemaManagerViewCinemaRoomUI.php"; }, 300);</script>';
    }
}

if (isset($_GET["cinemaRoomNo"])) {
    suspendCinemaHall($_GET["cinemaRoomNo"]);
}
