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
    public function testUserEmail(){
        $user = new User();
        $email = "   newtestemail@domain.com";
        $user->setEmail($email);

        $this->assertEquals($user->getEmail(), $email);
    }
}