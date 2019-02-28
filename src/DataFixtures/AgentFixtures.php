<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AgentFixtures extends Fixture
{
	private $encoder;

	public function __construct(UserPasswordEncoderInterface $encoder){
		$this->encoder = $encoder;

	}
    public function load(ObjectManager $manager)
    {
        $agent = new Agent();
        $agent->setLogin('testAgentAff');
        $agent->setMdp($this->encoder->encodePassword($agent, 'testAgentAff'));
        $agent->setNom('testNom');
        $agent->setPrenom('testPrenom');
		$agent->setAdresse('testAdresse');
        $manager->persist($agent);
        $manager->flush();
    }
}
