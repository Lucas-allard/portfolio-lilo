<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $picture = new Picture();
            $picture->setSource('https://picsum.photos/200/300')
                ->setAlternativeDescription('Random picture');

            $manager->persist($picture);

            $this->addReference('picture_' . $i, $picture);
        }

        $manager->flush();
    }
}
