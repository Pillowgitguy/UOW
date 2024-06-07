<?php
include("CinemaManagerNavBar.inc.php");
navbar("TicketType");
include_once("Controller/CinemaManagerUpdateTicketTypeCTL.php");
$ticketType = "";
$ticketPrice = "";
$e1 = "";
$e2 = "";
$htmlmessage = "";
$retrieveAllTicketType = "";

if (isset($_POST["submit"])) {
    validatEmptyOption($e1);
    validatEmptyTicketPrice($e2);
    if (empty($e1) && empty($e2)) {
        editTicketType($_POST["ticketType"], $_POST["ticketPrice"]);
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

function validatEmptyTicketPrice(&$e2)
{
    global $ticketPrice;
    $ticketPrice = trim($_POST["ticketPrice"]);
    if (empty($ticketPrice)) {
        $e2 = "Please fill in the Ticket Price!";
    }
}

function editTicketType($ticketType, $ticketPrice)
{
    global $htmlmessage;
    $pSUC = new CinemaManagerUpdateTicketTypeCTL();
    $results = $pSUC->editTicketType($ticketType, $ticketPrice);
    if ($results == true) {
        $htmlmessage = <<<SUCCESS
        <div class='cm-tt-create-message alertSuccess'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Update Ticket Success :)
        </div>
        SUCCESS;
    } else {
        $htmlmessage = "Update Ticket Failed";
    }
}

// for dropdown list
function retrieveTicketType()
{
    global $options;
    $rup = new CinemaManagerUpdateTicketTypeCTL();
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
            <h2 class="center-link">Update Ticket Type</h2>
            <p>Please fill up the form and click on submit to update ticket type!</p>
            <form action="CinemaManagerUpdateTicketTypeUI.php" method="post">
                <?php echo retrieveTicketType(); ?>
                <h4>Ticket Type</h4>
                <select name="ticketType" id="ticketType" style="margin-top:0px">
                    <option value="" disable selected hidden>Please Select A Option</option>
                    <?php echo $options; ?>
                </select>

                <span>
                    <?php echo $e1; ?>
                </span>

                <h4>Ticket Price</h4><input type="text" name="ticketPrice" style="margin-left:0px" placeholder="Enter Ticket Price To Update" cols="32">

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