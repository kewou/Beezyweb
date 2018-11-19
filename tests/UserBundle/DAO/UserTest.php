<?php

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\WebProfilerBundle\Tests\TestCase;
use UserBundle\Entity\User;

namespace UserBundle\Tests\DAO;
/**
 * Description of UserTest
 *
 * @author frup73532
 */
class UserTest extends TestCase{
    
    public function testListUser(){
       $user = new User();
       $user->setNom("NOUMIA");
       $user->setPrenmo("joel");       
       $userRepository = $this->createMock(ObjectRepository::class);
       $userRepository->expects($this->any())->method('find')->willReturn($user);
       $objectManager->expects($this->any())->methode('getRepository')->willReturn($userRepository);
    }
    
    
}
