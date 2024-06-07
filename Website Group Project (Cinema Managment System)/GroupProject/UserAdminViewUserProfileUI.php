<?php
include("UserAdminNavBar.inc.php");
navbar("UserProfile");
include_once("Controller/UserAdminViewUserProfileCTL.php");
$displayTable = "";

if (isset($_POST["View"])) {
  viewUserProfile();
}

function viewUserProfile()
{
  global $displayTable;
  $up = new UserAdminViewUserProfileCTL();
  $displayTable = $up->viewUserProfile();
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

  <form action="UserAdminViewUserProfileUI.php" method="post" class="center-link">
    <h2>View User Profile</h2>
    <p>Click on View to start!</p>
    <button type="View" name="View" class="cm-tt-view-button"><span> View </span></button>
  </form>
  <?php echo $displayTable; ?>

</body>

</html>
<?php
