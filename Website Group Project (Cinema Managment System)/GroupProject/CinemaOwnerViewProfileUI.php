<?php
include("CinemaOwnerNavBar.inc.php");
navbar("Profile");
include_once 'Controller/CinemaOwnerViewProfileCTL.php';
session_start();

function viewProfile()
{
    $username = $_SESSION['username'];
    $ownerProfile = new CinemaOwnerViewProfileCTL();
    echo $ownerProfile->viewProfile($username);
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
        <td><a href="CinemaOwnerUpdateProfileUI.php" class="link">Update Profile</a></td>
    </table>

</body>

</html>