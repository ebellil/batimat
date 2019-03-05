<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Admin;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       /* for($i=1; $i <= 10; $i++){
            $admin = new Admin();
            $admin->setNom("Nom n°$i")
                  ->setPrenom("Prenom n°$i")
                  ->setMdp("Mdp n°$i");
            $manager->persist($admin);
        }
        $manager->flush();*/
    }
}
