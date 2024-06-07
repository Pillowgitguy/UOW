<?php
session_start();
include("CinemaManagerNavBar.inc.php");
navbar("FoodAndDrinks");

// for displaying of table
function viewFoodAndDrinksToUpdate()
{
    $displayItems = new CinemaManagerViewFoodAndDrinksCTL();
?>
    <table class="fixed-cm-update-fb-table">
        <tr>
            <th>Item Name</th>
            <th>Item Price</th>
            <td style='background-color:moccasin'>Click to select item to update</td>
        </tr>

        <form action="CinemaManagerUpdateFoodAndDrinksUI.php" method="post">
            <?php
            echo $displayItems->viewUpdateFoodAndDrinks();
            ?>
        </form>
    </table>

    <br><br>
    <?php
    $indexSelected = 0;
    while ($indexSelected < 9999) {
        if (isset($_POST["$indexSelected"])) {
    ?>
            <div class="flex-cm-update-fb">
                <h3 class="link flex-cm-update-fb-title">Update Selected Food And Drinks Item:</h3>
                <table>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Price</th>
                    </tr>

                    <form action="CinemaManagerUpdateFoodAndDrinksUI.php" method="post">
                        <?php
                        echo $displayItems->viewSelectedFoodAndDrinksToUpdate($indexSelected);
                        ?>
                </table>
                <div class="cm-update-fb-button">
                    <button type="submit" name="update">Update</button>
                    <input type="submit" name="back" value="Back">
                </div>
                </form>
            </div>
<?php
            break;
        }
        $indexSelected++;
    }
}

function updateMenuItems($originalItemName, $originalItemPrice, $itemName, $itemPrice)
{
    $update = new CinemaManagerUpdateFoodAndDrinksCTL();
    if ($update->updateFoodAndDrinks($originalItemName, $originalItemPrice, $itemName, $itemPrice)) {
        displaySuccess();
    } else {
        displayError();
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
        <h1 class="center-link">Update Food And Drinks Items</h1>

        <?php
        if (isset($_POST['back'])) {
            header("location: CinemaManagerFoodAndDrinksUI.php");
            exit();
        }

        include_once "Controller\CinemaManagerViewFoodAndDrinksCTL.php";
        viewFoodAndDrinksToUpdate();

        function displaySuccess()
        {
            echo '<script>alert("Food And Drinks item successfully updated!"); setTimeout(function(){ window.location.href = "CinemaManagerUpdateFoodAndDrinksUI.php"; }, 500);</script>';
        }

        function displayError()
        {
            echo '<script>alert("Food And Drinks item fails to update!"); setTimeout(function(){ window.location.href = "CinemaManagerUpdateFoodAndDrinksUI.php"; }, 500);</script>';
        }

        if (isset($_POST["update"])) {
            // retrieving data
            $originalItemName = $_POST["originalItemName"];
            $originalItemPrice = $_POST["originalItemPrice"];
            $itemName = $_POST["itemName"];
            $itemPrice = $_POST["itemPrice"];

            include_once "Controller/CinemaManagerUpdateFoodAndDrinksCTL.php";
            updateMenuItems($originalItemName, $originalItemPrice, $itemName, $itemPrice);
        }
        ?>
    </section>

</body>

</html>