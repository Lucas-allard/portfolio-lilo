<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $project = new Project();

            $projectName = $faker->words(3, true);

            $project->setName($projectName)
                ->setSlug(strtolower(str_replace(' ', '-', $projectName)))
                ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                ->setRealizedAt($faker->dateTimeBetween('-6 months'))
                ->setDescription($faker->text(200));

            for ($rand = 0; $rand < rand(1, 3); $rand++) {
                $project->addCategory($this->getReference('category_' . rand(0, 1)));
            }

            for ($rand = 0; $rand < rand(1, 3); $rand++) {
                $project->addPicture($this->getReference('picture_' . rand(0, 9)));
            }

            $manager->persist($project);
        }

        $manager->flush();
    }
}
