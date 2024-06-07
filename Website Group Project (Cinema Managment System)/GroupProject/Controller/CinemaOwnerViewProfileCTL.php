<?php

include_once "Entity/UserAccount.php";

class CinemaOwnerViewProfileCTL
{
    public function viewProfile($username)
    {
        $userAccount = new UserAccount();
        $result = $userAccount->getProfile($username);
        return $result;
    }
}
