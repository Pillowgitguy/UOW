<?php
include("UserAdminNavBar.inc.php");
navbar("UserProfile");
include_once("Controller/UserAdminUpdateUserProfileCTL.php");
$profileName = "";
$newProfileName = "";
$profileDescription = "";
$e1 = "";
$e2 = "";
$retrieveAllProfileType = "";
$htmlmessage = "";
$options = "";

// Grabbing Data, if and only if there is no error for $e1 and $e2
if (isset($_POST["submit"])) {
    validatEmptyUserProfile($e1);
    validatEmptyProfileDescription($e2);
    if (empty($e1) && empty($e2)) {
        editUserProfile($_POST["profilename"], $_POST["profiledescription"]);
    }
}

function validatEmptyUserProfile(&$e1)
{
    global $profileName;
    $profileName = trim($_POST["profilename"]);
    if (empty($profileName)) {
        $e1 = "Please Select A Profile Name!";
    }
}

function validatEmptyProfileDescription(&$e2)
{
    global $profileDescription;
    $profileDescription = trim($_POST["profiledescription"]);
    if (empty($profileDescription)) {
        $e2 = "Please fill in the User Profile Description To Update!";
    }
}

function editUserProfile($profileName, $profileDescription)
{
    global $htmlmessage;
    $pSUC = new UserAdminUpdateUserProfileCTL();
    $results = $pSUC->editUserProfile($profileName, $profileDescription);
    if ($results == true) {
        $htmlmessage = <<<SUCCESS
        <div class='cm-tt-create-message alertSuccess'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Successfully Updated User Profile :)
        </div>
        SUCCESS;
    } else {
        $htmlmessage = "Update User Profile Failed";
    }
}

// for dropdown list
function retrieveUserProfile()
{
    global $options;
    $rup = new UserAdminUpdateUserProfileCTL();
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
            <h2 class="center-link">Update User Profile</h2>
            <p>Please fill up the form and click on submit to update user profile!</p>
            <form action="UserAdminUpdateUserProfileUI.php" method="post">

                <?php echo retrieveUserProfile(); ?>
                <h4>User Profile</h4>
                <select name="profilename" id="profilename" style="margin-top:0px">
                    <option value="" disable selected hidden>Please Select An Option</option>
                    <?php echo $options; ?>
                </select>

                <span>
                    <?php echo $e1; ?>
                </span>

                <h4>Profile Description</h4><textarea input type="text" name="profiledescription" placeholder="Enter Profile Description To Update" cols="32"></textarea>
                <br>
                <span>
                    <?php echo $e2 ?>
                </span>
                <br></br>
                <button type="submit" name="submit"> Submit </button>

                <?php echo $htmlmessage ?>

            </form>
        </div>

    </section>

</body>

</html>