<?php
include("UserAdminNavBar.inc.php");
navbar("UserProfile");
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

  <h2 class="center-link">User Profile</h2>
  <p class="center-link">Please select the User Profile feature to begin ! </p>

  <div class="center-profile">
    <a href="UserAdminCreateUserProfileUI.php" class="link no-line">
      > Create User Profile
    </a>
  </div>

  <div class="center-profile">
    <a href="UserAdminViewUserProfileUI.php" class="link no-line">
      > View User Profile
    </a>
  </div>

  <div class="center-profile">
    <a href="UserAdminUpdateUserProfileUI.php" class="link no-line">
      > Update User Profile
    </a>
  </div>

  <div class="center-profile">
    <a href=" UserAdminSuspendUserProfileUI.php" class="link no-line">
      > Suspend User Profile
    </a>
  </div>

  <div class="center-profile">
    <a href="UserAdminSearchUserProfileUI.php" class="link no-line">
      > Search User Profile
    </a>
  </div>

</body>

</html>