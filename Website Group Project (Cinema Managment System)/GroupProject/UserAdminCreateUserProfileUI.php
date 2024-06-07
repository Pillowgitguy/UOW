<?php
include("UserAdminNavBar.inc.php");
navbar("UserProfile");
include_once("Controller/UserAdminCreateUserProfileCTL.php");
$profileName = "";
$profileDescription = "";
$status = "";
$e2 = "";
$e3 = "";
$successMessage = "";
$failMessage1 = "";
$failMessage2 = "";

// Grabbing Data, if and only if there is no error for $e1 and $e2 and $e3
if (isset($_POST["submit"])) {
    validatEmptyProfileDescription($e2);
    validatStatusOption($e3);
    if (empty($e2) && empty($e3)) {
        createUserProfile($_POST["profilename"], $_POST["profiledescription"], $_POST["selectstatus"]);
    }
}

function validatEmptyProfileDescription(&$e2)
{
    global $profileDescription;
    $profileDescription = trim($_POST["profiledescription"]);
    if (empty($profileDescription)) {
        $e2 = "Please fill in the User Profile Description !";
    }
}

function validatStatusOption(&$e3)
{
    global $status;
    $status = trim($_POST["selectstatus"]);
    if (empty($status)) {
        $e3 = "Please Select A Status!";
    }
}

function createUserProfile($profileName, $profileDescription, $status)
{
    global $successMessage;
    global $failMessage1;
    global $failMessage2;

    $pSUC = new UserAdminCreateUserProfileCTL();
    $results = $pSUC->createUserProfile($profileName, $profileDescription, $status);
    if ($results == true) {
        $successMessage = <<<SUCCESS
        <div class='cm-tt-create-message alertSuccess'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Successfully Created User Profile :)
        </div>
        SUCCESS;
    } else {
        $failMessage1 = "User Profile Exists";
        $failMessage2 = <<<ERROR
        <div class='cm-tt-create-message alertError'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Create User Profile Failed
        </div>
        ERROR;
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

    <section class="center-link cm-tt-create">
        <div>
            <h2 class="center-link">Create User Profile</h2>
            <p>Please fill up the form and click on submit to create user profile!</p>
            <form action="UserAdminCreateUserProfileUI.php" method="post">
                <h4>User Profile Name</h4><input type="text" name="profilename" style="margin-left:0px" placeholder="Enter Profile Name">
                <span>
                    <?php echo $failMessage1 ?>
                </span>
                <h4>Suspend Status</h4>
                <select name="selectstatus" id="selectstatus" style="margin-top:0px">
                    <option value="" disable selected hidden>Please Select A Option</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
                <span>
                    <?php echo $e3 ?>
                </span>
                <h4>Profile Description</h4><textarea input type="text" name="profiledescription" placeholder="Enter Profile Description" cols="30"></textarea>
                <br>
                <span>
                    <?php echo $e2 ?>
                </span>
                <br><br>
                <button type="submit" name="submit"> Submit </button>

                <?php
                echo $successMessage;
                echo $failMessage2;
                ?>

            </form>
        </div>

    </section>

</body>

</html>