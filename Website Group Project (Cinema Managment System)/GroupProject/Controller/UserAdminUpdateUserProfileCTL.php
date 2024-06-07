<?php
include_once("Entity/UserProfile.php");

class UserAdminUpdateUserProfileCTL
{
    // for dropdown list
    function retrieveUserProfile()
    {
        $rup = new UserProfile();
        $options = $rup->retrieveUserProfile();
        return $options;
    }

    function editUserProfile($profileName, $profileDescription)
    {
        $p = new UserProfile();
        $results = $p->editUserProfile($profileName, $profileDescription);
        return $results;
    }
}
