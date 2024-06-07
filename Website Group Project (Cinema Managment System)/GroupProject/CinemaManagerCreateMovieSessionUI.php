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
    <?php
    include_once("Controller\CinemaManagerCreateMovieSessionCTL.php");
    $movieName = "";
    $screeningDateTime = "";
    $movieDescription = "";
    $duration = "";
    $hallNo = "";
    $e1 = "";
    $e2 = "";
    $e3 = "";
    $e4 = "";
    $e5 = "";

    function validateMovieName(&$e1)
    {
        global $movieName;
        $movieName = trim($_POST["movieName"]);
        if (empty($movieName)) {
            $e1 = "Please fill in Movie Name";
        }
    }

    function validateScreeningDateTime(&$e2)
    {
        global $screeningDateTime;
        $screeningDateTime = trim($_POST["screeningDateTime"]);
        if (empty($screeningDateTime)) {
            $e2 = "Please fill in screening date time";
        }
    }

    function validateMovieDescription(&$e3)
    {
        global $movieDescription;
        $movieDescription = trim($_POST["movieDescription"]);
        if (empty($movieDescription)) {
            $e3 = "Please fill in movie description";
        }
    }

    function validateDuration(&$e4)
    {
        global $duration;
        $duration = trim($_POST["duration"]);
        if (empty($duration)) {
            $e4 = "Please fill in duration";
        }
    }

    function validateHallNo(&$e5)
    {
        global $hallNo;
        $hallNo = trim($_POST["hallNo"]);
        if (empty($hallNo)) {
            $e5 = "Please fill in hall number";
        }
    }

    function createMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo)
    {
        $mcmsc = new CinemaManagerCreateMovieSessionCTL();
        $results = $mcmsc->createMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo);
        if ($results == true) {
            $htmlmessage = <<<SUCCESS
            <div class='cm-update-movie-message-alert alertSuccess'>
                <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
                Movie Session creation SUCCESSFUL!
            </div>
            SUCCESS;
            echo $htmlmessage;
        } else {
            $htmlmessage = <<<ERROR
            <div class='cm-update-movie-message-alert alertError'>
                <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
                Movie session already exists!
            </div>
            ERROR;
            echo $htmlmessage;
        }
    }

    if (isset($_POST["submit"])) {
        validateMovieName($e1);
        validateScreeningDateTime($e2);
        validateMovieDescription($e3);
        validateDuration($e4);
        validateHallNo($e5);
        if (empty($e1) && empty($e2) && empty($e3) && empty($e4) && empty($e5)) {
            createMovieSession($_POST["movieName"], $_POST["screeningDateTime"], $_POST["movieDescription"], $_POST["duration"], $_POST["hallNo"]);
        }
    }
    ?>
    <div class="center-link">
        <h2>Create Movie Session</h2>
    </div>

    <?php
    if (isset($_POST['back'])) {
        header("location:CinemaManagerMovieSessionUI.php");
        exit();
    }
    ?>

    <form action="CinemaManagerCreateMovieSessionUI.php" method="post" class="cm-create-update-movie">
        <label for="movieName" class="bold">Movie Name: </label>
        <input type="text" name="movieName" id="">
        <span>
            <?php echo $e1 ?>
        </span>
        <br><br>
        <label for="screeningDateTime" class="bold">Screening DateTime: </label>
        <input type="datetime-local" name="screeningDateTime" id="">
        <span>
            <?php echo $e2 ?>
        </span>
        <br><br>
        <label for="movieDescription" class="bold">Movie Description: </label><br>
        <textarea name="movieDescription" id="" cols="30" rows="10"></textarea>
        <span>
            <?php echo $e3 ?>
        </span>
        <br><br>
        <label for="Duration" class="bold">Duration: </label>
        <input type="number" name="duration" id=""><span style="color:black;font-weight:500"> Minutes</span>
        <span>
            <?php echo $e4 ?>
        </span>
        <br><br>
        <label for="hallNo" class="bold">Hall No:&nbsp</label>
        <?php
        $m = new CinemaManagerCreateMovieSessionCTL();
        $halls = $m->fetchHalls();
        $displayHalls = "<select name='hallNo'>";
        while ($row = $halls->fetch_assoc()) {
            $displayHalls = $displayHalls . "<option value=$row[hallNo]>$row[hallNo]</option>";
        }
        $displayHalls = $displayHalls . "</select>";
        echo $displayHalls;
        ?>
        <span>
            <?php echo $e5 ?>
        </span>
        <br><br>
        <input type="submit" name="submit" value="Create Session">
        <input type="reset" value="Reset">
        <input type="submit" name="back" value="Back">
    </form>

</body>

</html>