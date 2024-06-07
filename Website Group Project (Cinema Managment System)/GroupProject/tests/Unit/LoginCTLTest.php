<?php
use PHPUnit\Framework\TestCase;

include_once('Controller\LoginCTL.php');
class LoginCTLTest extends TestCase
{
    public function testLoginUserReturnsTrueForValidCredentials()
    {
        // Arrange
        $userAccount = new LoginCTL();
        $username = '1';
        $password = '123';

        // Act
        $result = $userAccount->loginUser($username, $password);

        // Assert
        $this->assertTrue($result, 'Expected the result to be true');
    }

    public function testLoginUserReturnsFalseForInvalidCredentials()
    {
        // Arrange
        $userAccount = new LoginCTL();
        $username = 'dasdsad';
        $password = 'sdsadad';

        // Act
        $result = $userAccount->loginUser($username, $password);

        // Assert
        $this->assertFalse($result, 'Expected the result to be false');
    }
}

?>