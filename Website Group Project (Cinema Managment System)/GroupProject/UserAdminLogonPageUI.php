<?php
include("UserAdminNavBar.inc.php");
navbar("");
include_once "Controller/LoginCTL.php";

if (isset($_POST["logoutBTN"])) {
  session_destroy();
  header("Location: index.php");
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinema Website</title>
  <link rel="stylesheet" href="./css/topNav.css">
</head>

<body>

  <section class="center">

    <div class="center-child">
      <h1>Greetings</h1>
      <?php echo "<h2> Hello " . $_SESSION["username"] . ", " . $_SESSION["profileName"] . "</h2>"; ?>
    </div>

  </section>

</body>

</html>