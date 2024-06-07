<?php
include("CinemaOwnerNavBar.inc.php");
navbar("Utilisation");
include_once("Controller/CinemaOwnerUtilisationReportCTL.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>

  <h2 class="center-link">Cinema Utilisation Report</h2>

  <form action="CinemaOwnerUtilisationReportResultUI.php" method="post" class="center-link">
    <label for="time" class="bold">Time Duration:
      <select name="time">
        <option value="" hidden>Please select an option</option>
        <option value="day">Current Day</option>
        <option value="week">Current Week</option>
        <option value="month">Current Month</option>
      </select> <br>

      <button name="getReport" class="button co-revenue-button"><span>Generate Utilisation Report</span></button>
  </form>

</body>

</html>