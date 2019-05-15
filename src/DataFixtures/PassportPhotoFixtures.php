<?php

namespace App\DataFixtures;

use App\Entity\PassportPhoto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PassportPhotoFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/1.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/2.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/3.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/4.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/5.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/6.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/7.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/8.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/9.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/10.jpg');
        $manager->persist($passport_photo);

        $passport_photo = new PassportPhoto();
        $passport_photo->setUri('https://ivcg.ru/img/join_orig/11.jpg');
        $manager->persist($passport_photo);


        $manager->flush();
    }
}