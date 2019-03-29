<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
	private $encoder;

	public function __construct(UserPasswordEncoderInterface $encoder){
		$this->encoder = $encoder;

	}
    public function load(ObjectManager $manager)
    {
        
        

        $user2 = new User();
        $user2->setUsername('testAgentAff');
        $user2->setPassword($this->encoder->encodePassword($user2, 'testAgentAff'));
        $user2->setSalt('');
        $user2->setRoles(array('ROLE_AGENTAFF'));
        $manager->persist($user2);


        $manager->flush();
        

        
    }
}
