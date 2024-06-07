<?php
include_once 'Entity/UserAccount.php';

class UserAdminSuspendUserAccountCTL
{

    public function suspendUserAccount($username)
    {
        $UserAccount = new UserAccount();
        $result = $UserAccount->suspendUserAccount($username);

        return $result;
    }
}
