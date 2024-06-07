<?php
include("CinemaOwnerNavBar.inc.php");
navbar("Revenue");
include_once("Controller/CinemaOwnerRevenueReportCTL.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>

    <h2 class="center-link">Revenue Report</h2>

    <form action="CinemaOwnerRevenueReportResultUI.php" method="post" class="center-link">
        <label for="time" class="bold">Time Duration:
            <select name="time">
                <option value="" hidden>Please select an option</option>
                <option value="day">Current Day</option>
                <option value="week">Current Week</option>
                <option value="month">Current Month</option>
            </select> <br>

            <button name="getReport" class="button co-revenue-button"><span>Generate Revenue Report</span></button>
    </form>

</body>

</html>