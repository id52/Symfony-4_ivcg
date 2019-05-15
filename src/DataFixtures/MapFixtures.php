<?php

namespace App\DataFixtures;

use App\Entity\Map;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MapFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $map = new Map();
        $map->setCity('Абакан');
        $map->setLatitude(74);
        $map->setLongitude(80);
        $map->setPhotoUri('/img/map/abakan.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Ачинск');
        $map->setLatitude(76);
        $map->setLongitude(81);
        $map->setPhotoUri('/img/map/achinsk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Барнаул');
        $map->setLatitude(72);
        $map->setLongitude(75);
        $map->setPhotoUri('/img/map/barnaul.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Бердск');
        $map->setLatitude(74);
        $map->setLongitude(73);
        $map->setPhotoUri('/img/map/berdsk.jpeg');
        $manager->persist($map);


        $map = new Map();
        $map->setCity('Бийск');
        $map->setLatitude(72);
        $map->setLongitude(77);
        $map->setPhotoUri('/img/map/biysk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Верхняя Пышма');
        $map->setLatitude(81.75);
        $map->setLongitude(57.25);
        $map->setPhotoUri('/img/map/verhnyaya_pyshma.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Владивосток');
        $map->setLatitude(66.75);
        $map->setLongitude(125.25);
        $map->setPhotoUri('/img/map/vladivostok.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Горно-Алтайск');
        $map->setLatitude(72);
        $map->setLongitude(80);
        $map->setPhotoUri('/img/map/gorno-altaysk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Екатеринбург');
        $map->setLatitude(80.75);
        $map->setLongitude( 57.25);
        $map->setPhotoUri('/img/map/ekaterinburg.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Иркутск');
        $map->setLatitude(71);
        $map->setLongitude(94);
        $map->setPhotoUri('/img/map/irkutsk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Калининград');
        $map->setLatitude(89.2);
        $map->setLongitude(25);
        $map->setPhotoUri('/img/map/kaliningrad.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Кемерово');
        $map->setLatitude(76);
        $map->setLongitude( 77);
        $map->setPhotoUri('/img/map/kemerovo.jpeg');
        $manager->persist($map);


        $map = new Map();
        $map->setCity('Краснообск');
        $map->setLatitude(74);
        $map->setLongitude(71);
        $map->setPhotoUri('/img/map/krasnoobsk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Красноярск');
        $map->setLatitude(76);
        $map->setLongitude(83);
        $map->setPhotoUri('/img/map/krasnoyarsk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Москва');
        $map->setLatitude(85.2);
        $map->setLongitude(35);
        $map->setPhotoUri('/img/map/moskva.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Нижний Новгород');
        $map->setLatitude(84.5);
        $map->setLongitude(38);
        $map->setPhotoUri('/img/map/nizhniy_novgorod.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Новокузнецк');
        $map->setLatitude(75);
        $map->setLongitude(76);
        $map->setPhotoUri('/img/map/novokuznetsk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Новосибирск');
        $map->setLatitude(75);
        $map->setLongitude(72);
        $map->setPhotoUri('/img/map/novosibirsk.jpeg');
        $map->setPhone('+7 (383) 2 140 370');
        $map->setAddress('ул. Б. Богаткова 210/1, оф. 708, БЦ «Golden Field»');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Норильск');
        $map->setLatitude(88);
        $map->setLongitude(88);
        $map->setPhotoUri('/img/map/norilsk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Омск');
        $map->setLatitude(77);
        $map->setLongitude(65);
        $map->setPhotoUri('/img/map/omsk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Рубцовск');
        $map->setLatitude(71.75);
        $map->setLongitude(73);
        $map->setPhotoUri('/img/map/rubtsovsk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Северск');
        $map->setLatitude(79);
        $map->setLongitude(75);
        $map->setPhotoUri('/img/map/seversk.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Ставрополь');
        $map->setLatitude(78);
        $map->setLongitude(29.5);
        $map->setPhotoUri('/img/map/stavropol.jpeg');
        $manager->persist($map);

        $map = new Map();
        $map->setCity('Томск');
        $map->setLatitude(78);
        $map->setLongitude(75);
        $map->setPhotoUri('/img/map/tomsk.jpeg');
        $map->setPhone('+7 (383) 2 140 370');
        $map->setAddress('пр-кт. Фрунзе 103');
        $manager->persist($map);


        $map = new Map();
        $map->setCity('Улан-Удэ');
        $map->setLatitude(72);
        $map->setLongitude(97);
        $map->setPhotoUri('/img/map/ulan-ude.jpeg');
        $manager->persist($map);


        $map = new Map();
        $map->setCity('Хабаровск');
        $map->setLatitude(71.75);
        $map->setLongitude(124.75);
        $map->setPhotoUri('/img/map/khabarovsk.jpeg');
        $manager->persist($map);


        $map = new Map();
        $map->setCity('Калтан');
        $map->setLatitude(74);
        $map->setLongitude(77);
        $map->setPhotoUri('/img/map/kaltan.jpeg');
        $manager->persist($map);


        $map = new Map();
        $map->setCity('Междуреченск');
        $map->setLatitude(75);
        $map->setLongitude(78);
        $map->setPhotoUri('/img/map/mezhdurechensk.jpeg');
        $manager->persist($map);

        $manager->flush();

    }
}