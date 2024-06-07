<?php
include("CinemaManagerNavBar.inc.php");
navbar("TicketType");
include_once("Controller/CinemaManagerViewAllTicketTypesCTL.php");

$displayTable = "";
$ticketType = "ticketType";

if (isset($_POST["View"])) {
  viewTicketTypes();
}

function viewTicketTypes()
{
  global $displayTable;
  $up = new CinemaManagerViewAllTicketTypesCTL();
  $displayTable = $up->viewTicketTypes();
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

  <section>
    <div>
      <h2 class="center-link">View All Ticket Types</h2>
      <p class="center-link">Click on View to start!</p>
      <form action="CinemaManagerViewAllTicketTypesUI.php" method="post" class="center-link">
        <button type="View" name="View" class="cm-tt-view-button"><span> View </span></button>
        <?php echo $displayTable; ?>
      </form>
    </div>
  </section>

</body>

</html>