<?php

namespace MoniteurBundle\Tests\Controller;

use PHPUnit\Framework\TestCase as TestCase;

class DefaultControllerTest extends TestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
