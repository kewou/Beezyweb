<?php

namespace AdminBundle\Tests\Controller;

use PHPUnit\Framework\TestCase as TestCase;
use UserBundle\Entity\User;

class DefaultControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = new User();
        //$client = static::createClient();

        //$crawler = $client->request('GET', '/');

       // $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
