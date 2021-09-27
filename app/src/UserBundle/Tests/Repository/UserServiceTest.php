<?php

namespace UserBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of UserServiceTest
 *
 * @author frup73532
 */
class UserRepositoryFunctionalTest extends WebTestCase {
    
    private $service;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(){        
        $kernel = static::createKernel();
        $kernel->boot();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();                        
        $this->service=$kernel->getContainer()->get('user_service');        
    }    
    
    public function testAllUsers(){
        // Il ya 4 utilisateurs dans la base de données                              
        $this->assertCount(4, $this->service->getAllUsers());
    }
    
    public function testAllMoniteurs(){
        // Il ya 1 moniteur dans la base de données                               
        $this->assertCount(1, $this->service->getAllMoniteurs());
    }
    
    public function testGetUserById(){
        // user d'id 6
        $this->assertEquals($this->service->getUser(6)->getUsername(),"djodjoman@yahoo.fr");        
    }
    
    public function testGetUserByName(){
        // user de nom Ashur
        $this->assertEquals($this->service->getUserByName("Ashur")->getNom(),"Ashur");        
    }    
    
   
    protected function tearDown(){
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }     
    
}
