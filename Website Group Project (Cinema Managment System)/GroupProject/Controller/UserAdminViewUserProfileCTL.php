<?php
include_once("Entity/UserProfile.php");

class UserAdminViewUserProfileCTL
{
    function viewUserProfile()
    {
        $up = new UserProfile();
        $displayTable = $up->viewUserProfile();
        return $displayTable;
    }
}
