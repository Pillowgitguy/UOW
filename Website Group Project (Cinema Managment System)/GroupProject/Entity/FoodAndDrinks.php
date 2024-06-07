<?php

include_once 'db.php';

class FoodAndDrinks
{

    // CREATE F&B
    public function setNewFoodAndDrinksItem($newItemName, $newItemPrice)
    {
        global $con;
        $createSuccess = true;

        try {
            $query = "SELECT * FROM foodanddrink WHERE itemName = '$newItemName' AND itemPrice = '$newItemPrice';";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $createSuccess = false;
                $con->close();
            } else {
                $query = "INSERT INTO foodanddrink (itemName, itemPrice, suspend) VALUES ('$newItemName', '$newItemPrice', 'N');";
                mysqli_query($con, $query);
                $con->close();
                $createSuccess = true;
            }
        } catch (mysqli_sql_exception $e) {
            $createSuccess = false;
        }

        return $createSuccess;
    }

    // VIEW FOOD AND DRINKS 
    public function getFoodAndDrinksItems()
    {
        global $con;
        $items = [];

        $viewFBTable = "";

        try {
            $sql = "SELECT * FROM foodanddrink;";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                // Add all rows to an array
                $items[] = $row;
            }
            $con->close();
        } catch (mysqli_sql_exception $e) {
            return $viewFBTable;
        }

        foreach ($items as $row) {
            $viewFBTable .= '<tr>';
            foreach ($row as $columnName => $column) {
                if ($columnName == "itemName")
                    $viewFBTable .=  "<td style='text-align:left'>" . $column . "</td>";
                else
                    $viewFBTable .=  "<td>" . $column . "</td>";
            }
            $viewFBTable .= '<tr>';
        }

        return $viewFBTable;
    }

    // for displaying of table
    public function getUpdateFoodAndDrinksItems()
    {
        global $con;
        $items = [];

        $viewUpdateFBTable = "";

        try {
            $sql = "SELECT * FROM foodanddrink;";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $items[] = $row;
            }
            //$con->close();
        } catch (mysqli_sql_exception $e) {
            return $viewUpdateFBTable;
        }

        foreach ($items as $index => $row) {
            $viewUpdateFBTable .= '<tr>';
            foreach ($row as $columnName => $column) {
                if ($columnName == "itemName")
                    $viewUpdateFBTable .= "<td style='text-align:left'>" . $column . "</td>";
                else if ($columnName != "suspend")
                    $viewUpdateFBTable .= "<td>" . $column . "</td>";
            }
            $viewUpdateFBTable .= "<td style='text-align:center'><button type='submit' name='$index'>Select</button></td><tr>";
        }

        return $viewUpdateFBTable;
    }

    // for displaying of table
    public function getSelectedFoodAndDrinksItem($indexSelected)
    {
        global $con;
        $items = [];

        $updateFBTable = "";

        try {
            $sql = "SELECT * FROM foodanddrink;";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $items[] = $row;
            }
            $con->close();
        } catch (mysqli_sql_exception $e) {
            return $updateFBTable;
        }

        foreach ($items as $index => $row) {
            if ($index == $indexSelected) {
                $updateFBTable .= '<tr>';
                foreach ($row as $columnName => $columnValue) {
                    switch ($columnName) {
                        case "itemName":
                            $updateFBTable .= "<input type='hidden' name='originalItemName' value='$columnValue'>"
                                . "<td><input type='text' name='itemName' id='itemName' value='$columnValue' size='50'></td>";
                            break;
                        case "itemPrice":
                            $updateFBTable .= "<input type='hidden' name='originalItemPrice' value='$columnValue'>"
                                . "<td><input type='text' name='itemPrice' id='itemPrice' value='$columnValue'></td>";
                            break;
                    }
                }
                $updateFBTable .= '<tr>';
            }
        }

        return $updateFBTable;
    }

    // for displaying of table
    public function getSuspendFoodAndDrinksItems()
    {
        global $con;
        $items = [];

        $suspendFBTable = "";

        try {
            $sql = "SELECT * FROM foodanddrink;";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $items[] = $row;
            }
            $con->close();
        } catch (mysqli_sql_exception $e) {
            return $suspendFBTable;
        }

        foreach ($items as $index => $row) {
            $suspendFBTable .= '<tr>';
            foreach ($row as $columnName => $column) {
                if ($columnName == "itemName")
                    $suspendFBTable .= "<td style='text-align:left'>" . $column . "</td>";
                else
                    $suspendFBTable .= "<td>" . $column . "</td>";
            }

            if ($column == 'Y') {
                $suspendFBTable .= "<td style='text-align:center'><button type='submit' name='$index' disabled style='border:2px solid red'>Suspend</button></td>";
            } else {
                $suspendFBTable .= "<td style='text-align:center'><button type='submit' name='$index' style='border:2px solid green;cursor:pointer'>Suspend</button></td>";
            }
            $suspendFBTable .= '<tr>';
        }

        return $suspendFBTable;
    }

    // UPDATE FOOD AND DRINKS
    public function setFoodAndDrinks($originalItemName, $originalItemPrice, $itemName, $itemPrice)
    {
        global $con;

        try {
            $query = "SELECT * FROM foodanddrink WHERE itemName = '$itemName' AND itemPrice = '$itemPrice';";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $con->close();
                return false;
            } else {
                $sql = "UPDATE foodanddrink SET itemName = '$itemName', itemPrice = '$itemPrice' WHERE itemName = '$originalItemName' AND itemPrice = '$originalItemPrice';";
                $result = mysqli_query($con, $sql);
                $con->close();
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    // SUSPEND FOOD AND DRINKS
    public function suspendFoodAndDrinks($indexSelected)
    {
        global $con;

        $sql = "SELECT * FROM foodanddrink;";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }

        foreach ($items as $index => $row) {
            if ($index == $indexSelected) {
                foreach ($row as $columnName => $columnValue) {
                    switch ($columnName) {
                        case "itemName":
                            $itemName = $columnValue;
                            break;
                        case "itemPrice":
                            $itemPrice = $columnValue;
                            break;
                    }
                }
            }
        }

        $sql = "UPDATE foodanddrink SET suspend = 'Y' WHERE itemName = '$itemName' AND itemPrice = '$itemPrice';";
        $result = mysqli_query($con, $sql);

        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    // SEARCH F&B
    public function getItem($itemName)
    {
        global $con;

        $searchItem = "";

        try {
            $sql = "SELECT * FROM foodanddrink WHERE itemName = '$itemName';";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                $findItem = mysqli_fetch_assoc($result);
                $con->close();
            } else {
                $con->close();
                return $searchItem;
            }
        } catch (mysqli_sql_exception $e) {
            return $searchItem;
        }

        foreach ($findItem as $value) {
            $searchItem .= "<td>" . $value . "</td>";
        }

        return $searchItem;
    }
}
