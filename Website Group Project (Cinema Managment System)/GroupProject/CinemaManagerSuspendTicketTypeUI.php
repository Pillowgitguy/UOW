<?php
include("CinemaManagerNavBar.inc.php");
navbar("TicketType");
include_once("Controller/CinemaManagerSuspendTicketTypeCTL.php");
$ticketType = "";
$ticketPrice = "";
$e1 = "";
$e2 = "";
$htmlmessage = "";

if (isset($_POST["submit"])) {
    validatEmptyOption($e1);
    validatStatusOption($e2);
    if (empty($e1) && empty($e2)) {
        suspendTicketType($_POST["ticketType"], $_POST["selectstatus"]);
    }
}

function validatEmptyOption(&$e1)
{
    global $ticketType;
    $ticketType = trim($_POST["ticketType"]);
    if (empty($ticketType)) {
        $e1 = "Please Select A Ticket Type!";
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

function suspendTicketType($ticketType, $status)
{
    global $htmlmessage;
    $pSUC = new CinemaManagerSuspendTicketTypeCTL();
    $results = $pSUC->suspendTicketType($ticketType, $status);
    if ($results == true) {
        $htmlmessage = <<<SUCCESS
        <div class='cm-tt-create-message alertSuccess'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Successfully updated Suspend Status :)
        </div>
        SUCCESS;
    } else {
        $htmlmessage = "Update Suspend Selected Ticket Type Failed!";
    }
}

// for dropdown list
function retrieveTicketType()
{
    global $options;
    $rup = new CinemaManagerSuspendTicketTypeCTL();
    $options = $rup->retrieveTicketType();
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

            <h2 class="center-link">Suspend Ticket Type</h2>
            <p>Please fill up the form and click on submit to update ticket type suspend status !</p>
            <form action="CinemaManagerSuspendTicketTypeUI.php" method="post">

                <?php echo retrieveTicketType(); ?>
                <h4>Ticket Type</h4>
                <select name="ticketType" id="ticketType" style="margin-top:0px">
                    <option value="" disable selected hidden>Please Select A Option</option>
                    <?php echo $options; ?>
                </select>

                <span>
                    <?php echo $e1; ?>
                </span>

                <h4>Suspend Status</h4>
                <select name="selectstatus" id="selectstatus" style="margin-top:0px">
                    <option value="" disable selected hidden>Please Select A Option</option>
                    <option value=" Y">Yes</option>
                    <option value="N">No</option>
                </select>

                <span>
                    <?php echo $e2; ?>
                </span>
                <br></br>
                <button type="submit" name="submit"> Submit </button>

                <?php echo $htmlmessage ?>

            </form>
        </div>

    </section>

</body>

</html>