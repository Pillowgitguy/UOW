<?php
include("UserAdminNavBar.inc.php");
navbar("Profile");
include_once 'Controller/UserAdminViewProfileCTL.php';
session_start();

function viewProfile()
{
    $username = $_SESSION['username'];
    $adminProfile = new UserAdminViewProfileCTL();
    echo $adminProfile->viewProfile($username);
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
</head>

<body>

    <table class="table-profile">
        <?php viewProfile(); ?>
        <th></th>
        <td><a href="UserAdminUpdateProfileUI.php" class="link">Update Profile</a></td>
    </table>

</body>

</html>