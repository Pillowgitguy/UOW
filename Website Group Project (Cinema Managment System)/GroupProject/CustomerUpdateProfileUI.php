<?php
include("CustomerNavBar.inc.php");
navbar("Profile");
include_once 'Controller/CustomerUpdateProfileCTL.php';
session_start();

$username = $_SESSION['username'];
$fullName = $_SESSION['fullName'];
$email = $_SESSION['email'];
$phonenumber = $_SESSION['phoneNumber'];

function updateProfile()
{
    $custEdit = new CustomerUpdateProfileCTL();
    $custEdit->editProfile($_SESSION['username'], $_POST["fullname"], $_POST["email"], $_POST["phonenumber"]);

    if ($custEdit)
        header("Location:CustomerViewProfileUI.php");
    else
        echo "Failed to update profile";
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

    <section class="table-profile">
        <form action="CustomerUpdateProfileUI.php" method="post">
            <div>
                <label for="fullname" class="bold">Full Name: </label>
                <input type="text" name="fullname" value='<?php echo $fullName; ?>'>
            </div>
            <div>
                <label for="email" class="bold">Email: </label>
                <input type="text" name="email" value='<?php echo $email; ?>'>
            </div>
            <div>
                <label for="phonenumber" class="bold">Phone Number: </label>
                <input type="text" name="phonenumber" value='<?php echo $phonenumber ?>'>
            </div>
            <button type="submit" name="updateProfileButton" class="button"><span>Update</span></button>
        </form>
    </section>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        updateProfile();
    }
    ?>

</body>

</html>