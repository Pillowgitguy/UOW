<?php

include_once 'Entity/UserAccount.php';

class UserAdminViewUserAccountCTL
{

    public function retrieveAllUserAccount()
    {
        $UserAccount = new UserAccount();
        $tableContent = $UserAccount->retrieveUserAccount();
        return $tableContent;
    }
}
