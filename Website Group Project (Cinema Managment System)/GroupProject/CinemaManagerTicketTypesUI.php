<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("TicketType");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>

    <h2 class="center-link">Ticket Types</h2>
    <p class="center-link">Please select a Ticket Type feature to begin ! </P>

    <div class="center-horizontal">
        <a href="CinemaManagerCreateNewTicketTypeUI.php" class="link no-line">
            > Create New Ticket Type
        </a>
    </div>

    <div class="center-horizontal">
        <a href="CinemaManagerViewAllTicketTypesUI.php" class="link no-line">
            > View All Ticket Types
        </a>
    </div>

    <div class="center-horizontal">
        <a href="CinemaManagerUpdateTicketTypeUI.php" class="link no-line">
            > Update Ticket Type
        </a>
    </div>

    <div class="center-horizontal">
        <a href="CinemaManagerSuspendTicketTypeUI.php" class="link no-line">
            > Suspend Ticket Type
        </a>
    </div>

    <div class="center-horizontal">
        <a href="CinemaManagerSearchTicketTypeUI.php" class="link no-line">
            > Search Ticket Type
        </a>
    </div>

</body>

</html>