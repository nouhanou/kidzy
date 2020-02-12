<?php

namespace PiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class testControllerTest extends WebTestCase
{
    public function testFun()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test');
    }

}
