<?php
include_once 'Entity/UserAccount.php';

class UserAdminUpdateUserAccountCTL
{

    public function editUserAccount($username, $password)
    {
        $UserAccount = new UserAccount();
        $result = $UserAccount->updateUserAccountDetail($username, $password);

        return $result;
    }
}
