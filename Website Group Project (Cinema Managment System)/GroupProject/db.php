<?php
# connect to Database
global $con;

try {
    $con = new mysqli("localhost", "root", "", "cinema");
} catch (mysqli_sql_exception $e) {
    die($e->getCode() . ": " . $e->getMessage());
}
