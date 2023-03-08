<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setFirstName('Lilo')
            ->setLastName('Bartnik')
            ->setEmail('lilo.b499@gmail.com')
            ->setBio("")
            ->setPicture('https://avatars.githubusercontent.com/u/76900042?v=4')
            ->setPassword($this->passwordHasher->hashPassword($user, '0000'))
            ->setRoles(['ROLE_ADMIN']);

        $this->addReference('user_1', $user);

        $manager->persist($user);

        $manager->flush();
    }
}
