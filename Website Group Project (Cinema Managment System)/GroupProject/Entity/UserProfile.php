<?php
include_once("db.php");

class UserProfile
{

    // CREATE USER PROFILE
    function createUserProfile($profileName, $profileDescription, $status)
    {
        global $con;
        $sql = "SELECT * FROM userprofile where profileName = '$profileName'";
        $results = $con->query($sql);
        if ($results->num_rows > 0) {
            return false;
        } else {
            $sql = "insert into userprofile(profileName,profileDescription,suspend) values('$profileName','$profileDescription','$status')";
            if ($con->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
    }

    function retrieveUserProfile()
    {
        global $con;
        $results = $con->query("SELECT * FROM userProfile");
        $options = "";
        while ($row = $results->fetch_assoc()) {
            $options .= '<option value="' . $row["profileName"] . '">' . $row["profileName"] . '</option>';
        }
        return $options;
    }

    // VIEW USER PROFILE
    function viewUserProfile()
    {
        global $con;
        $results = $con->query("SELECT * FROM userProfile");
        $displayTable = "<table class='ua-up-view'><tr><th>Profile Name</th><th>Profile Description</th><th>Suspend Status</th></tr>"; // table its not close 
        while ($row = $results->fetch_assoc()) {
            $field1name = $row["profileName"];
            $field2name = $row["profileDescription"];
            $field3name = $row["suspend"];

            $displayTable = $displayTable . "<tr><td>{$field1name}</td><td>{$field2name}</td><td style='text-align:center'>{$field3name}</td></tr>";
        }
        $displayTable = $displayTable . "</table>";
        return $displayTable;
    }

    // SEARCH USER PROFILE
    function searchUserProfile($profileName)
    {
        global $con;
        $sql = "select * from userprofile where profileName = '$profileName'";
        $results = $con->query($sql);
        if ($results->num_rows > 0) {
            $results = $con->query("SELECT * FROM userProfile WHERE profileName='$profileName'");
            $displayTable = "<table class='ua-up-search'><tr><th>Profile Name</th><th>Profile Description</th><th>Suspend Status</th></tr>"; // table its not close 
            while ($row = $results->fetch_assoc()) {
                $field1name = $row["profileName"];
                $field2name = $row["profileDescription"];
                $field3name = $row["suspend"];

                $displayTable = $displayTable . "<tr><td>{$field1name}</td><td>{$field2name}</td><td style='text-align:center'>{$field3name}</td></tr>";
            }
            $displayTable = $displayTable . "</table>";
            return $displayTable;
        } else {
            $displayTable = <<<ERROR
            <div class='ua-up-search-message alertError'>
                <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
                User Profile Do Not Exist!
            </div>
            ERROR;
            return $displayTable;
        }
    }

    // UPDATE USER PROFILE
    function editUserProfile($profileName, $profileDescription)
    {
        global $con;
        $sql = "UPDATE userprofile SET profileDescription='$profileDescription' WHERE profileName='$profileName'";

        if ($con->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // SUSPEND USER PROFILE
    function suspendUserProfile($profileName, $suspend)
    {
        global $con;
        $sql = "UPDATE userprofile SET suspend='$suspend' WHERE profileName='$profileName'";

        if ($con->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
