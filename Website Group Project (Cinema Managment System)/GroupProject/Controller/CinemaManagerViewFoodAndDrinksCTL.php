<?php

include_once "Entity/FoodAndDrinks.php";

class CinemaManagerViewFoodAndDrinksCTL
{

    // for View Food and Drinks table
    public function viewFoodAndDrinks()
    {
        $foodAndDrinksItems = new FoodAndDrinks();
        return ($foodAndDrinksItems->getFoodAndDrinksItems());
    }

    // for displaying other tables
    public function viewUpdateFoodAndDrinks()
    {
        $foodAndDrinksItems = new FoodAndDrinks();
        return ($foodAndDrinksItems->getUpdateFoodAndDrinksItems());
    }

    public function viewSelectedFoodAndDrinksToUpdate($indexSelected)
    {
        $foodAndDrinksItems = new FoodAndDrinks();
        return ($foodAndDrinksItems->getSelectedFoodAndDrinksItem($indexSelected));
    }

    public function viewSuspendFoodAndDrinks()
    {
        $foodAndDrinksItems = new FoodAndDrinks();
        return ($foodAndDrinksItems->getSuspendFoodAndDrinksItems());
    }
}
