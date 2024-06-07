<?php
use PHPUnit\Framework\TestCase;

include_once('Controller\CustomerSignUpCTL.php');

class CustomerSignUpCTLTest extends TestCase
{
    function testCreateCustomerAccountReturnsTrueForValidCredentials()
    {
        // Arrange
        $customer = new CustomerSignUpCTL();
        $userName = 'ValidCreation28';
        $password = '123';
        $fullName = "ValidUser";
        $email = "ValidCreation@gmail.com";
        $phoneNumber = "12345678";

        // Act  
        $result = $customer->createCustomerAccount($userName, $password, $fullName, $email, $phoneNumber);

        // Assert
        $this->assertTrue($result, 'Expected the result to be true');
    }
}