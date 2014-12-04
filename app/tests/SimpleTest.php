<?php

use Silex\WebTestCase;

class SimpleTest extends WebTestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../start.php';

        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }

    public function testInitialPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');
        $response = $client->getResponse();

        $this->assertTrue($response->isOk());
        $this->assertContains('Hello', $response->getContent());
    }

    public function testUrlParameter()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/Alex');
        $response = $client->getResponse();

        $this->assertTrue($response->isOk());
        $this->assertContains('Hello Alex', $response->getContent());
    }
}
