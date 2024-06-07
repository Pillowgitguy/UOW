<?php
include_once("Entity/UserProfile.php");

class UserAdminCreateUserProfileCTL
{

    function createUserProfile($profileName, $profileDescription, $status)
    {
        $p = new UserProfile();
        $results = $p->createUserProfile($profileName, $profileDescription, $status);
        return $results;
    }
}
