<?php


namespace App\Tests;
use PHPUnit\Framework\TestCase;
use App\Entity\User;
/**
 * Class userTest
 * @package App\Tests
 * @test
 */
class userTest extends TestCase
{
    public function testUserEmail(): void{
        $user = new User();
        $email = "   newtestemail@domain.com";
        $user->setEmail($email);
        $this->assertEquals($user->getEmail(), trim($email));
    }

    public function testUserName(): void{
        $user = new User();
        $name = "  konark kapil  ";
        $user->setName($name);

        $this->assertEquals($user->getName(), trim($name));
    }
}