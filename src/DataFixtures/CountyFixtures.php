<?php

namespace App\DataFixtures;


use App\Entity\County;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $iev = new County();
        $iev->setLabel('Ille et Vilaine');
        $iev->setZipcode('35');
        $manager->persist($iev);
        $this->addReference('county-iev', $iev);

        $morbihan = new County();
        $morbihan->setLabel('Morbihan');
        $morbihan->setZipcode('56');
        $manager->persist($morbihan);
        $this->addReference('county-morbihan', $morbihan);

        $ca = new County();
        $ca->setLabel('Côte d\'armor');
        $ca->setZipcode('22');
        $manager->persist($ca);
        $this->addReference('county-ca', $ca);

        $finistere = new County();
        $finistere->setLabel('Finistère');
        $finistere->setZipcode('29');
        $manager->persist($finistere);
        $this->addReference('county-finistere', $finistere);

        $manager->flush();
    }
}