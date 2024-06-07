<?php
include("UserAdminNavBar.inc.php");
navbar("UserAccount");
include_once "Controller/UserAdminCreateUserAccountCTL.php";

function createNewAccount($username, $password, $fullName, $email, $phoneNumber, $profileName)
{

    $createAccount = new UserAdminCreateUserAccountCTL();
    $result = $createAccount->createUserAccount($username, $password, $fullName, $email, $phoneNumber, $profileName);

    if ($result == true) {
        echo '<script>alert("New Account Added !"); setTimeout(function(){ window.location.href = "UserAdminUserAccountUI.php"; }, 300);</script>';
    } else {
        echo '<script>alert("Account Failed to be added. Account may already exist! ")</script>';
    }
}

// for dropdown list
function retrieveAllProfileType()
{
    $UserAdminCreateUserAccountCTL = new UserAdminCreateUserAccountCTL();
    $displayOption = $UserAdminCreateUserAccountCTL->retrieveProfileName();
    echo $displayOption;
}

$err1 = "";

if (isset($_POST["createAccount"])) {

    if ($_POST["profileName"] == "") {
        $err1 = <<<ERROR
        <div class='ua-create-ua-message alertError'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
            Please select a User Profile!
        </div>
        ERROR;
    } else {

        $username = $_POST["username"];
        $password =  $_POST["password"];
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $profileName = $_POST["profileName"];

        createNewAccount($username, $password, $fullName, $email, $phoneNumber, $profileName);
    }
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

    <form action="UserAdminCreateUserAccountUI.php" method="post" class="newUserForm">

        <h2 class="center-link"> Add New User Account </h2>

        <section class="center-link">
            <select name="profileName" class="selectProfile">
                <option value="" hidden>I am creating a new: </option>
                <?php retrieveAllProfileType(); ?>
            </select>
            <?php echo $err1; ?>
            <!-- <?php echo "<h3>" . $err1 . "</h3>"; ?> -->
        </section>

        <section class="ua-create-ua">
            <label class="bold">Username: <input type="text" name="username" /></label>
            <br><br>
            <label class="bold">Password: <input type="password" name="password" /></label>
            <br><br>
            <label class="bold">Full Name: <input type="text" name="fullName" /></label>
            <br><br>
            <label class="bold">Email: <input type="email" name="email" /></label>
            <br><br>
            <label class="bold">Phone No. : <input type="text" name="phoneNumber" /></label>

        </section>

        <div class="center-link ua-create-ua-button">
            <input type="submit" class="submitFormBTN" name="createAccount" value="Create New Account" />
        </div>
    </form>

</body>

</html>