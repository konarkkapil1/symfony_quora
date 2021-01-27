<?php


namespace App\Tests\Util;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class userTest extends TestCase
{
    /**
     * @test
     */
    public function testUserName(){
        $user = new User();
        $user->setName("konark");
        $this->assertEquals("konark", $user->getName());
    }
}