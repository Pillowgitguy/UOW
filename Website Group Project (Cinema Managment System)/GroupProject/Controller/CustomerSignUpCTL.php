<?php
include_once("Entity/UserAccount.php");

class CustomerSignUpCTL
{

    public function createCustomerAccount($userName, $password, $fullName, $email, $phoneNumber)
    {
        $c = new UserAccount();
        $results = $c->createCustomerAccount($userName, $password, $fullName, $email, $phoneNumber);
        return $results;
    }
}
