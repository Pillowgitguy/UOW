<?php
include("UserAdminNavBar.inc.php");
navbar("UserAccount");

function makeAccountChanges($username, $password)
{
  include_once "Controller/UserAdminUpdateUserAccountCTL.php";
  $editAccount = new UserAdminUpdateUserAccountCTL();
  $result = $editAccount->editUserAccount($username, $password);

  if ($result == true) {
    echo '<script>alert("Account Updated !"); setTimeout(function(){ window.location.href = "UserAdminViewUserAccountUI.php"; }, 300);</script>';
  } else {
    echo '<script>alert("Update Error ! No changes applied."); </script>';
  }
}

if (isset($_POST["cancelChanges"])) {
  echo '<script>alert("No Changes Made !"); setTimeout(function(){ window.location.href = "UserAdminViewUserAccountUI.php"; }, 300);</script>';
} else if (isset($_POST["confirmChange"])) {
  $username = $_POST["username"];
  $password =  $_POST["password"];
  makeAccountChanges($username, $password);
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
  <link rel="stylesheet" href="./css/infoTable.css">
</head>

<body>

  <h2 class="center-link">Update User Accounts</h2>

  <div class="center-link">
    <ul class="infoTable">
      <li class="table-header">
        <div class="sCode">User Name</div>
        <div class="sName" style="position:relative;left:-15px">Name</div>
        <div class="sVenue" style="position:relative;left:-30px">Email</div>
        <div class="sDate" style="position:relative;left:-45px">Phone Number</div>
        <div class="sSTime" style="position:relative;left:-60px">Account Type</div>
        <div class="sETime" style="position:relative;left:-30px">Password</div>
      </li>

      <?php
      // Check for which button is pressed inside the User Account List, User Admin can Edit / Suspend
      if (isset($_POST["suspendAccount"])) {
        toSuspendAccount($_POST["username"]);
      } else if (isset($_POST["editAccount"])) {  ?>

        <form action="UserAdminUpdateUserAccountUI.php" method="post">
          <li class="table-row">
            <div class="oddRow sCode"><?php echo $_POST["username"]; ?></div>
            <input type="hidden" name="username" value="<?php echo $_POST["username"]; ?>" />

            <div class="sName"><?php echo $_POST["fullName"]; ?></div>
            <div class="oddRow sVenue"><?php echo $_POST["email"]; ?></div>
            <div class="sDate"><?php echo $_POST["phoneNumber"]; ?></div>
            <div class="oddRow sSTime"><?php echo $_POST["profileName"]; ?></div>

            <input type="text" class="oddRow sETime" name="password" value="<?php echo $_POST['password']; ?>" />
          </li>

          <input type="submit" name="confirmChange" value="Confirm Change">
          <input type="submit" name="cancelChanges" value="Cancel Changes">
        </form>
    </ul>
  </div>
<?php } ?>

</body>

</html>