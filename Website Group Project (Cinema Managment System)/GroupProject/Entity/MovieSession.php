<?php

include_once 'db.php';

class MovieSession
{

    // CUSTOMER ------------

    // VIEW MOVIE SESSIONS
    public function getMovieScreeningDetails()
    {

        // connect to database
        global $con;

        $movieScreeningDetails = "";

        try {
            // SQL query to select "moviesession" table
            $sql = "SELECT * FROM moviesession";
            $result = mysqli_query($con, $sql);

            // Array to the return
            $movieArray = array();

            // Go through database row by row 
            while ($row = mysqli_fetch_assoc($result)) {
                array_push(
                    $movieArray,
                    $row['movieName'],
                    $row['screeningDateTime'],
                    $row['movieDescription'],
                    $row['duration'],
                    $row['hallNo']
                );
            }

            $length = count($movieArray);
            for ($y = 0; $y < $length; $y = $y + 5) {
                $movieScreeningDetails .= "<form action='CustomerPurchaseTicketUI.php' method='post'><tr>"
                    . "<td>" . $movieArray[$y] . "</td>"
                    . "<input type='hidden' name='movieName' value='" . $movieArray[$y] . "'/>"
                    . "<td>" . $movieArray[$y + 1] . "</td>"
                    . "<input type='hidden' name='dateTime' value='" . $movieArray[$y + 1] . "'/>"
                    . "<td>" . $movieArray[$y + 2] . "</td>"
                    . "<input type='hidden' name='desc' value='" . $movieArray[$y + 2] . "'/>"
                    . "<td style='text-align:center'>" . $movieArray[$y + 3] . "</td>"
                    . "<input type='hidden' name='duration' value='" . $movieArray[$y + 3] . "'/>"
                    . "<td style='text-align:center'>" . $movieArray[$y + 4] . "</td>"
                    . "<input type='hidden' name='hallNo' value='" . $movieArray[$y + 4] . "'/>"
                    . "<td><button name='purchaseTicket' class='cust-view-movie-session-button'><span>Buy Ticket</span></button></td>"
                    . "</tr></form>";
            }

            // Return the String
            return $movieScreeningDetails;
        } catch (mysqli_sql_exception $e) {
            return $movieScreeningDetails;
        }
    }

    public function getMovieNames()
    {
        // connect to database
        global $con;

        $movieNames = "";

        try {
            $movieArray = array();
            $sql = "SELECT * FROM moviesession";
            $result = mysqli_query($con, $sql);

            // Go through database row by row 
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($movieArray, $row['movieName']);
            }

            $movieNames = "<option value=''>Please select an option:</option>   ";

            $length = count($movieArray);
            for ($x = 0; $x != $length; $x++) {
                $movieNames .= "<option value='" . $movieArray[$x] . "'>" . $movieArray[$x] . "</option>";
            }

            return $movieNames;
        } catch (mysqli_sql_exception $e) {
            return $movieNames;
        }
    }

    // CINEMAMANAGER ------------
    function fetchHalls()
    {
        global $con;
        $sql = "select hallNo from movieHall where suspend = 'N'";
        $results = $con->query($sql);
        return $results;
    }

    function createMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo)
    {
        global $con;

        try {
            $sql = "insert into moviesession(movieName,screeningDateTime,movieDescription,duration,hallNo,suspend) values('$movieName', '$screeningDateTime', '$movieDescription', '$duration', '$hallNo','N')";
            if ($con->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    // VIEW MOVIE SESSION
    function managerRetrieveMovieSession()
    {
        global $con;
        $sql = "select * from moviesession";
        $results = $con->query($sql);
        $displayTable = "<table class='cm-view-movie-session-table'><tr><th>Movie Name</th><th>Movie Description</th><th>Hall No</th><th>Screening Date Time</th><th>Duration</th><th>Suspend</th><th>Update</th><th>Suspend</th></tr>";
        while ($row = $results->fetch_assoc()) {
            $col1 = $row['movieName'];
            $col2 = $row['movieDescription'];
            $col3 = $row['hallNo'];
            $col4 = $row['screeningDateTime'];
            $col5 = $row['duration'];
            $col6 = $row['suspend'];
            $displayTable = $displayTable . "<tr><td style='text-align:left'>$col1</td><td style='text-align:left'>$col2</td><td>$col3</td><td>$col4</td><td>$col5 Minutes</td><td>$col6</td>
            <td><a href='CinemaManagerUpdateMovieSessionUI.php?movieName=$col1&movieDescription=$col2&hallNo=$col3&screeningDateTime=$col4&duration=$col5&suspend=$col6' class='link'>Update</a>
            </td><td><a href='CinemaManagerSuspendMovieSessionUI.php?movieName=$col1&screeningDateTime=$col4' class='link'>Suspend</a></td></tr>";
        }
        $displayTable = $displayTable . "</table>";
        return $displayTable;
    }

    // UPDATE MOVIE SESSION
    function updateMovieSession($movieName, $screeningDateTime, $movieDescription, $duration, $hallNo, $suspend)
    {
        global $con;
        $sql = "update moviesession SET movieDescription = '$movieDescription',duration = '$duration',hallNo = '$hallNo',suspend = '$suspend' where movieName = '$movieName' and screeningDateTime = '$screeningDateTime';";
        if ($con->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // SUSPEND MOVIE SESSION
    function suspendMovieSession($movieName, $screeningDateTime)
    {
        global $con;
        $sql = "update moviesession SET suspend = 'Y' where movieName = '$movieName' and screeningDateTime = '$screeningDateTime'";
        if ($con->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // SEARCH MOVIE SESSION
    function retrieveData($movieName)
    {
        global $con;
        $sql = "select * from moviesession where movieName LIKE '%$movieName%'";
        $results = $con->query($sql);
        $displayTable = "<table class='cm-view-movie-session-table'><tr><th>Movie Name</th><th>Movie Description</th><th>Hall No</th><th>Screening Date Time</th><th>Duration</th><th>Suspend</th><th>Update</th><th>Suspend</th></tr>";
        while ($row = $results->fetch_assoc()) {
            $col1 = $row['movieName'];
            $col2 = $row['movieDescription'];
            $col3 = $row['hallNo'];
            $col4 = $row['screeningDateTime'];
            $col5 = $row['duration'];
            $col6 = $row['suspend'];
            $displayTable = $displayTable . "<tr><td>$col1</td><td>$col2</td><td>$col3</td><td>$col4</td><td>$col5 Minutes</td><td>$col6</td>
            <td><a href='CinemaManagerUpdateMovieSessionUI.php?movieName=$col1&movieDescription=$col2&hallNo=$col3&screeningDateTime=$col4&duration=$col5&suspend=$col6' class='link'>Update</a>
            </td><td><a href='CinemaManagerSuspendMovieSessionUI.php?movieName=$col1&screeningDateTime=$col4' class='link'>Suspend</a></td></tr>";
        }
        $displayTable = $displayTable . "</table>";
        return $displayTable;
    }
}
