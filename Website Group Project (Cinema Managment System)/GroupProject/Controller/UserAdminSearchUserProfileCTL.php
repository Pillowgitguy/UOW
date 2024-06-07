<?php
include_once("Entity/UserProfile.php");

class UserAdminSearchUserProfileCTL
{

    function searchUserProfile($profileName)
    {
        $up = new UserProfile();
        $displayTable = $up->searchUserProfile($profileName);
        return $displayTable;
    }
}
