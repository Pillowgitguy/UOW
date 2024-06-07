<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("FoodAndDrinks");

function suspendMenuItems($indexSelected)
{
    $suspend = new CinemaManagerSuspendFoodAndDrinksCTL();
    if ($suspend->suspendFoodAndDrinks($indexSelected)) {
        echo '<script>alert("SUCCESS: Food and Drinks Item suspended !"); setTimeout(function(){ window.location.href = "CinemaManagerSuspendFoodAndDrinksUI.php"; }, 300);</script>';
    } else {
        echo '<script>alert("FAIL: Food and Drinks Item failed to suspend !"); setTimeout(function(){ window.location.href = "CinemaManagerSuspendFoodAndDrinksUI.php"; }, 300);</script>';
    }
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
        <h1 class="center-link">Suspend Food And Drinks Items</h1>

        <?php
        if (isset($_POST['back'])) {
            header("location:CinemaManagerFoodAndDrinksUI.php");
            exit();
        }

        // for displaying of table
        include_once "Controller\CinemaManagerViewFoodAndDrinksCTL.php";
        $displayItems = new CinemaManagerViewFoodAndDrinksCTL();

        $indexSelected = 0;
        while ($indexSelected < 9999) {
            if (isset($_POST[$indexSelected])) {
                include_once "Controller/CinemaManagerSuspendFoodAndDrinksCTL.php";
                suspendMenuItems($indexSelected);
            }
            $indexSelected++;
        }
        ?>

        <table class="cm-suspend-fb-table">
            <tr>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Suspend</th>
                <td style='background-color:moccasin'>Click to select item to suspend</td>
            </tr>

            <form action="CinemaManagerSuspendFoodAndDrinksUI.php" method="post">
                <?php
                echo $displayItems->viewSuspendFoodAndDrinks();
                ?>
        </table>
        <button name="back" class="button cm-view-fb-back"><span>Back</span></button>
        </form>

    </section>

</body>

</html>