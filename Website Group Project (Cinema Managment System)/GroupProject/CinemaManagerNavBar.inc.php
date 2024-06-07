<?php
function navBar($page)
{
?>
    <div class="topBanner">
        <a href="CinemaManagerLogonPageUI.php" class="title">
            <h1>Braindead Movies</h1>
        </a>
        <?php
        switch ($page) {
            case "Profile":
        ?>
                <div class="topnav">
                    <a class="active" href="CinemaManagerViewProfileUI.php">Profile</a>
                    <a href="CinemaManagerMovieSessionUI.php">Movie Sessions</a>
                    <a href="CinemaManagerCinemaRoomsUI.php">Cinema Rooms</a>
                    <a href="CinemaManagerTicketTypesUI.php">Ticket Types</a>
                    <a href="CinemaManagerFoodAndDrinksUI.php">Food And Drinks</a>
                </div>
            <?php
                break;
            case "MovieSession":
            ?>
                <div class="topnav">
                    <a href="CinemaManagerViewProfileUI.php">Profile</a>
                    <a class="active" href="CinemaManagerMovieSessionUI.php">Movie Sessions</a>
                    <a href="CinemaManagerCinemaRoomsUI.php">Cinema Rooms</a>
                    <a href="CinemaManagerTicketTypesUI.php">Ticket Types</a>
                    <a href="CinemaManagerFoodAndDrinksUI.php">Food And Drinks</a>
                </div>
            <?php
                break;
            case "CinemaRooms":
            ?>
                <div class="topnav">
                    <a href="CinemaManagerViewProfileUI.php">Profile</a>
                    <a href="CinemaManagerMovieSessionUI.php">Movie Sessions</a>
                    <a class="active" href="CinemaManagerCinemaRoomsUI.php">Cinema Rooms</a>
                    <a href="CinemaManagerTicketTypesUI.php">Ticket Types</a>
                    <a href="CinemaManagerFoodAndDrinksUI.php">Food And Drinks</a>
                </div>
            <?php
                break;
            case "TicketType":
            ?>
                <div class="topnav">
                    <a href="CinemaManagerViewProfileUI.php">Profile</a>
                    <a href="CinemaManagerMovieSessionUI.php">Movie Sessions</a>
                    <a href="CinemaManagerCinemaRoomsUI.php">Cinema Rooms</a>
                    <a class="active" href="CinemaManagerTicketTypesUI.php">Ticket Types</a>
                    <a href="CinemaManagerFoodAndDrinksUI.php">Food And Drinks</a>
                </div>
            <?php
                break;
            case "FoodAndDrinks":
            ?>
                <div class="topnav">
                    <a href="CinemaManagerViewProfileUI.php">Profile</a>
                    <a href="CinemaManagerMovieSessionUI.php">Movie Sessions</a>
                    <a href="CinemaManagerCinemaRoomsUI.php">Cinema Rooms</a>
                    <a href="CinemaManagerTicketTypesUI.php">Ticket Types</a>
                    <a class="active" href="CinemaManagerFoodAndDrinksUI.php">Food And Drinks</a>
                </div>
            <?php
                break;
            default:
            ?>
                <div class="topnav">
                    <a href="CinemaManagerViewProfileUI.php">Profile</a>
                    <a href="CinemaManagerMovieSessionUI.php">Movie Sessions</a>
                    <a href="CinemaManagerCinemaRoomsUI.php">Cinema Rooms</a>
                    <a href="CinemaManagerTicketTypesUI.php">Ticket Types</a>
                    <a href="CinemaManagerFoodAndDrinksUI.php">Food And Drinks</a>
                </div>
        <?php
        }
        ?>
        <form action="CinemaManagerLogonPageUI.php" method="post">
            <input type="submit" name="logoutBTN" class="mybuttonCSS" value="Log Out">
        </form>
    </div>
<?php
}
?>