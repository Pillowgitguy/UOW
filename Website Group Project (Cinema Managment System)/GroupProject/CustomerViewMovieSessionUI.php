<?php
include("CustomerNavBar.inc.php");
navbar("MovieSession");
include_once 'Controller/CustomerViewMovieSessionCTL.php';

// Display the array
function viewMovieSession()
{
	// Create the control class
	$movieScreeningDetails = new CustomerViewMovieSessionCTL();
	echo $movieScreeningDetails->viewMovieDetails();
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

	<div class="center-horizontal">
		<h2>Now Showing</h2>
	</div>

	<!-- Table first row-->
	<table class="cust-view-movie-session-table">
		<tr>
			<th>Movie Name</th>
			<th>Date & Time</th>
			<th>Description</th>
			<th>Duration</th>
			<th>Hall No.</th>
		</tr>
		<!-- calling of function to display the movie details-->
		<?php
		viewMovieSession();
		?>
	</table>

	<div class="pre-purchase-fb-link">
		<a href="CustomerPrePurchaseFoodAndDrinksUI.php" class="link">Pre-Purchase Food And Drinks</a>
	</div>
	<br><br><br>
</body>

</html>