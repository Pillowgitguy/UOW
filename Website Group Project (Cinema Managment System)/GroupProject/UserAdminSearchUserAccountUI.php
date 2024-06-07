<?php
include("UserAdminNavBar.inc.php");
navbar("UserAccount");
include_once "Controller/UserAdminSearchUserAccountCTL.php";

function searchForAccount($username)
{
    $searchAccount = new UserAdminSearchUserAccountCTL();
    $tableContent = $searchAccount->searchUserAccount($username);
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

    <h2 class="center-link">Search User Accounts</h2>

    <form class="searchSection ua-search-ua-bar" action="UserAdminSearchUserAccountUI.php" method="post">
        <h3> Search for user: </h3>
        <input type="text" class="searchStudName" name="username" placeholder="Username" style="margin-left:0px" />
        <button name="searchUser" class="cm-search-movie-button"><span>Search</span></button>
    </form>

    <div class="center-link">
        <ul class="infoTable">
            <li class="table-header">
                <div class="sCode" style="position:relative;left:5px">User Name</div>
                <div class="sName" style="position:relative;left:15px">Name</div>
                <div class="sVenue" style="position:relative;left:25px">Email</div>
                <div class="sDate" style="position:relative;left:40px">Phone Number</div>
                <div class="sSTime" style="position:relative;left:45px">Account Type</div>
                <div class="sSTime" style="position:relative;left:25px">Is Suspended?</div>
            </li>

            <?php
            if (isset($_POST["searchUser"])) {
                $username = $_POST["username"];
                searchForAccount($username);
            }
            ?>
        </ul>
    </div>

</body>

</html>