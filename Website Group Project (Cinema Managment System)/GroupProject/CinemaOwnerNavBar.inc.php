<?php
function navBar($page)
{
?>
    <div class="topBanner">
        <a href="CinemaOwnerLogonPageUI.php" class="title">
            <h1>Braindead Movies</h1>
        </a>
        <?php
        switch ($page) {
            case "Profile":
        ?>
                <div class="topnav">
                    <a class="active" href="CinemaOwnerViewProfileUI.php">Profile</a>
                    <a href="CinemaOwnerRevenueReportSelectUI.php">Revenue Reports</a>
                    <a href="CinemaOwnerUtilisationSelectUI.php">Cinema Utilisation Reports</a>
                </div>
            <?php
                break;
            case "Revenue":
            ?>
                <div class="topnav">
                    <a href="CinemaOwnerViewProfileUI.php">Profile</a>
                    <a class="active" href=" CinemaOwnerRevenueReportSelectUI.php">Revenue Reports</a>
                    <a href="CinemaOwnerUtilisationSelectUI.php">Cinema Utilisation Reports</a>
                </div>
            <?php
                break;
            case "Utilisation":
            ?>
                <div class="topnav">
                    <a href="CinemaOwnerViewProfileUI.php">Profile</a>
                    <a href="CinemaOwnerRevenueReportSelectUI.php">Revenue Reports</a>
                    <a class="active" href="CinemaOwnerUtilisationSelectUI.php">Cinema Utilisation Reports</a>
                </div>
            <?php
                break;
            default:
            ?>
                <div class="topnav">
                    <a href="CinemaOwnerViewProfileUI.php">Profile</a>
                    <a href="CinemaOwnerRevenueReportSelectUI.php">Revenue Reports</a>
                    <a href="CinemaOwnerUtilisationSelectUI.php">Cinema Utilisation Reports</a>
                </div>
        <?php
        }
        ?>
        <form action="CinemaOwnerLogonPageUI.php" method="post">
            <input type="submit" name="logoutBTN" class="mybuttonCSS" value="Log Out">
        </form>
    </div>
<?php
}
?>