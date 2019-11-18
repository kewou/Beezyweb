<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of FosActionTest
 *
 * @author frup73532
 */
class FosActionTest extends WebTestCase{
    
    function testShowCalendrier(){
        
        $client = static::createClient();
        $crawler = $client->request('GET', '/connexion');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
