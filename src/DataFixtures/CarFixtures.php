<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Brand;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brandFord = new Brand();
        $brandFord->setName('Ford');
        $brandFord->setLabel('Ford'); 
        $manager->persist($brandFord);
        
        $honda = new Brand();
        $honda->setName('Honda') ;
        $honda->setLabel('Honda'); 
        $manager->persist($honda);
     
        $volkswagen = new Brand();
        $volkswagen->setName('Volkswagen') ;
        $volkswagen->setLabel('Volkswagen'); 
        $manager->persist($volkswagen);



        $car1 = new Car();
        $car1->setModel('Honda Civic Si');
        $car1->setYear('2020');
        $car1->setBrand($honda);
        $car1->setStatus(false);
        $manager->persist($car1);
      
        $car2 = new Car();
        $car2->setModel('T-Cross');
        $car2->setYear('2020');
        $car2->setBrand($volkswagen);
        $car2->setStatus(false);

        $manager->persist($car2);

        $manager->flush();
    }
}
