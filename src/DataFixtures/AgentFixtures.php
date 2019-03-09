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
        
        
        $agentTest = new Agent();
        $agentTest->setLogin('loginAgentTest');
        $agentTest->setMdp($this->encoder->encodePassword($agentTest, 'mdpAgentTest'));
        $agentTest->setNom('nomAgentTest');
        $agentTest->setPrenom('prenomAgentTest');
		$agentTest->setAdresse('AdresseAgentTest');
        $manager->persist($agentTest);


        $adminTest = new Agent();
        $adminTest->setLogin('loginAdminTest');
        $adminTest->setMdp($this->encoder->encodePassword($adminTest, 'mdpAdminTest'));
        $adminTest->setNom('nomAdminTest');
        $adminTest->setPrenom('prenomAdminTest');
		$adminTest->setAdresse('AdresseAdminTest');
        $manager->persist($adminTest);


        $agentAffAgence2 = new Agent();
        $agentAffAgence2->setLogin('agentAffAgence2');
        $agentAffAgence2->setMdp($this->encoder->encodePassword($agentAffAgence2, 'agentAffAgence2'));
        $agentAffAgence2->setNom('agentAffAgence2');
        $agentAffAgence2->setPrenom('agentAffAgence2');
		$agentAffAgence2->setAdresse('agentAffAgence2');
        $manager->persist($agentAffAgence2);

        $adminGene = new Agent();
        $adminGene->setLogin('testAdminGene');
        $adminGene->setMdp($this->encoder->encodePassword($adminGene, 'testAdminGene'));
        $adminGene->setNom('testNom');
        $adminGene->setPrenom('testPrenom');
		$adminGene->setAdresse('testAdresse');
        $manager->persist($adminGene);

        $agentAff = new Agent();
        $agentAff->setLogin('testAgentAff');
        $agentAff->setMdp($this->encoder->encodePassword($agentAff, 'testAgentAff'));
        $agentAff->setNom('testNom');
        $agentAff->setPrenom('testPrenom');
		$agentAff->setAdresse('testAdresse');
        $manager->persist($agentAff);


        $manager->flush();
        

        
    }
}
