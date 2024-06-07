<?php

include_once "Entity/FoodAndDrinks.php";

class CinemaManagerSearchFoodAndDrinksCTL
{

    public function searchFoodAndDrinks($itemName)
    {
        $searchFoodAndDrinksItems = new FoodAndDrinks();
        return ($searchFoodAndDrinksItems->getItem($itemName));
    }
}
