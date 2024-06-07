<?php
include("CinemaOwnerNavBar.inc.php");
navbar("Utilisation");
include_once("Controller/CinemaOwnerUtilisationReportCTL.php");
$timeType = $_POST["time"];
?>

<!DOCTYPE html>
<html>

<head>
  <style>
    #report {
      border-collapse: collapse;
      width: 63%;
      margin: auto;
    }

    #report td,
    #report th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #report tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #report tr:hover {
      background-color: #ddd;
    }

    #report th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #cb9a51da;
      color: white;
    }
  </style>

  <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>

  </style>
  </head>

  <body>

    <?php
    function generateUtilisationReport($timeType)
    {
      $resultcount = 0;
      $utilisedPercentAdded = 0.0;
      $utilisationCtl = new CinemaOwnerUtilisationReportCTL();
      echo $utilisationCtl->getUtilisationReport($timeType, $resultcount, $utilisedPercentAdded);
    }

    generateUtilisationReport($timeType);
    ?>
    </form>

  </body>

</html>