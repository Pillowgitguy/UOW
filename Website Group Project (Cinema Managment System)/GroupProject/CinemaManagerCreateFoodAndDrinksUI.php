<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("FoodAndDrinks");

function createMenuItem($newItemName, $newItemPrice)
{
    $setNewItem = new CinemaManagerCreateFoodAndDrinksCTL();

    if ($setNewItem->createFoodAndDrinks($newItemName, $newItemPrice)) {
        displaySuccess();
    } else {
        displayError();
    }
}

function displaySuccess()
{
    $htmlmessage = <<<SUCCESS
    <div class='alertSuccess'>
        <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
        New Menu Item successfully added!
    </div>
    SUCCESS;
    echo $htmlmessage;
}

function displayError()
{
    $htmlmessage = <<<ERROR
    <div class='alertError'>
        <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
        Menu Item already exists!
    </div>
    ERROR;
    echo $htmlmessage;
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

    <section class="center-link">
        <h1>Create New Food And Drinks Item</h1>

        <form action="CinemaManagerCreateFoodAndDrinksUI.php" method="post">
            <br>
            <label for="itemName" class="bold">New Food and Drinks Item:</label>
            <input type="text" name="itemName" id="itemName">
            <br><br>
            <label for="itemPrice" class="bold">Set Item Price:</label>
            <input type="text" name="itemPrice" id="itemPrice">
            <br>
            <br>
            <button type="submit" name="submit">Create</button>
            <button type="submit" name="back">Back</button>
            <br>
            <br>
        </form>

        <?php
        if (isset($_POST["submit"])) {
            $newItemName = $_POST["itemName"];
            $newItemPrice = $_POST["itemPrice"];

            include_once "Controller\CinemaManagerCreateFoodAndDrinksCTL.php";
            createMenuItem($newItemName, $newItemPrice);
        } else if (isset($_POST["back"])) {
            header("location: CinemaManagerFoodAndDrinksUI.php");
            exit();
        }
        ?>
    </section>

</body>

</html>