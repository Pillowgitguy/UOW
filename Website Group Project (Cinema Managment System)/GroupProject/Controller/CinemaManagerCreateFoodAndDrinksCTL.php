<?php

include_once "Entity/FoodAndDrinks.php";

class CinemaManagerCreateFoodAndDrinksCTL
{

    public function createFoodAndDrinks($newItemName, $newItemPrice)
    {
        $newFoodAndDrinksItem = new FoodAndDrinks();
        return ($newFoodAndDrinksItem->setNewFoodAndDrinksItem($newItemName, $newItemPrice));
    }
}
