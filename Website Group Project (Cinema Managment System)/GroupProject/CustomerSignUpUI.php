<?php
include_once("Controller\CustomerSignUpCTL.php");
$userName = "";
$password = "";
$fullName = "";
$email = "";
$phoneNumber = null;
$e1 = "";
$e2 = "";
$e3 = "";
$e4 = "";
$e5 = "";
if (isset($_POST["submit"])) {
    validateUserName($e1);
    validatePassword($e2);
    validateEmail($e3);
    validatePhoneNumber($e4);
    validateFullName($e5);
    if (empty($e1) && empty($e2) && empty($e3) && empty($e4)) {
        createCustomerAccount($_POST["userName"], $_POST["password"], $_POST["fullName"], $_POST["email"], $_POST["phoneNumber"]);
    }
}

function validateUserName(&$e1)
{
    global $userName;
    $userName = trim($_POST["userName"]);
    if (empty($userName)) {
        $e1 = "Please fill in Username";
    }
}

function validatePassword(&$e2)
{
    global $password;
    $password = trim($_POST["password"]);
    if (empty($password)) {
        $e2 = "Please fill in password";
    }
}

function validateEmail(&$e3)
{
    global $email;
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $e3 = "Please fill in email";
    }
}

function validatePhoneNumber(&$e4)
{
    global $phoneNumber;
    $phoneNumber = trim($_POST["phoneNumber"]);
    if (empty($phoneNumber)) {
        $e4 = "Please fill in phone";
    } else if (!preg_match("/[0-9]{8}/", $phoneNumber)) {
        $e4 = "Please enter only numbers";
    }
}

function validateFullName(&$e5)
{
    global $fullName;
    $fullName = trim($_POST["fullName"]);
    if (empty($fullName)) {
        $e5 = "Please fill in full name";
    }
}
function createCustomerAccount($userName, $password, $fullName, $email, $phoneNumber)
{
    global $e1;
    $cSUC = new CustomerSignUpCTL();
    $results = $cSUC->createCustomerAccount($userName, $password, $fullName, $email, $phoneNumber);
    if ($results == true) {
        echo <<<SUCCESS
        <div class='sigup-message alertSuccess'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Sign Up SUCCESSFUL
        </div>
        SUCCESS;
    } else {
        echo <<<ERROR
        <div class='sigup-message alertError'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
            Sign UP Failed
        </div>
        ERROR;

        $e1 = "User Name taken";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<form action="CustomerSignUpUI.php" method="post" class="signup">
    <h1 class="link">Sign Up</h1>

    <label for="userName" class='bold'>UserName: </label>
    <input type="text" name="userName" placeholder="Please enter name" value="<?php echo $userName ?>">
    <span>
        <?php echo $e1 ?>
    </span>
    <br>
    <label for="password" class='bold'>Password: </label>
    <input type="text" name="password" placeholder="Please enter password" value="<?php echo $password ?>">
    <span>
        <?php echo $e2 ?>
    </span>
    <br>
    <label for="fullName" class='bold'>FullName: </label>
    <input type="text" name="fullName" placeholder="Please enter full name" value="<?php echo $fullName ?>">
    <span>
        <?php echo $e5 ?>
    </span>
    <br>
    <label for="email" class='bold'>Email: </label>
    <input type="email" name="email" placeholder="Please enter email" value="<?php echo $email ?>">
    <span>
        <?php echo $e3 ?>
    </span>
    <br>
    <label for="phoneNumber" class='bold'>Contact Number: </label>
    <input type="text" name="phoneNumber" placeholder="Please enter contact number" value="<?php echo $phoneNumber ?>">
    <span>
        <?php echo $e4 ?>
    </span>
    <br><br>
    <input type="submit" name="submit" value="Register">
    <label for="signin" style="margin-left:50px">Already have a Account?-></label>
    <a href="./index.php" class='link'>Return </a>
    <br>
    <br>
</form>