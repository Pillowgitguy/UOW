<?php
include("UserAdminNavBar.inc.php");
navbar("UserAccount");
include_once "Controller/UserAdminViewUserAccountCTL.php";

function viewAllAccount()
{
    $retrieveAllAccount = new UserAdminViewUserAccountCTL();
    $tableContent = $retrieveAllAccount->retrieveAllUserAccount();
    echo $tableContent;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Website</title>
    <link rel="stylesheet" href="./css/topNav.css">
    <link rel="stylesheet" href="./css/infoTable.css">
</head>

<body>

    <h2 class="center-link">View All User Accounts</h2>


    <div class="center-link">
        <ul class="infoTable">
            <li class="table-header">
                <div class="sCode" style="position:relative;left:5px">User Name</div>
                <div class="sName" style="position:relative;left:15px">Name</div>
                <div class="sVenue" style="position:relative;left:25px">Email</div>
                <div class="sDate" style="position:relative;left:40px">Phone Number</div>
                <div class="sSTime" style="position:relative;left:45px">Account Type</div>
                <div class="sSTime" style="position:relative;left:25px">Is Suspended?</div>
                <div class="extra"></div>
                <div class="extra"></div>
            </li>

            <?php
                viewAllAccount();
            ?>
        </ul>
    </div>

</body>

</html>