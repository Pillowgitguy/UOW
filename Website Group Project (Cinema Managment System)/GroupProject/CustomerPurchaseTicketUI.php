<?php
session_start();
include("CustomerNavBar.inc.php");
navbar("MovieSession");
include_once 'Controller/CustomerPurchaseTicketCTL.php';

function createTicket($username, $mName, $seat, $ticketType)
{
	$htmlmessage = "";
	$custCreateTicket = new CustomerPurchaseTicketCTL();
	$result = $custCreateTicket->ticketCreation($username, $mName, $seat, $ticketType);
	// Check if table was updated
	if ($result) {
		$htmlmessage = <<<BOX
		<div class='purchase-ticket-message alertSuccess'>
			<span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
			Ticket successfully purchased! Returning to Movie Sessions page in 3 seconds ...
		</div>
		BOX;

		// for displaying of form again
		purchaseTicket($_SESSION["movieName"], $_SESSION["dateTime"], $_SESSION["desc"], $_SESSION["duration"], $_SESSION["hallNo"], $htmlmessage);
		unset($_SESSION['movieName']);
		unset($_SESSION['dateTime']);
		unset($_SESSION['desc']);
		unset($_SESSION['duration']);
		//wait for 3 seconds
		echo "<meta http-equiv='refresh' content='3;url=CustomerViewMovieSessionUI.php'>";
	} else {
		$htmlmessage = <<<BOX
		<div class='purchase-ticket-message alertError'>
			<span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
			Unsuccessful purchase! Please try again ...
		</div>
		BOX;
		// show page details again
		purchaseTicket($_SESSION["movieName"], $_SESSION["dateTime"], $_SESSION["desc"], $_SESSION["duration"], $_SESSION["hallNo"], $htmlmessage);
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

	<?php
	// for displaying of form
	function purchaseTicket($movieName, $dateTime, $desc, $duration, $hallNo, $htmlmessage)
	{
		$custPurchaseTicket = new CustomerPurchaseTicketCTL();
	?>
		<form action="CustomerPurchaseTicketUI.php" method="post" class="center">
			<section class="center-child">
				<div>
					<label for="mName">Movie Name:</label>
					<div class="link"><?php echo $movieName; ?></div>
					<input type="hidden" id="mName" name="mName" value="<?php echo $movieName; ?>" />
				</div>

				<div>
					<label for="mDateTime">Date & Time:</label>
					<div class="link"><?php echo $dateTime; ?></div>
				</div>

				<div>
					<label for="mDesc">Description:</label>
					<div class="link"><?php echo $desc; ?></div>
				</div>

				<div>
					<label for="mDuration">Duration (minutes):</label>
					<div class="link"><?php echo $duration; ?></div>
				</div>
				<hr>
				<div>
					<label for="mSeat">Select a seat:</label>
					<select id='seat' name='seat'>
						<?php
						echo $custPurchaseTicket->selectSeat($movieName, $hallNo);
						?>
					</select>
				</div>

				<div>
					<label for="mTicketType">Select ticket type:</label>
					<select id='ticketType' name='ticketType'>
						<?php
						echo $custPurchaseTicket->selectTicketType();
						?>
					</select>
				</div>

			</section>

			<button name="confirmPurchaseTicket" class="cust-purchase-ticket-button"><span>Confirm Ticket Purchase</span></button>

			<?php echo $htmlmessage ?>
		</form>
	<?php
	}
	?>

	<?php
	if (isset($_POST["purchaseTicket"])) {
		// to store POST values
		$_SESSION['movieName'] = $_POST["movieName"];
		$_SESSION['dateTime'] = $_POST["dateTime"];
		$_SESSION['desc'] = $_POST["desc"];
		$_SESSION['duration'] = $_POST["duration"];
		$_SESSION['hallNo'] = $_POST["hallNo"];
		$htmlmessage = "";
		// for displaying of form
		purchaseTicket($_POST["movieName"], $_POST["dateTime"], $_POST["desc"], $_POST["duration"], $_POST["hallNo"], $htmlmessage);
	}

	if (isset($_POST["confirmPurchaseTicket"])) {
		createTicket($_SESSION['username'], $_POST["mName"], $_POST["seat"], $_POST["ticketType"]);
	}
	?>

	<!--View movie link-->
	<a href="CustomerViewMovieSessionUI.php" class="center-link link">Back</a>

</body>

</html>