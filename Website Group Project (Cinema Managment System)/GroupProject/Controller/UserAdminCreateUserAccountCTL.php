<?php
include_once 'Entity\UserAccount.php';
include_once 'Entity\UserProfile.php';

class UserAdminCreateUserAccountCTL
{

    public function createUserAccount($username, $password, $fullName, $email, $phoneNum, $profileName)
    {
        $UserAccount = new UserAccount();
        $result = $UserAccount->addNewUserAccount($username, $password, $fullName, $email, $phoneNum, $profileName);

        return $result;
    }

    // for dropdown list
    public function retrieveProfileName()
    {
        $UserProfile = new UserProfile();
        $displayOption = $UserProfile->retrieveUserProfile();
        return $displayOption;
    }
}
