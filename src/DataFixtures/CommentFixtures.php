<?php

namespace App\DataFixtures;


use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $comment1 = new Comment();
        $comment1->setContent('Pourriez-vous préciser l\'heure à laquelle vous l\'avez perdu svp ? Il me semble avoir vu une personne le ramasser vers 17h30.');
        $comment1->setUser($this->getReference('user-2'));
        $comment1->setTraobject($this->getReference('traobject-bear'));
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setContent('Bonjour, je pense avoir trouvé votre portefeuille ce matin. Pourriez-vous m\'envoyer votre nom et prénom par message privé svp afin que je puisse vous le remettre ?');
        $comment2->setUser($this->getReference('user-1'));
        $comment2->setTraobject($this->getReference('traobject-bear'));
        $manager->persist($comment2);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [UserFixtures::class, TraobjectFixtures::class];
    }
}