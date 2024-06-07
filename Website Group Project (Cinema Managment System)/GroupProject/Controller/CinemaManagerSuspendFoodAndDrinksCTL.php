<?php

include_once "Entity/FoodAndDrinks.php";

class CinemaManagerSuspendFoodAndDrinksCTL
{

    public function suspendFoodAndDrinks($indexSelected)
    {
        $suspendFoodAndDrinksItem = new FoodAndDrinks();
        return $suspendFoodAndDrinksItem->suspendFoodAndDrinks($indexSelected);
    }
}
