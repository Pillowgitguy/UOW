<?php
include("UserAdminNavBar.inc.php");
navbar("UserAccount");
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

  <h2 class="center-link">User Account</h2>
  <p class="center-link">Please select the User Account feature to begin ! </P>

  <div class="center-link">
    <a href="UserAdminCreateUserAccountUI.php" class="link no-line">
      > Add User Account
    </a>
  </div>

  <div class="center-link">
    <a href="UserAdminViewUserAccountUI.php" class="link no-line">
      > View All Accounts
    </a>
  </div>


  <div class="center-link">
    <a href="UserAdminSearchUserAccountUI.php" class="link no-line" style="margin-left:20px">
      > Search User Account
    </a>
  </div>

</body>

</html>