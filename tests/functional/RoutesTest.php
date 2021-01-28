<?php


namespace App\Tests\functional;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoutesTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testPageIsLoading($url){
        $client = self::createClient();
        $client->request("GET", $url);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideUrls(){
        return[
            ["/"],
            ["/login"],
            ["/register"],
        ];
    }
}