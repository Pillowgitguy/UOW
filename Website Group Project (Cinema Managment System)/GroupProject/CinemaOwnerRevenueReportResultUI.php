<?php
include("CinemaOwnerNavBar.inc.php");
navbar("Revenue");
include_once("Controller/CinemaOwnerRevenueReportCTL.php");
$timeType = $_POST["time"];
?>

<!DOCTYPE html>
<html>

<head>

  <style>
    #report {
      border-collapse: collapse;
      width: 55%;
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
  <title>Cinema Website</title>
  <link rel="stylesheet" href="./css/topnav.css">
</head>

<body>

  <?php
  function generateRevenueReport($timeType)
  {
    $finalPrice = 0.00;
    $revenueCtl = new CinemaOwnerRevenueReportCTL();
    echo $revenueCtl->getRevenueReport($timeType, $finalPrice);
  }

  generateRevenueReport($timeType);
  ?>
  </form>

</body>

</html>