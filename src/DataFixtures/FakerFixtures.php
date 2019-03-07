<?php

namespace App\DataFixtures;
 
use App\Entity\Materiel;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
 /*
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
    
        // on créé 10 personnes
        for ($i = 0; $i < 5; $i++) {
            $materiel = new Materiel();
            $materiel
                ->setLibelle($faker->words(2, true))
                ->setDescription($faker->sentences(3, true))
                ->setStock($faker->numberBetween(1, 10000))
                ->setIdCat(1)
                ->setIdf(1)
            ;
            $manager->persist($materiel);
        }
 
        $manager->flush();*/
    }
}