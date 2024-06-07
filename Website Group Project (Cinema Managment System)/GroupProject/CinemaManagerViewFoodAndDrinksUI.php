<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("FoodAndDrinks");

function managerViewFoodAndDrinks()
{
    $displayItems = new CinemaManagerViewFoodAndDrinksCTL();
    $items = $displayItems->viewFoodAndDrinks();
    echo $items;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>

    <section>
        <h1 class="center-link">View Food And Drinks Items</h1>

        <table class="cm-view-fb-table">
            <tr>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Suspend</th>
            </tr>
            <?php
            include_once "Controller/CinemaManagerViewFoodAndDrinksCTL.php";
            managerViewFoodAndDrinks();
            ?>
        </table>
    </section>
    <button onclick="history.back()" class="button cm-view-fb-back"><span>Back</span></button>
</body>

</html>