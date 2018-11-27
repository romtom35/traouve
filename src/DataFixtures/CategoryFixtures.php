<?php

namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $portefeuille = new Category();
        $portefeuille->setLabel('Portefeuille');
        $portefeuille->setIcon('fa-money');
        $portefeuille->setColor('#f40404');
        $manager->persist($portefeuille);
        $this->addReference('category-portefeuille', $portefeuille);

        $cle = new Category();
        $cle->setLabel('clés');
        $cle->setIcon('fa-key');
        $cle->setColor('#0478f4');
        $manager->persist($cle);
        $this->addReference('category-cles', $cle);

        $jouet = new Category();
        $jouet->setLabel('Jouet');
        $jouet->setIcon('fa-puzzle-piece');
        $jouet->setColor('#f4e804');
        $manager->persist($jouet);
        $this->addReference('category-jouet', $jouet);

        $telephone = new Category();
        $telephone->setLabel('Téléphone');
        $telephone->setIcon('fa-mobile');
        $telephone->setColor('#07f404');
        $manager->persist($telephone);
        $this->addReference('category-telephone', $telephone);

        $lunette = new Category();
        $lunette->setLabel('Lunettes');
        $lunette->setIcon('fa-glasses');
        $lunette->setColor('#7c04f4');
        $manager->persist($lunette);
        $this->addReference('category-lunette', $lunette);

        $manager->flush();
    }
}