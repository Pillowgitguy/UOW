<?php
include_once 'Entity/UserAccount.php';

class UserAdminSearchUserAccountCTL
{

    public function searchUserAccount($username)
    {
        $UserAccount = new UserAccount();
        $tableContent = $UserAccount->searchUserAccount($username);
        return $tableContent;
    }
}
