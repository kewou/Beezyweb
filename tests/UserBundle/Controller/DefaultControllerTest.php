<?php

namespace UserBundle\Controller;

use PHPUnit\Framework\TestCase as TestCase;
use src\UserBundle\Entity\User;

class DefaultControllerTest extends TestCase {

    public function testIndex()
    {
        $user = new User();
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
