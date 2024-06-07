<?php
include("UserAdminNavBar.inc.php");
navbar("UserProfile");
include_once("Controller/UserAdminSearchUserProfileCTL.php");
$displayTable = "";
$profileName = "userProfile";
$e1 = "";
$e2 = "";
// create a function in UI first 

if (isset($_POST["search"])) {
  validateEmptyUserProfile($e1);
  if (empty($e1)) {
    searchUserProfile($_POST["profilename"]);
  }
}

function validateEmptyUserProfile(&$e1)
{
  global $profileName;
  $profileName = trim($_POST["profilename"]);
  if (empty($profileName)) {
    $e1 = "Please fill in the User Profile Name To Search !";
  }
}

function searchUserProfile($profileName)
{
  global $displayTable;
  $up = new UserAdminSearchUserProfileCTL();
  $displayTable = $up->searchUserProfile($profileName);
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

  <section class="center-link">
    <div>
      <h2 class="center-link">Search User Profile</h2>
      <p>Enter User Profile And Click on Search to start!</p>
      <form action="UserAdminSearchUserProfileUI.php" method="post">
        <h4>User Profile Name</h4><input type="text" name="profilename" style="margin-left:0px" placeholder="Enter Profile Name">
        <button type="search" name="search" class="cm-search-movie-button"><span> Search </span></button>
        <br><br>
        <span style="color:#f44336e5">
          <?php echo $e1; ?>
        </span>
      </form>
    </div>
  </section>
  <?php echo $displayTable; ?>

</body>

</html>