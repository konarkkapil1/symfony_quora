<?php


namespace App\Tests\functional;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function testHomePost(){
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function testHomeContent(){
        $client = static::createClient();
        $crawler = $client->request("GET", "/");
        $this->assertSelectorTextContains("html head title", "Quora Clone");
    }

    /**
     * @test
     */
    public function testDoesHomeLoads(){
        $client = static::createClient();
        $client->request('GET', "/");
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @test
     */
    public function testLogin(){
        $client = static::createClient();
        $client->request("GET", "/login", [
            "email" => "konarkkapil2@gmail.com",
            "password" => "konark"
        ]);
        echo($client->getResponse());
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}