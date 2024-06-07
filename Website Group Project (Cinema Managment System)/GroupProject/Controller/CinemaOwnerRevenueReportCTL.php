<?php
include_once("Entity/Report.php");
class CinemaOwnerRevenueReportCTL
{

    function getRevenueReport($timeType, $finalPrice)
    {
        $report = new Report();
        $report->setDateRange($timeType);
        return $report->getFoodData($finalPrice);
    }
}
