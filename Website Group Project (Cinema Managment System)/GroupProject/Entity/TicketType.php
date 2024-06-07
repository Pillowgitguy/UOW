<?php

include_once 'db.php';

class TicketType
{

    // CUSTOMER ------------
    public function getTicketTypes()
    {
        // connect to database
        global $con;

        $ticketTypes = "";

        try {
            $ticketTypeArray = array();
            $sql = "SELECT * FROM tickettype";
            $result = mysqli_query($con, $sql);

            // Go through database and count number of Movies
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($ticketTypeArray, $row['ticketType']);
            }

            $ticketTypes = "<option selected hidden>Please select an option</option>";

            $length = count($ticketTypeArray);
            for ($x = 0; $x != $length; $x++) {
                $ticketTypes .= "<option value='" . $ticketTypeArray[$x] . "'>" . $ticketTypeArray[$x] . "</option>";
            }

            return $ticketTypes;
        } catch (mysqli_sql_exception $e) {
            return $ticketTypes;
        }
    }

    // CINEMA MANAGER ------------

    // CREATE TICKET TYPE
    function createNewTicketType($ticketType, $ticketPrice, $status)
    {
        global $con;
        $sql = "SELECT * FROM tickettype WHERE ticketType = '$ticketType'";
        $results = $con->query($sql);

        if ($results->num_rows > 0) {
            return false;
        } else {
            $sql = "INSERT INTO tickettype(ticketType,ticketPrice,suspend) values('$ticketType','$ticketPrice','$status');";
            if ($con->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
    }

    // for dropdown list
    function retrieveTicketType()
    {
        global $con;
        $results = $con->query("SELECT * FROM tickettype");
        $options = "";
        while ($row = $results->fetch_assoc()) {
            $options .= '<option value="' . $row["ticketType"] . '">' . $row["ticketType"] . '</option>';
        }
        return $options;
    }

    // VIEW TICKET TYPES
    function viewTicketTypes()
    {
        global $con;
        $results = $con->query("SELECT * FROM tickettype");
        $displayTable = "<table class='cm-tt-view'><tr><th>Ticket Type</th><th>Ticket Price</th><th>Suspend Status</th></tr>"; // table its not close 
        while ($row = $results->fetch_assoc()) {
            $field1name = $row["ticketType"];
            $field2name = $row["ticketPrice"];
            $field3name = $row["suspend"];

            $displayTable = $displayTable . "<tr><td>{$field1name}</td><td>{$field2name}</td><td>{$field3name}</td></tr>";
        }
        $displayTable = $displayTable . "</table>"; // close table here 
        return $displayTable;
    }

    // UPDATE TICKET TYPE
    function editTicketType($ticketType, $ticketPrice)
    {
        global $con;
        $sql = "UPDATE tickettype SET ticketPrice='$ticketPrice' WHERE ticketType='$ticketType'";

        if ($con->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // SUSPEND TICKET TYPE
    function suspendTicketType($ticketType, $status)
    {
        global $con;
        $sql = "UPDATE tickettype SET suspend='$status' WHERE ticketType='$ticketType'";

        if ($con->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // SEARCH TICKET TYPE
    function searchTicketType($ticketType)
    {
        global $con;
        $sql = "SELECT * FROM tickettype WHERE ticketType = '$ticketType'";
        $results = $con->query($sql);

        if ($results->num_rows > 0) {
            $results = $con->query("SELECT * FROM tickettype WHERE ticketType='$ticketType'");
            $displayTable = "<table class='cm-tt-search'><tr><th>Ticket Type</th><th>Ticket Price</th><th>Suspend Status</th></tr>"; // table its not close 
            while ($row = $results->fetch_assoc()) {
                $field1name = $row["ticketType"];
                $field2name = $row["ticketPrice"];
                $field3name = $row["suspend"];

                $displayTable = $displayTable . "<tr><td>{$field1name}</td><td>{$field2name}</td><td>{$field3name}</td></tr>";
            }
            $displayTable = $displayTable . "</table>"; // close table here 
            return $displayTable;
        } else {
            $displayTable = "Ticket Type Do Not Exist!";
            return $displayTable;
        }
    }
}
