<?php
function navBar($page)
{
?>
    <div class="topBanner">
        <a href="UserAdminLogonPageUI.php" class="title">
            <h1>Braindead Movies</h1>
        </a>
        <?php
        switch ($page) {
            case "Profile":
        ?>
                <div class="topnav">
                    <a class="active" href="UserAdminViewProfileUI.php">Profile</a>
                    <a href="UserAdminUserAccountUI.php">User Accounts</a>
                    <a href="UserAdminUserProfileUI.php">User Profiles</a>
                </div>
            <?php
                break;
            case "UserAccount":
            ?>
                <div class="topnav">
                    <a href="UserAdminViewProfileUI.php">Profile</a>
                    <a class="active" href="UserAdminUserAccountUI.php">User Accounts</a>
                    <a href="UserAdminUserProfileUI.php">User Profiles</a>
                </div>
            <?php
                break;
            case "UserProfile":
            ?>
                <div class="topnav">
                    <a href="UserAdminViewProfileUI.php">Profile</a>
                    <a href="UserAdminUserAccountUI.php">User Accounts</a>
                    <a class="active" href="UserAdminUserProfileUI.php">User Profiles</a>
                </div>
            <?php
                break;
            default:
            ?>
                <div class="topnav">
                    <a href="UserAdminViewProfileUI.php">Profile</a>
                    <a href="UserAdminUserAccountUI.php">User Accounts</a>
                    <a href="UserAdminUserProfileUI.php">User Profiles</a>
                </div>
        <?php
        }
        ?>
        <form action="UserAdminLogonPageUI.php" method="post">
            <input type="submit" name="logoutBTN" class="mybuttonCSS" value="Log Out">
        </form>
    </div>
<?php
}
?>