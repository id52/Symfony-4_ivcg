<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            GeoFixtures::class,
            MapFixtures::class,
            FactFixtures::class,
            TestimonialFixtures::class,
            VisaFixtures::class,
            PassportPhotoFixtures::class,
        ];
    }

}

