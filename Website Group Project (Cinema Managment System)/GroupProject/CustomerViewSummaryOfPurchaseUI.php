	<?php
	session_start();
	include("CustomerNavBar.inc.php");
	navbar("Summary");
	include_once 'Controller/CustomerViewSummaryOfPurchaseCTL.php';
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

		<div class="center-horizontal" style="max-width:220px">
			<h2>Purchase Summary</h2>
		</div>

		<?php
		function purchaseSummary()
		{
			$summaryPurchase = new CustomerViewSummaryOfPurchaseCTL();

			// calling of function to display summary of purchase details
			echo $summaryPurchase->viewSummaryOfPurchase($_SESSION['username']);
		}

		purchaseSummary();
		?>
		<br>

	</body>

	</html>