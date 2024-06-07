<?php

include_once 'Entity/UserAccount.php';
session_start();

class LoginCTL
{

    public function loginUser($username, $password)
    {
        $checkUserAccount = new UserAccount();
        return ($checkUserAccount->getUser($username, $password));
    }
}
