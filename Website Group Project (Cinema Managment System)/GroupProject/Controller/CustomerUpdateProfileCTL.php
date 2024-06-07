<?php

include_once "Entity/UserAccount.php";

class CustomerUpdateProfileCTL
{
    public function editProfile($username, $fullname, $email, $phonenumber)
    {
        $useraccount = new UserAccount();
        $result = $useraccount->updateProfile($username, $fullname, $email, $phonenumber);
        return $result;
    }
}
