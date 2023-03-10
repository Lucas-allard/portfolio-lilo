<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 2; $i++) {
            $category = new Category();

            $categoryName = $faker->words(3, true) ;

            $category->setName($categoryName)
                ->setSlug(strtolower(str_replace(' ', '-', $categoryName)));

            $manager->persist($category);

            $this->addReference('category_' . $i, $category);

        }
        $manager->flush();

    }
}
