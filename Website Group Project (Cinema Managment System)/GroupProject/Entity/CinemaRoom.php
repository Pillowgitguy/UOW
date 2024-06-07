<?php
include_once 'db.php';

class CinemaRoom
{

    // CREATE CINEMA ROOM
    public function createNewCinemaRoom($cinemaRoomNo, $cinemaName)
    {
        global $con;
        $sql = "SELECT * FROM movieHall WHERE hallNo = '$cinemaRoomNo' AND cinemaName = '$cinemaName';";

        try {
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                return false;
            } else {

                $sql = "INSERT INTO movieHall VALUES ('$cinemaRoomNo','$cinemaName','N');";
                $result = mysqli_query($con, $sql);


                $sql = "INSERT INTO seat VALUES ('A1','$cinemaRoomNo'),('A2','$cinemaRoomNo'),('A3','$cinemaRoomNo'),('B1','$cinemaRoomNo'),('B2','$cinemaRoomNo'),('B3','$cinemaRoomNo');";
                $result = mysqli_query($con, $sql);

                if ($result == true) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    // parameter is optional as it is shared between RetrieveAll & Search
    public function searchCinemaRoom($cinemaRoom = '')
    {
        global $con;

        $tableContent = "";
        //if theres any search criteria, it will concat to the statement
        $sql = "SELECT * FROM moviehall";

        if ($cinemaRoom != '') {
            $sql .= " WHERE hallNo = '$cinemaRoom'";
        }
        $sql .= ";";



        try {
            $result = mysqli_query($con, $sql);
            $con->close();

            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {


                    $tableContent .= '<form action="CinemaManagerUpdateCinemaRoomUI.php" method="post">
                                        <li class="table-row">
                                            <div class="oddRow sCode" >' . $row["hallNo"] . '</div>
                                            <input type="hidden" name="cinemaRoomNo" value="' . $row['hallNo'] . '" />
                    
                                            <div class="sName" >' . $row["cinemaName"] . '</div>
                                            <input type="hidden" name="cinemaName" value="' . $row['cinemaName'] . '" />
                    
                                            <div class="sSTime" >' . $row["suspend"] . '</div>
                                            <input type="hidden" name="suspend" value="' . $row['suspend'] . '" />';


                    $tableContent .= '</li></form>';
                }
            } else {
                $tableContent = "<h3 style='color:#f44336e5'>No Room found</h3>";
            }
            // $tableContent now holds all records of cinemaRoom in a form each, returned as a string back to CTL, then to Boundary
            return $tableContent;
        } catch (mysqli_sql_exception $e) {
            return $tableContent;
        }
    }

    // VIEW CINEMA ROOM
    public function retrieveCinemaRoom()
    {
        global $con;

        $tableContent = "";

        $sql = "SELECT * FROM moviehall";

        try {
            $result = mysqli_query($con, $sql);
            $con->close();

            while ($row = $result->fetch_assoc()) {
                $tableContent .= '<form action="CinemaManagerUpdateCinemaRoomUI.php" method="post">
                                        <li class="table-row">
                                            <div class="oddRow sCode" >' . $row["hallNo"] . '</div>
                                            <input type="hidden" name="cinemaRoomNo" value="' . $row['hallNo'] . '" />
                    
                                            <div class="sName" >' . $row["cinemaName"] . '</div>
                                            <input type="hidden" name="cinemaName" value="' . $row['cinemaName'] . '" />
                    
                                            <div class="sSTime" >' . $row["suspend"] . '</div>
                                            <input type="hidden" name="suspend" value="' . $row['suspend'] . '" />
                    
                                            <input type="submit" name="editRoomInfo" value="Update" class="extra" data-label="edit">';


                if ($row["suspend"] == "N") {
                    $tableContent .= '<a href="CinemaManagerSuspendCinemaRoomUI.php?cinemaRoomNo=' . $row["hallNo"] . '" class="link">Suspend</a>';
                } else if ($row['suspend'] == "Y") {
                    $tableContent .= '<a role="link" aria-disabled="true" style="color:#A9A9A9">Suspend</a>';
                }

                $tableContent .= '</li></form>';
            }

            // $tableContent now holds all records of cinemaRoom in a form each, returned as a string back to CTL, then to Boundary
            return $tableContent;
        } catch (mysqli_sql_exception $e) {
            return $tableContent;
        }
    }

    // UPDATE CINEMA ROOM
    public function updateCinemaRoomInfo($cinemaRoomNo, $cinemaName, $suspend)
    {
        global $con;
        $sql = "UPDATE movieHall SET suspend ='$suspend' WHERE hallNo = '$cinemaRoomNo' AND cinemaName = '$cinemaName';";

        try {
            $result = mysqli_query($con, $sql);
            $con->close();

            if ($result == true) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    // SUSPEND CINEMA ROOM
    public function suspendCinemaRoom($cinemaRoomNum)
    {
        global $con;

        $sql = "UPDATE moviehall SET suspend = 'Y' WHERE hallNo = '$cinemaRoomNum';";

        try {
            $result = mysqli_query($con, $sql);
            $con->close();
            if ($result == true) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }
}
