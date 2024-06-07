<?php
function navBar($page)
{
?>
    <div class="topBanner">
        <a href="CustomerLogonPageUI.php" class="title">
            <h1>Braindead Movies</h1>
        </a>
        <?php
        switch ($page) {
            case "Profile":
        ?>
                <div class="topnav">
                    <a class="active" href="CustomerViewProfileUI.php">Profile</a>
                    <a href="CustomerViewMovieSessionUI.php">Movie Sessions</a>
                    <a href="CustomerViewSummaryOfPurchaseUI.php">Summary Of Purchase</a>
                </div>
            <?php
                break;
            case "MovieSession":
            ?>
                <div class="topnav">
                    <a href="CustomerViewProfileUI.php">Profile</a>
                    <a class="active" href="CustomerViewMovieSessionUI.php">Movie Sessions</a>
                    <a href="CustomerViewSummaryOfPurchaseUI.php">Summary Of Purchase</a>
                </div>
            <?php
                break;
            case "Summary":
            ?>
                <div class="topnav">
                    <a href="CustomerViewProfileUI.php">Profile</a>
                    <a href="CustomerViewMovieSessionUI.php">Movie Sessions</a>
                    <a class="active" href="CustomerViewSummaryOfPurchaseUI.php">Summary Of Purchase</a>
                </div>
            <?php
                break;
            default:
            ?>
                <div class="topnav">
                    <a href="CustomerViewProfileUI.php">Profile</a>
                    <a href="CustomerViewMovieSessionUI.php">Movie Sessions</a>
                    <a href="CustomerViewSummaryOfPurchaseUI.php">Summary Of Purchase</a>
                </div>
        <?php
        }
        ?>
        <form action="CustomerLogonPageUI.php" method="post">
            <input type="submit" name="logoutBTN" class="mybuttonCSS" value="Logout">
        </form>
    </div>

<?php
}
?>