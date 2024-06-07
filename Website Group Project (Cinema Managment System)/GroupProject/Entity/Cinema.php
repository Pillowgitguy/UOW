<?php
include_once 'db.php';


class Cinema
{

    public function retrieveCinemaName()
    {
        global $con;
        $option = "";
        $sql = "SELECT cinemaName FROM cinema;";

        try {
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
                    $option .= '<option value="' . $row["cinemaName"] . '">' . $row["cinemaName"] . '</option>';
                }
                // RETURNING STRING CONTAINING ALL OPTIONS
                return $option;
            }
        } catch (mysqli_sql_exception $e) {
            return $option;
        }
    }
}
