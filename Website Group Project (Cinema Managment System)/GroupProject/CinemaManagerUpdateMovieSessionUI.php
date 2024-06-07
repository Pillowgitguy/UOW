<?php
include("CinemaManagerNavBar.inc.php");
navbar("MovieSession");
include("Controller\CinemaManagerUpdateMovieSessionCTL.php");
$movieName = $_GET['movieName'];
$dateString = $_GET['screeningDateTime'];
$dateTime = new DateTime($dateString);
$dateTimeLocalString = $dateTime->format('Y-m-d\TH:i');
$screeningDateTime = $dateTimeLocalString;
$movieDescription = $_GET['movieDescription'];
$duration = $_GET['duration'];
$hallNo = $_GET['hallNo'];
$suspend = $_GET['suspend'];

function updateMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo, $suspend)
{
    $mcmsc = new CinemaManagerUpdateMovieSessionCTL();
    $results = $mcmsc->updateMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo, $suspend);
    if ($results == true) {
        $htmlmessage = <<<SUCCESS
            <div class='cm-update-movie-message-alert alertSuccess'>
                <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
                Update Movie Session SUCCESSFUL!
            </div>
            SUCCESS;
        echo $htmlmessage;
    } else {
        echo "Update Failed";
    }
}

if (isset($_POST["submit"])) {
    $movieDescription = $_POST["movieDescription"];
    $duration = $_POST["duration"];
    $hallNo = $_POST["hallNo"];
    $suspend = $_POST["suspend"];
    updateMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo, $suspend);
}
if (isset($_POST["back"])) {
    header("location:CinemaManagerViewMovieSessionUI.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<div class="center-link">
    <h2>Update Movie Session</h2>
</div>

<form method="POST" class="cm-create-update-movie" style="margin-left:42%">
    <label for="movieName">Movie Name: </label>
    <input type="text" name="movieName" id="" value="<?php echo $movieName; ?>" readonly>

    <br><br>
    <label for="screeningDateTime">Screening DateTime: </label>
    <input type="datetime-local" name="screeningDateTime" id="" value="<?php echo $screeningDateTime; ?>" readonly>

    <br><br>
    <label for="movieDescription">Movie Description: </label><br>
    <textarea name="movieDescription" id="" cols="30" rows="10"><?php echo $movieDescription; ?></textarea>

    <br><br>
    <label for="Duration">Duration: </label>
    <input type="number" name="duration" id="" value="<?php echo $duration; ?>"> <span style="color:black;font-weight:500">Minutes</span>

    <br><br>
    <label for="hallNo">Hall No: </label>

    <?php
    $m = new CinemaManagerUpdateMovieSessionCTL();
    $halls = $m->fetchHalls();
    $displayHalls = "<select name='hallNo'>";
    while ($row = $halls->fetch_assoc()) {
        $displayHalls = $displayHalls . "<option value=$row[hallNo]>$row[hallNo]</option>";
    }
    $displayHalls = $displayHalls . "</select>";
    echo $displayHalls;
    ?>

    <br><br>
    <label for="suspend">Suspend: </label>
    <input type="text" name="suspend" id="" value="<?php echo $suspend ?>">
    <br><br>
    <input type="submit" name="submit" value="Update">
    <input type="submit" name="back" value="Back">
</form>