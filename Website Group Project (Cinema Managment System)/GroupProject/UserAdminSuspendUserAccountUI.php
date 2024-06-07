<?php


function toSuspendAccount($username)
{
  include_once "Controller/UserAdminSuspendUserAccountCTL.php";
  $suspendAccount = new UserAdminSuspendUserAccountCTL();
  $result = $suspendAccount->suspendUserAccount($username);

  if ($result == true) {
    echo '<script>alert("SUCCESS: Account suspended !"); setTimeout(function(){ window.location.href = "UserAdminViewUserAccountUI.php"; }, 300);</script>';
  } else {
    echo '<script>alert("FAIL: Account fail to suspend !"); setTimeout(function(){ window.location.href = "UserAdminViewUserAccountUI.php"; }, 300);</script>';
  }
}


$username = $_GET["username"];
toSuspendAccount($username);
