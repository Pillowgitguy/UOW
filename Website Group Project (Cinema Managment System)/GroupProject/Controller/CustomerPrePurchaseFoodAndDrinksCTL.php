<?php

include_once "Entity/FoodAndDrinksTransactions.php";

class CustomerPrePurchaseFoodAndDrinksCTL
{

	// for displaying of table
	public function viewFoodAndDrinks()
	{
		$foodAndDrinks = new FoodAndDrinksTransactions();
		$result = $foodAndDrinks->getFoodAndDrinks();
		return $result;
	}

	// for displaying of form
	public function viewFoodAndDrinksForPurchase()
	{
		$foodAndDrinks = new FoodAndDrinksTransactions();
		$result = $foodAndDrinks->getFoodAndDrinksForPurchase();
		return $result;
	}

	// for displaying of form
	public function viewCinema()
	{
		$cinema = new FoodAndDrinksTransactions();
		$result = $cinema->getCinema();
		return $result;
	}

	public function createPurchaseFoodAndDrinks($username, $fDNAme, $fDQuantity, $cinema)
	{
		if ($fDQuantity == null) {
			return false;
		} else {
			$purchase = new FoodAndDrinksTransactions();
			$result = $purchase->insertPurchaseFoodAndDrinks($username, $fDNAme, $fDQuantity, $cinema);
			return $result;
		}
	}
}
