<?php
include_once 'db.php';

class UserAccount
{
    // LOGIN ------------
    public function getUser($username, $password)
    {
        $loginSuccess = false;

        // Connect to the database
        $con = mysqli_connect("localhost", "root", "", "cinema");

        try {
            $sql = "SELECT * FROM USERACCOUNT WHERE username = '$username' AND password = '$password';";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                session_start();
                $row = $result->fetch_assoc();
                $_SESSION["username"] = $row["username"];
                $_SESSION["profileName"] = $row["profileName"];
                // for profile
                $_SESSION["password"] = $row["password"];
                $_SESSION["fullName"] = $row["fullName"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["phoneNumber"] = $row["phoneNumber"];
                $loginSuccess = true;
                $con->close();
            } else {
                $loginSuccess = false;
            }
        } catch (mysqli_sql_exception $e) {
            $loginSuccess = false;
        }

        return $loginSuccess;
    }

    // USER VIEW PROFILE -----------
    public function getProfile($username)
    {
        global $con;
        $fullName = "";
        $email = "";
        $phoneNumber = "";

        $profileTable = "";

        try {
            $sql = "SELECT * FROM USERACCOUNT WHERE username = '$username';";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = $result->fetch_assoc();
                $fullName = $row["fullName"];
                $email = $row["email"];
                $phoneNumber = $row["phoneNumber"];
            }
        } catch (mysqli_sql_exception $e) {
            return $profileTable;
        }

        $profileTable = <<<TABLE
        <tr><th>Username: </th><td>$username</td></tr>
        <tr><th>Full Name: </th><td>$fullName</td></tr>
        <tr><th>Email: </th><td>$email</td></tr> 
        <tr><th>Phone Number: </th><td>$phoneNumber</td></tr>
        TABLE;

        return $profileTable;
    }

    // USER UPDATE PROFILE -----------
    public function updateProfile($username, $fullname, $email, $phonenumber)
    {
        global $con;

        try {
            $sql = "UPDATE USERACCOUNT SET fullName='$fullname',email='$email',phoneNumber='$phonenumber' WHERE username='$username';";
            mysqli_query($con, $sql);

            $_SESSION["fullName"] = $fullname;
            $_SESSION["email"] = $email;
            $_SESSION["phoneNumber"] = $phonenumber;

            if (mysqli_affected_rows($con) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    // CUSTOMER SIGNUP -----------
    function createCustomerAccount($userName, $password, $fullName, $email, $phoneNumber)
    {
        $con = mysqli_connect("localhost", "root", "", "cinema");
        $sql = "select * from userAccount where userName = '$userName'";
        $results = $con->query($sql);
        if ($results->num_rows > 0) {
            return false;
        } else {
            $sql = "insert into userAccount(username,password,fullName,email,phoneNumber,suspend,profileName) values('$userName','$password','$fullName','$email','$phoneNumber','N','customer')";
            $con->query($sql);
            return true;
        }
    }

    // USER ADMIN ------------

    // CREATE USER ACCOUNT
    public function addNewUserAccount($username, $password, $fullName, $email, $phoneNum, $profileName)
    {
        global $con;

        // Check if the username already exist
        $query = "SELECT * FROM useraccount WHERE USERNAME = '$username';";
        try {
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                return false;
            } else {
                $query = "INSERT INTO useraccount (username, password, fullName, email, phoneNumber,suspend, profileName) VALUES ('$username', '$password', '$fullName', '$email', '$phoneNum','N', '$profileName');";

                $result = mysqli_query($con, $query);
                $con->close();

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

    // VIEW USER ACCOUNT
    public function retrieveUserAccount()
    {
        global $con;

        $tableContent = "";
        $query = "SELECT * FROM USERACCOUNT";

        $query .= ";";

        try {
            $result = mysqli_query($con, $query);
            $con->close();

            while ($row = $result->fetch_assoc()) {
                $tableContent .= '<form action="UserAdminUpdateUserAccountUI.php" method="post">
                                        <li class="table-row">
                                            <div class="oddRow sCode" >' . $row["username"] . '</div>
                                            <input type="hidden" name="username" value="' . $row["username"] . '" />
                            
                                            <div class="sName" >' . $row["fullName"] . '</div>
                                            <input type="hidden" name="fullName" value="' . $row["fullName"] . '" />
                            
                                            <div class="oddRow sVenue" >' . $row["email"] . '</div>
                                            <input type="hidden" name="email" value="' . $row["email"] . '" />
                                                    
                                            <div class="sDate" >' . $row["phoneNumber"] . '</div>
                                            <input type="hidden" name="phoneNumber" value="' . $row["phoneNumber"] . '" />
                            
                                            <div class="oddRow sSTime" >' . $row["profileName"] . '</div>
                                            <input type="hidden" name="profileName" value="' . $row["profileName"] . '" />
                            
                                            <input type="hidden" name="password" value="' . $row["password"] . '" />
                            
                                            <div class="sSTime" >' . $row["suspend"] . '</div>
                                            <input type="hidden" name="suspend" value="' . $row["suspend"] . '" />
                            
                            
                                            <input type="submit" name="editAccount" value="Update" class="extra" data-label="edit">';

                if ($row["suspend"] == "N") {
                    $tableContent .= '<a href="UserAdminSuspendUserAccountUI.php?username=' . $row["username"] . '" class="link">Suspend</a>';
                } else if ($row['suspend'] == "Y") {
                    $tableContent .= '<a role="link" aria-disabled="true" style="color:#A9A9A9">Suspend</a>';
                }

                $tableContent .= '</li></form>';
            }

            // $tableContent now holds all records of userAccounts in a form each, returned as a string back to CTL, then to Boundary
            return $tableContent;
        } catch (mysqli_sql_exception $e) {
            return $tableContent;
        }
    }

    // SEARCH USER ACCOUNT
    public function searchUserAccount($username = "")
    {

        global $con;

        $tableContent = "";
        $query = "SELECT * FROM USERACCOUNT";

        if ($username != "") {
            $subQuery = " WHERE USERNAME LIKE '%" . $username . "%';";
            $query .= $subQuery;
        }


        $query .= ";";

        try {
            $result = mysqli_query($con, $query);
            $con->close();

            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {

                    $tableContent .= '<form action="UserAdminUpdateUserAccountUI.php" method="post">
                                        <li class="table-row">
                                            <div class="oddRow sCode" >' . $row["username"] . '</div>
                                            <input type="hidden" name="username" value="' . $row["username"] . '" />
                            
                                            <div class="sName" >' . $row["fullName"] . '</div>
                                            <input type="hidden" name="fullName" value="' . $row["fullName"] . '" />
                            
                                            <div class="oddRow sVenue" >' . $row["email"] . '</div>
                                            <input type="hidden" name="email" value="' . $row["email"] . '" />
                                                    
                                            <div class="sDate" >' . $row["phoneNumber"] . '</div>
                                            <input type="hidden" name="phoneNumber" value="' . $row["phoneNumber"] . '" />
                            
                                            <div class="oddRow sSTime" >' . $row["profileName"] . '</div>
                                            <input type="hidden" name="profileName" value="' . $row["profileName"] . '" />
                            
                                            <input type="hidden" name="password" value="' . $row["password"] . '" />
                            
                                            <div class="sSTime" >' . $row["suspend"] . '</div>
                                            <input type="hidden" name="suspend" value="' . $row["suspend"] . '" />
                                        </li>
                                    </form>';
                }
                // $tableContent now holds all records of userAccounts in a form each, returned as a string back to CTL, then to Boundary
                return $tableContent;
            } else {
                $tableContent = "<h3 style='color:#f44336e5'>No Account found</h3>";
                return $tableContent;
            }
        } catch (mysqli_sql_exception $e) {
            return $tableContent;
        }
    }

    // UPDATE USER ACCOUNT
    public function updateUserAccountDetail($username, $password)
    {
        global $con;

        $query = "UPDATE useraccount SET password = '$password' WHERE username = '$username';";

        try {
            $result = mysqli_query($con, $query);
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

    // SUSPEND USER ACCOUNT
    public function suspendUserAccount($username)
    {
        global $con;
        $query = "UPDATE USERACCOUNT SET suspend = 'Y' WHERE username = '$username';";

        try {
            $result = mysqli_query($con, $query);
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
