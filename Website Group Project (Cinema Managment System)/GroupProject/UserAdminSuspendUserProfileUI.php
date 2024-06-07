<?php
include("UserAdminNavBar.inc.php");
navbar("UserProfile");
include_once("Controller/UserAdminSuspendUserProfileCTL.php");
$profileName = "";
$profileDescription = "";
$e1 = "";
$e2 = "";
$e3 = "";
$htmlmessage = "";
$options = "";

// Grabbing Data, if and only if there is no error for $e1 and $e2
if (isset($_POST["submit"])) {
    validateEmptyUserProfile($e1);
    validatStatusOption($e2);
    if (empty($e1) && empty($e2)) {
        suspendUserProfile($_POST["profilename"], $_POST["selectstatus"]);
    }
}

function validateEmptyUserProfile(&$e1)
{
    global $profileName;
    $profileName = trim($_POST["profilename"]);
    if (empty($profileName)) {
        $e1 = "Please Select A User Profile Name To Suspend !";
    }
}

function validatStatusOption(&$e2)
{
    global $status;
    $status = trim($_POST["selectstatus"]);
    if (empty($status)) {
        $e2 = "Please Select A Status!";
    }
}

function suspendUserProfile($profileName, $suspend)
{
    global $htmlmessage;
    $pSUC = new UserAdminSuspendUserProfileCTL();
    $results = $pSUC->suspendUserProfile($profileName, $suspend);
    if ($results == true) {
        $htmlmessage = <<<SUCCESS
        <div class='ua-suspend-up-message alertSuccess'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Successfully updated User Profile Suspend Status :)
        </div>
        SUCCESS;
    } else {
        $htmlmessage = "Suspend User Profile Status Failed";
    }
}

// for dropdown list
function retrieveUserProfile()
{
    global $options;
    $rup = new UserAdminSuspendUserProfileCTL();
    $options = $rup->retrieveUserProfile();
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
            <h2 class="center-link">Suspend User Profile</h2>
            <p>Please select the options and click on submit to update user profile suspend status!</p>
            <form action="UserAdminSuspendUserProfileUI.php" method="post">

                <?php echo retrieveUserProfile(); ?>
                <h4>User Profile</h4>
                <select name="profilename" id="profilename" style="margin-top:0px">
                    <option value="" disable selected hidden>Please Select An Option</option>
                    <?php echo $options; ?>
                </select>
                </select>

                <span>
                    <?php echo $e1; ?>
                </span>

                <h4>Suspend Status</h4>
                <select name="selectstatus" id="selectstatus" style="margin-top:0px">
                    <option value="" disable selected hidden>Please Select An Option</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>

                <span>
                    <?php echo $e2; ?>
                </span>
                <br>
                <br>
                <button type="submit" name="submit"> Submit </button>

                <?php echo $htmlmessage ?>

            </form>
        </div>

    </section>

</body>

</html>