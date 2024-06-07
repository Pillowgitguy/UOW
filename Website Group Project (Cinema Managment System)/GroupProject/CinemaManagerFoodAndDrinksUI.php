<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("FoodAndDrinks");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>

    <section class="center-link">
        <h1>Food And Drinks Items</h1>
    </section>

    <div class="center-cm-fb">
        <a href="CinemaManagerCreateFoodAndDrinksUI.php" class="link no-line">> Create New Food And Drinks Item</a>
    </div>
    <div class="center-cm-fb">
        <a href="CinemaManagerViewFoodAndDrinksUI.php" class="link no-line">> View Food And Drinks Items</a>
    </div>
    <div class="center-cm-fb">
        <a href="CinemaManagerUpdateFoodAndDrinksUI.php" class="link no-line">> Update Food And Drinks Items</a>
    </div>
    <div class="center-cm-fb">
        <a href="CinemaManagerSuspendFoodAndDrinksUI.php" class="link no-line">> Suspend Food And Drinks Items</a>
    </div>
    <div class="center-cm-fb">
        <a href="CinemaManagerSearchFoodAndDrinksUI.php" class="link no-line">> Search Food And Drinks Items</a>
    </div>

</body>

</html>