<?php
include("CinemaManagerNavBar.inc.php");
navbar("TicketType");
include_once("Controller/CinemaManagerCreateNewTicketTypeCTL.php");
$ticketType = "";
$ticketPrice = "";
$status = "";
$e1 = "";
$e2 = "";
$e3 = "";
$failMessage1 = "";
$failMessage2 = "";
$successMessage = "";

// Grabbing Data, if and only if there is no error for $e1 and $e2 and $e3
if (isset($_POST["submit"])) {
    validateTicketType($e1);
    validatEmptyTicketPrice($e2);
    validatStatusOption($e3);
    if (empty($e1) && empty($e2) && empty($e3)) {
        createNewTicketType($_POST["ticketType"], $_POST["ticketPrice"], $_POST["selectstatus"]);
    }
}

function validateTicketType(&$e1)
{
    global $ticketType;
    $ticketType = trim($_POST["ticketType"]);
    if (empty($ticketType)) {
        $e1 = "Please fill in the Ticket Type Name !";
    }
}

function validatEmptyTicketPrice(&$e2)
{
    global $ticketPrice;
    $ticketPrice = trim($_POST["ticketPrice"]);
    if (empty($ticketPrice)) {
        $e2 = "Please fill in the Ticket Price !";
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

function createNewTicketType($ticketType, $ticketPrice, $status)
{
    global $failMessage1;
    global $failMessage2;
    global $successMessage;
    $tSUC = new CinemaManagerCreateNewTicketTypeCTL();
    $results = $tSUC->createNewTicketType($ticketType, $ticketPrice, $status);
    if ($results == true) {
        $successMessage = <<<SUCCESS
        <div class='cm-tt-create-message alertSuccess'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Successfully Created New Ticket Type!
        </div>
        SUCCESS;
    } else {
        $failMessage1 = "This Ticket Type Already Exists!";
        $failMessage2 = <<<ERROR
        <div class='cm-tt-create-message alertError'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Create Ticket Type Fail!
        </div>
        ERROR;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>

    <section class="center-link cm-tt-create">
        <div>
            <h2 class="center-link">Create New Ticket Type</h2>
            <p>Please fill up the form and click on submit to create New Ticket Type!</p>
            <form action="CinemaManagerCreateNewTicketTypeUI.php" method="post">
                <h4>New Ticket Type</h4><input type="text" name="ticketType" style="margin-left:0px" placeholder="Enter Ticket Type">

                <span>
                    <?php echo $failMessage1 ?>
                    <?php echo $e1 ?>
                </span>
                <h4>Ticket Price</h4><input type="text" name="ticketPrice" style="margin-left:0px" placeholder="Enter Ticket Price">

                <span>
                    <?php echo $e2 ?>
                </span>
                <h4>Suspend Status</h4>
                <select name="selectstatus" id="selectstatus" style="margin-top:0px">
                    <option value="" disable selected hidden>Please Select A Option</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
                <span>
                    <?php echo $e3 ?>

                    <br></br>
                    <button type="submit" name="submit"> Submit </button>

                    <!-- <?php echo $htmlmessage ?> -->
                    <?php echo $successMessage ?>
                    <?php echo $failMessage2 ?>

            </form>
        </div>

    </section>
    </form>