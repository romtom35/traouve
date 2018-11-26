<?php

namespace App\DataFixtures;


use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $trouve = new State();
        $trouve->setLabel('Trouvé');
        $trouve->setColor('#0494f4');
        $manager->persist($trouve);
        $this->addReference('state-trouve', $trouve);

        $perdu = new State();
        $perdu->setLabel('Perdu');
        $perdu->setColor('#2aea40');
        $manager->persist($perdu);
        $this->addReference('state-perdu', $perdu);

        $manager->flush();
    }
}