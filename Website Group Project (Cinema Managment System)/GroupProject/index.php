<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/topNav.css">
</head>

<body class="center-link">

    <?php
    include_once "Controller\LoginCTL.php";

    function displayError()
    {
        echo <<<ERROR
        <div class='cm-tt-create-message alertError'>
            <span class='closebtn' onclick="this.parentElement.style.display='none';" style='color:white'>&times;</span>
            Invalid Account!    
        </div>
        ERROR;
    }
    function loginCheck($username, $password)
    {
        $login = new LoginCTL();
        return ($login->loginUser($username, $password));
    }
    ?>

    <br><br>
    <form action=index.php method=post>
        <h1 class="title">Braindead Movies</h1>
        <h3>Welcome to Braindead Movies !</h3>
        <label for=username class="link bold">Username:</label>
        <br>
        <input type=text name=username id=username style="margin-left:0px">
        <br><br>
        <label for=password class="link bold">Password:</label>
        <br>
        <input type=password name=password id=password style="margin-left:0px">
        <br>
        <br>
        <button name=submit class="button login-button"><span>Login</span></button>
        <br>
        <br>
        <label for=signin class="signup-link">New? Sign up here -></label>
        <button name=signup class="signup-button">Sign Up</button>
        <br>
    </form>
    <?php
    if (isset($_POST["submit"])) {
        // retrieving data
        $username = $_POST["username"];
        $password = $_POST["password"];
        $loginSuccess = loginCheck($username, $password);
        if ($loginSuccess) {
            if ($_SESSION["profileName"] == "customer") {
                header("location: CustomerLogonPageUI.php");
            } else if ($_SESSION["profileName"] == "cinemaManager") {
                header("location: CinemaManagerLogonPageUI.php");
            } else if ($_SESSION["profileName"] == "cinemaOwner") {
                header("location: CinemaOwnerLogonPageUI.php");
            } else if ($_SESSION["profileName"] == "userAdmin") {
                header("location: UserAdminLogonPageUI.php");
            }
        } else {
            displayError();
        }
    } elseif (isset($_POST["signup"])) {
        header("location: CustomerSignUpUI.php");
    }
    ?>

</body>

</html>