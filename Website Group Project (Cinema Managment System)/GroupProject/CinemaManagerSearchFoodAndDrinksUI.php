<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("FoodAndDrinks");

function searchMenuItem($itemName)
{
    $searchItem = new CinemaManagerSearchFoodAndDrinksCTL();
    $item = $searchItem->searchFoodAndDrinks($itemName);

    if (!empty($item)) {
?>
        <table class="cm-view-fb-table">
            <tr>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Suspend</th>
            </tr>
    <?php
        echo $item;
    } else {
        displayError();
    }
}

function displayError()
{
    $htmlmessage = <<<ERROR
    <div class='alertError'>
        <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
        Menu Item not found!
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
            <h1>Search for Food And Drinks Items</h1>

            <form action="CinemaManagerSearchFoodAndDrinksUI.php" method="post">
                <br>
                <label for="itemName" class="bold">Name of Food and Drinks Item:</label>
                <input type="text" name="itemName" id="itemName">
                <br>
                <br>
                <button type="submit" name="submit" class="cm-search-movie-button cm-search-fb-button"><span>Search</span></button>
                <button name="back" class="cm-search-movie-button"><span>Back</span></button>
                <br>
            </form>
            <br><br>
            <?php
            if (isset($_POST["submit"])) {
                $itemName = $_POST["itemName"];

                include_once "Controller\CinemaManagerSearchFoodAndDrinksCTL.php";
                searchMenuItem($itemName);
            }

            if (isset($_POST['back'])) {
                header("location:CinemaManagerFoodAndDrinksUI.php");
                exit();
            }
            ?>
        </section>

    </body>

    </html>