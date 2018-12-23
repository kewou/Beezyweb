<?php

namespace UserBundle\Tests;
use PHPUnit\Framework\TestCase;

/**
 * Description of UserDAOTest
 *
 * @author frup73532
 */
class UserDAOTest extends TestCase{
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    public function testAdd()
    {
        //$calculator = new Calculator();
        $result = 30+12;

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }          
}
