<?php
include_once("db.php");
//include_once("../entityClass/userAccount.php");


class Report
{

    private $startDateStr = '';
    private $endDateStr = '';

    private $reportType = '';

    function setDateRange($timeType)
    {
        $day = date('d');
        $month = date('m');
        $year  = date('Y');

        //sets time for only today from 00:00 until 23:59
        if ($timeType === 'day') {
            $startDate = new DateTime("$year-$month-$day");
            $this->startDateStr = $startDate->format('Y-m-d H:i:s');

            $endDate = new DateTime("$year-$month-$day");
            $endDate->setTime(23, 59, 59);
            $this->endDateStr = $endDate->format('Y-m-d H:i:s');

            $this->reportType = 'day';
        }
        //sets start time from last week until today
        if ($timeType === 'week') {
            $startDate = new DateTime("$year-$month-$day");
            $startDate->modify('-7 days');
            $this->startDateStr = $startDate->format('Y-m-d H:i:s');

            $endDate = new DateTime("$year-$month-$day");
            $endDate->setTime(23, 59, 59);
            $this->endDateStr = $endDate->format('Y-m-d H:i:s');

            $this->reportType = 'week';
        }

        //sets time for the current month
        if ($timeType === 'month') {
            $startDate = new DateTime("$year-$month-01");
            $this->startDateStr = $startDate->format('Y-m-d H:i:s');

            $endDate = new DateTime("$year-$month-01");
            $endDate->modify('last day of this month');
            $endDate->setTime(23, 59, 59);
            $this->endDateStr = $endDate->format('Y-m-d H:i:s');

            $this->reportType = 'month';
        }
    }

    // GENERATE REVENUE REPORT
    function getFoodData($finalPrice)
    {
        global $con;
        $sql = "SELECT itemName, itemPrice, quantity, (itemPrice * quantity) AS total
                FROM foodanddrinkstransactions
                WHERE  purchaseTime BETWEEN '$this->startDateStr' AND '$this->endDateStr'";

        $results = $con->query($sql);

        $foodData = "";

        switch ($this->reportType) {
            case 'day':
                $foodData .= '<h2 class="center-link">Current Day Revenue Report</h2>';
                break;
            case 'week':
                $foodData .= '<h2 class="center-link">Current Week Revenue Report</h2>';
                break;
            case 'month':
                $foodData .= '<h2 class="center-link">Current Month Revenue Report</h2>';
                break;
        }

        if ($results->num_rows > 0) {
            $foodData .= "<table id = 'report'><tr> <th>Items Purchased </th> <th>Item Price ($) </th> <th>Quantity </th> <th>Total ($)</th> </tr>";
            // output data of each row  
            while ($row = $results->fetch_assoc()) {
                $foodData .= "<tr> <td>" . $row["itemName"] . "</td> <td>" . $row["itemPrice"] . "</td> <td> " . $row["quantity"] . "</td> <td>" . $row["total"] . "</td></tr>";
                $finalPrice += (float)$row["total"];
            }
            $foodData .= "<tr> <td></td> <td> </td> <td class='bold'>" . "Net Revenue ($) : " . "</td> <td>" . $finalPrice . "</td></tr>";
            $foodData .= "</table>";
        } else {
            $foodData = <<<ERROR
            <div class='co-error alertError'>
                <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
                Error or no results found
            </div>
            ERROR;
        }

        return $foodData;
    }

    // GENERATE CINEMA UTILISATION REPORT
    function getUtilisationData($resultcount, $utilisedPercentAdded)
    {
        global $con;
        $sql = "SELECT hallNo, screeningDateTime, movieName,(COUNT(*)/6)*100 AS utilisedPercent 
                FROM ticket
                WHERE timePurchased BETWEEN '$this->startDateStr' AND '$this->endDateStr'
                GROUP BY hallNo,screeningDateTime,movieName";
        $results = $con->query($sql);

        $utilisationData = "";

        switch ($this->reportType) {
            case 'day':
                $utilisationData .= '<h2 class="center-link">Current Day Utilisation Report</h2>';
                break;
            case 'week':
                $utilisationData .= '<h2 class="center-link">Current Week Utilisation Report</h2>';
                break;
            case 'month':
                $utilisationData .= '<h2 class="center-link">Current Month Utilisation Report</h2>';
                break;
        }

        if ($results->num_rows > 0) {
            $utilisationData .= "<table id = 'report'><tr> <th>Hall Number </th> <th> Movie Name </th> <th>Screening Time </th><th>Hall Utilisation (%)</th> </tr>";
            // output data of each row  
            while ($row = $results->fetch_assoc()) {
                $utilisationData .= "<tr> <td>" . $row["hallNo"] . "</td> <td>" . $row["movieName"] . "</td> <td>" . $row["screeningDateTime"] . "</td> <td> " . $row["utilisedPercent"] . "</td> </tr> ";
                $resultcount++;
                $utilisedPercentAdded += (float)$row["utilisedPercent"];
            }
            $utilisationData .= "<tr> <td> </td> <td> </td> <td class='bold'> Average Utilisation (%) :</td> <td>" . $utilisedPercentAdded / $resultcount . "</td></tr>";
            $utilisationData .= "</table>";
        } else {
            $utilisationData = <<<ERROR
            <div class='co-error alertError'>
                <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
                Error or no results found
            </div>
            ERROR;
        }

        return $utilisationData;
    }
}
