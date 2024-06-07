<?php
include("CinemaManagerNavBar.inc.php");
navbar("TicketType");
include_once("Controller/CinemaManagerSearchTicketTypeCTL.php");
$searchTicketTable = "";
$ticketType = "ticketType";
$e1 = "";
$displayTable = "";
$sucessMessage = "";
$failMessage = "";
// create a function in UI first 

if (isset($_POST["Search"])) {
    validateEmptyTicketType($e1);
    if (empty($e1)) {
        searchTicketType($_POST["ticketType"]);
    }
}

function validateEmptyTicketType(&$e1)
{
    global $ticketType;
    $ticketType = trim($_POST["ticketType"]);
    if (empty($ticketType)) {
        $e1 = "Please fill in the Ticket Type To Search !";
    }
}

function searchTicketType($ticketType)
{
    global $displayTable;
    $up = new CinemaManagerSearchTicketTypeCTL();
    $displayTable = $up->searchTicketType($ticketType);
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

    <section class="center-link">
        <div>
            <h2 class="center-link">Search Ticket Type</h2>
            <p>Enter Ticket Type And Click on Search to start!</p>
            <form action="CinemaManagerSearchTicketTypeUI.php" method="post">
                <h4>Ticket Type</h4><input type="text" name="ticketType" style="margin-left:0px" placeholder="Enter Ticket Type">
                <button type="Search" name="Search" class="cm-search-movie-button"><span> Search </span></button>
                <br><br>
                <span style="color:#f44336e5">
                    <?php echo $e1; ?>
                </span>

                <?php echo $displayTable; ?>
            </form>
        </div>

    </section>

</body>

</html>