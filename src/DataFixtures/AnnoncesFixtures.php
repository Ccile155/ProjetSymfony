<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AnnoncesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        
        for($i = 1 ; $i <= 10 ; $i++){
            $annonce = new Annonces();
            // $annonce->setTitre('voiture Peugeot n°'. $i)
            //         ->setPrix(round(mt_rand(2000,20000)))
            //         ->setDescription('splendide, comme neuve')
            //         ->setPhoto('https://media.peugeot.re/image/09/2/peugeot-508-640x480.523092.19.jpg?autocrop=1');
            $titre = $faker->name;
            $prix = $faker->numberBetween($min = 1000, $max = 20000);
            $description = $faker->sentence();
            $photo = $faker->imageUrl($width = 500, $height = 400);
            $annonce->setTitre($titre)
                  ->setPrix($prix)
                  ->setDescription($description)
                  ->setPhoto($photo);

            $manager->persist($annonce);
        }


        $manager->flush();
    }
}
