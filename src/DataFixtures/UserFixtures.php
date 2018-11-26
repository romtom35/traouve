<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setFirstname('romain');
        $user1->setLastname('thomas');
        $user1->setEmail('romtom35@gmail.com');
        $user1->setPicture('user-1.jpg');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'rthomas'));
        $user1->setRoles(['ROLE_ADMIN']);
        $manager->persist($user1);
        $this->addReference('user-1', $user1);

        $user2 = new User();
        $user2->setFirstname('alex');
        $user2->setLastname('giacon');
        $user2->setEmail('alexgiacon35@gmail.com');
        $user2->setPicture('user-.jpg');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, '1234'));
        $user2->setRoles(['ROLE_USER']);
        $manager->persist($user2);
        $this->addReference('user-2', $user2);

        $manager->flush();
    }
}