<?php

include_once "Entity/FoodAndDrinks.php";

class CinemaManagerUpdateFoodAndDrinksCTL
{

    public function updateFoodAndDrinks($originalItemName, $originalItemPrice, $itemName, $itemPrice)
    {
        $updateFoodAndDrinksItem = new FoodAndDrinks();
        // $updateFoodAndDrinksItem->setFoodAndDrinks($originalItemName, $originalItemPrice, $itemName, $itemPrice);
        return ($updateFoodAndDrinksItem->setFoodAndDrinks($originalItemName, $originalItemPrice, $itemName, $itemPrice));
    }
}
