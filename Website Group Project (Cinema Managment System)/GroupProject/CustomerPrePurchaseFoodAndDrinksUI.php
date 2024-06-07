<?php
session_start();
include("CustomerNavBar.inc.php");
navbar("MovieSession");
include_once 'Controller/CustomerPrePurchaseFoodAndDrinksCTL.php';

function createPurchaseFoodAndDrinks()
{
	$foodAndDrinkDetails = new CustomerPrePurchaseFoodAndDrinksCTL();
	$result = $foodAndDrinkDetails->createPurchaseFoodAndDrinks(
		$_SESSION['username'],
		$_POST["fDNAme"],
		$_POST["fDQuantity"],
		$_POST["cinema"]
	);

	$htmlmessage = "";
	// Check if table was updated
	if ($result) {
		$htmlmessage = <<<SUCCESS
		<div class='pre-purchase-fb-message alertSuccess'>
			<span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
			Food And Drinks item successfully purchased!
			<br>	
			Returning to Movie Sessions page in 3 seconds...
		</div>
		SUCCESS;
		echo $htmlmessage;
		//wait for 3 seconds
		echo "<meta http-equiv='refresh' content='3;url=CustomerViewMovieSessionUI.php'>";
	} else {
		$htmlmessage = <<<ERROR
		<div class='pre-purchase-fb-message alertError'>
			<span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
			Unsuccessful purchase, please select all options!
		</div>
		ERROR;
		echo $htmlmessage;
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
	function purchaseOfFoodAndDrinks()
	{
		// Create the control class
		$foodAndDrinkDetails = new CustomerPrePurchaseFoodAndDrinksCTL();
	?>
		<div class="center-horizontal" style="max-width:260px">
			<h2>Food and Drink Menu</h2>
		</div>

		<!-- Table first row-->

		<div class="container-pre-purchase-fb">
			<table class="fixed-pre-purchase-fb-table">
				<tr>
					<th>Item Name</th>
					<th>Item price</th>
				</tr>
				<!-- calling of function to display the food and drink details-->
				<?php
				echo $foodAndDrinkDetails->viewFoodAndDrinks();
				?>
			</table>

			<div class="flex-pre-purchase-fb">
				<h3 class="link" style="margin-bottom:12px">Pre-Purchase Your Food And Drinks:</h3>
				<form action="CustomerPrePurchaseFoodAndDrinksUI.php" method="post">
					<div>
						<label for="fDNAme">Select a food or drink:</label>
						<select id='fDNAme' name='fDNAme'>
							<?php
							echo $foodAndDrinkDetails->viewFoodAndDrinksForPurchase();
							?>
						</select>
					</div>
					<div>
						<label for="fDQuantity">Select quantity:</label>
						<input id='fDQuantity' name='fDQuantity' type="number" min="1" />
					</div>
					<div>
						<label for="cinema">Cinema:</label>
						<select id='cinema' name='cinemaDisabled' disabled>
							<?php
							echo $foodAndDrinkDetails->viewCinema();
							?>
							<input type="hidden" name="cinema" value="GV" />
						</select>
					</div>
					<button type="submit" name="purchaseFD" class="cust-pre-purchase-fb-button"><span>Purchase Food and Drink</span></button>
				</form>

				<!--View movie link-->
				<a href="CustomerViewMovieSessionUI.php" class="side-link link">Back</a>
			</div>
		</div>

	<?php
	}

	// for displaying of table and form
	purchaseOfFoodAndDrinks();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		createPurchaseFoodAndDrinks();
	}
	?>

</body>

</html>