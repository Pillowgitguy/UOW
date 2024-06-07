<?php
include_once("Entity/Report.php");
class CinemaOwnerUtilisationReportCTL
{

    function getUtilisationReport($timeType, $resultcount, $utilisedPercentAdded)
    {
        $report = new Report();
        $report->setDateRange($timeType);
        return $report->getUtilisationData($resultcount, $utilisedPercentAdded);
    }
}
