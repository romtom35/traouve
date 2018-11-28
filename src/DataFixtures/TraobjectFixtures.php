<?php

namespace App\DataFixtures;


use App\Entity\Traobject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TraobjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bear = new Traobject();
        $bear->setTitle('Ours en peluche');
        $bear->setPicture('teddy-bear.jpg');
        $bear->setCity('Rennes');
        $bear->setEventAt(new \DateTime('2018-11-20'));
        $bear->setCategory($this->getReference('category-jouet'));
        $bear->setState($this->getReference('state-trouve'));
        $bear->setCounty($this->getReference('county-iev'));
        $bear->setUser($this->getReference('user-2'));
        $this->addReference('traobject-bear', $bear);
        $manager->persist($bear);

        $wallet = new Traobject();
        $wallet->setTitle('portefeuille');
        $wallet->setPicture('wallet.jpg');
        $wallet->setCity('Saint-Malo');
        $wallet->setEventAt(new \DateTime('2018-11-21'));
        $wallet->setCategory($this->getReference('category-portefeuille'));
        $wallet->setState($this->getReference('state-perdu'));
        $wallet->setCounty($this->getReference('county-iev'));
        $wallet->setUser($this->getReference('user-1'));
        $manager->persist($wallet);

        $key = new Traobject();
        $key->setTitle('Trousseau de clés');
        $key->setPicture('keys.jpg');
        $key->setCity('Vannes');
        $key->setEventAt(new \DateTime('2018-11-24'));
        $key->setCategory($this->getReference('category-cles'));
        $key->setState($this->getReference('state-perdu'));
        $key->setCounty($this->getReference('county-morbihan'));
        $key->setUser($this->getReference('user-1'));
        $manager->persist($key);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class, StateFixtures::class, CountyFixtures::class, CategoryFixtures::class];
    }

}