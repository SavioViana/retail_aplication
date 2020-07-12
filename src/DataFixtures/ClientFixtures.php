<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $client = new Client();
        $client->setName('Sávio de Azevedo Viana');
        $client->setEmail('savio.viana13@gmail.com');
        $client->setBirth(  new DateTime('1996-10-21') );
        $client->setCpf('78958759896');
        $manager->persist($client);
        
        $client1 = new Client();
        $client1->setName('Paulo Jose da Silva');
        $client1->setEmail('paulo@gmail.com');
        $client1->setBirth( new DateTime('1990-08-10') );
        $client1->setCpf('1111111111');
        $manager->persist($client1);

        $manager->flush();
    }
}
