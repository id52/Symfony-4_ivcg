<?php

namespace App\DataFixtures;

use App\Entity\Geo;
use App\Entity\Robot;
use App\Entity\Sitemap;
use App\Entity\Specialist;
use App\Entity\TeamMember;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class GeoFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $geo = new Geo();
        $geo->setCity('Россия');
        $geo->setGenitiveCase('России');
        $geo->setPrepositionalCase('России');
        $geo->setRegion('Россия');
        $geo->setHost('ivcg.ru');
        $geo->setPhone('8 (499) 346-65-98');
        $geo->setIsVisible(1);
        $geo->setJivositeCode('<script defer src=\'/js/jivosite/russia.js\'></script>');
	    $geo->setVkLink('https://vk.com/visoviycenter');
	    $geo->setFbLink('https://www.facebook.com/visoviycenter');
	    $geo->setInstLink('https://www.instagram.com/ivcg.ru/');
	    $geo->setEmail('info@ivcg.ru');
	    $geo->setVkMessage('https://vk.com/im?sel=-167992051');

	    $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
	    $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');

	    $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
	    $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

	    $geo->setHeadTitleAgency('Лучшие партнерские условия по оформлению виз - «Международный визовый центр»');
	    $geo->setHeadTitleSubdomainAgency('Лучшие партнерские условия {{ geo_preposition_case_with_preposition }} по оформлению виз - «Международный визовый центр»');

	    $geo->setMetaDescriptionAgency('«Международный визовый центр» специализируется на корректном и быстром оформлении любых типов виз, поможем повысить лояльность клиентов и станем надежным партнером вашего агентства');
	    $geo->setMetaDescriptionSubdomainAgency('«Международный визовый центр» специализируется на корректном и быстром оформлении виз {{ geo_preposition_case_with_preposition }} в любую из представленных стран , поможем повысить лояльность клиентов и станем надежным партнером вашего агентства');

        $geo->setHeadTitleOrganization('Оформление виз с экономией рабочего времени ваших сотрудников до 30% - «Международный визовый центр»');
        $geo->setHeadTitleSubdomainOrganization('Оформление виз {{ geo_preposition_case_with_preposition }} с экономией рабочего времени ваших сотрудников до 30% - «Международный визовый центр»');

        $geo->setMetaDescriptionOrganization('«Международный визовый центр» поможет оформить визу для деловой поездки в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня');
        $geo->setMetaDescriptionSubdomainOrganization('«Международный визовый центр» поможет оформить визу для деловой поездки {{ geo_preposition_case_with_preposition }} в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');

        $team_member = new TeamMember();
        $team_member->setGeo($geo);
        $team_member->setName('Абрамова Ольга');
        $team_member->setText('CEO компании');
        $team_member->setPhotoUri('/img/team_members/abramova.jpg');
        $team_member->setPosition(30);
        $manager->persist($team_member);

        $team_member = new TeamMember();
        $team_member->setGeo($geo);
        $team_member->setName('Тимофеева Алёна');
        $team_member->setText('Клиент-менеджер');
        $team_member->setPhotoUri('/img/team_members/timofeeva.jpg');
        $team_member->setPosition(20);
        $manager->persist($team_member);

        $team_member = new TeamMember();
        $team_member->setGeo($geo);
        $team_member->setName('Кузмичёв Денис');
        $team_member->setText('Менеджер по продажам');
        $team_member->setPhotoUri('/img/team_members/kuzmichev.jpg');
        $team_member->setPosition(10);
        $manager->persist($team_member);

        $manager->persist($geo);

        $text = '
User-agent: *
Disallow: 

User-agent: Yandex
Disallow: 

User-agent: Googlebot
Disallow: 

Sitemap: https://'.$geo->getHost().'/sitemap.xml
';

        $robot = new Robot();
        $robot->setGeo($geo);
        $robot->setText($text);
        $manager->persist($robot);


        $sitemap = new Sitemap();
        $sitemap->setGeo($geo);
        $sitemap->setText('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"><url><loc>https://ivcg.ru/</loc><lastmod>2018-09-04T10:16:37+01:00</lastmod><priority>1.0</priority></url><url><loc>https://ivcg.ru/agency</loc><lastmod>2018-09-04T10:16:37+01:00</lastmod><priority>1.0</priority></url><url><loc>https://ivcg.ru/organization</loc><lastmod>2018-09-04T10:16:38+01:00</lastmod><priority>1.0</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/</loc><lastmod>2018-09-04T10:16:39+01:00</lastmod><priority>0.8</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-avstriyu/</loc><lastmod>2018-09-04T10:16:39+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-belgiyu/</loc><lastmod>2018-09-04T10:16:40+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-vengriyu/</loc><lastmod>2018-09-04T10:16:40+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-germaniyu/</loc><lastmod>2018-09-04T10:16:40+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-gretsiyu/</loc><lastmod>2018-09-04T10:16:41+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-daniyu/</loc><lastmod>2018-09-04T10:16:43+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-islandiyu/</loc><lastmod>2018-09-04T10:16:43+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-ispaniyu/</loc><lastmod>2018-09-04T10:16:44+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-italiyu/</loc><lastmod>2018-09-04T10:16:45+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-latviyu/</loc><lastmod>2018-09-04T10:16:45+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-litvu/</loc><lastmod>2018-09-04T10:16:46+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-lyuksemburg/</loc><lastmod>2018-09-04T10:16:47+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-na-maltu/</loc><lastmod>2018-09-04T10:16:47+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-niderlandy/</loc><lastmod>2018-09-04T10:16:48+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-norvegiyu/</loc><lastmod>2018-09-04T10:16:49+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-polshu/</loc><lastmod>2018-09-04T10:16:50+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-portugaliyu/</loc><lastmod>2018-09-04T10:16:50+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-slovakiyu/</loc><lastmod>2018-09-04T10:16:52+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-sloveniyu/</loc><lastmod>2018-09-04T10:16:52+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-finlyandiyu/</loc><lastmod>2018-09-04T10:16:53+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-vo-frantsiyu/</loc><lastmod>2018-09-04T10:16:54+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-chehiyu/</loc><lastmod>2018-09-04T10:16:54+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-shveytsariyu/</loc><lastmod>2018-09-04T10:16:55+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-shvetsiyu/</loc><lastmod>2018-09-04T10:16:56+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-shengen/viza-v-estoniyu/</loc><lastmod>2018-09-04T10:16:57+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/</loc><lastmod>2018-09-04T10:16:57+01:00</lastmod><priority>0.8</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-v-bolgariyu/</loc><lastmod>2018-09-04T10:16:59+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-v-velikobritaniyu/</loc><lastmod>2018-09-04T10:16:59+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-na-gibraltar/</loc><lastmod>2018-09-04T10:16:59+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-v-irlandiyu/</loc><lastmod>2018-09-04T10:17:01+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-na-kipr/</loc><lastmod>2018-09-04T10:17:01+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-v-monako/</loc><lastmod>2018-09-04T10:17:02+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-v-rumyniyu/</loc><lastmod>2018-09-04T10:17:03+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-na-farerskie-ostrova/</loc><lastmod>2018-09-04T10:17:03+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-evropa/viza-v-horvatiyu/</loc><lastmod>2018-09-04T10:17:04+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/</loc><lastmod>2018-09-04T10:17:05+01:00</lastmod><priority>0.8</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-vo-vetnam/</loc><lastmod>2018-09-04T10:17:06+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-indiyu/</loc><lastmod>2018-09-04T10:17:06+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-kambodzhu/</loc><lastmod>2018-09-04T10:17:08+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-kitay/</loc><lastmod>2018-09-04T10:17:08+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-myanma/</loc><lastmod>2018-09-04T10:17:08+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-nepal/</loc><lastmod>2018-09-04T10:17:10+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-singapur/</loc><lastmod>2018-09-04T10:17:10+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-tayland/</loc><lastmod>2018-09-04T10:17:11+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-na-shri-lanku/</loc><lastmod>2018-09-04T10:17:12+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-yaponiyu/</loc><lastmod>2018-09-04T10:17:12+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-v-yuzhnuyu-koreyu/</loc><lastmod>2018-09-04T10:17:13+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-aziya/viza-na-tayvan/</loc><lastmod>2018-09-04T10:17:14+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-amerika/</loc><lastmod>2018-09-04T10:17:15+01:00</lastmod><priority>0.8</priority></url><url><loc>https://ivcg.ru/napravlenie-amerika/viza-v-grenlandiyu/</loc><lastmod>2018-09-04T10:17:15+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-amerika/viza-na-karibskie-ostrova/</loc><lastmod>2018-09-04T10:17:17+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-amerika/viza-v-kanadu/</loc><lastmod>2018-09-04T10:17:17+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-amerika/viza-v-meksiku/</loc><lastmod>2018-09-04T10:17:17+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-amerika/viza-v-ssha/</loc><lastmod>2018-09-04T10:17:19+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-amerika/viza-na-folklendskie-malvinskie-ostrova/</loc><lastmod>2018-09-04T10:17:19+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-okeaniya/</loc><lastmod>2018-09-04T10:17:20+01:00</lastmod><priority>0.8</priority></url><url><loc>https://ivcg.ru/napravlenie-okeaniya/viza-v-avstraliyu/</loc><lastmod>2018-09-04T10:17:21+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-okeaniya/viza-v-novuyu-zelandiyu/</loc><lastmod>2018-09-04T10:17:22+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-okeaniya/viza-v-novuyu-kaledoniyu-frantsiya/</loc><lastmod>2018-09-04T10:17:22+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-okeaniya/viza-v-popua-novuyu-gvineyu-avstraliya/</loc><lastmod>2018-09-04T10:17:23+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-okeaniya/viza-na-solomonovy-ostrova/</loc><lastmod>2018-09-04T10:17:24+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-okeaniya/viza-vo-frantsuzskuyu-polineziyu/</loc><lastmod>2018-09-04T10:17:24+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/</loc><lastmod>2018-09-04T10:17:26+01:00</lastmod><priority>0.8</priority></url><url><loc>https://ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-iran/</loc><lastmod>2018-09-04T10:17:26+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-mavritaniyu/</loc><lastmod>2018-09-04T10:17:26+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-ruandu/</loc><lastmod>2018-09-04T10:17:28+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-serra-leone/</loc><lastmod>2018-09-04T10:17:28+01:00</lastmod><priority>0.6</priority></url><url><loc>https://ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-alzhir/</loc><lastmod>2018-09-04T10:17:29+01:00</lastmod><priority>0.6</priority></url></urlset>');
        $manager->persist($sitemap);


        $specialist = new Specialist();
        $specialist->setName('Аркадий Петров');
        $specialist->setPhotoUri('https://pp.userapi.com/c630029/v630029657/415df/s5eFVHNTR4U.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Александр Барасасанов');
        $specialist->setPhotoUri('https://pp.userapi.com/c841226/v841226185/defe/VY5H5HBYqAw.jpg');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Евгений Валубов');
        $specialist->setPhotoUri('https://pp.userapi.com/c631131/v631131657/3a591/TdefvMYv_oE.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Руслан Жванов');
        $specialist->setPhotoUri('https://pp.userapi.com/c621701/v621701765/be52/EdbVg79g3i0.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Олег Чуркашин');
        $specialist->setPhotoUri('https://pp.userapi.com/c631928/v631928657/2ed2e/c_TKyIxqsBI.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);



        $geo_novosibirsk = new Geo();
        $geo_novosibirsk->setCity('Новосибирск');
        $geo_novosibirsk->setPrepositionalCase('Новосибирске');
        $geo_novosibirsk->setGenitiveCase('Новосибирска');
        $geo_novosibirsk->setRegion('Новосибирская область');
        $geo_novosibirsk->setHost('novosib.ivcg.ru');
        $geo_novosibirsk->setPhone('8 (383) 235-93-36');
        $geo_novosibirsk->setIsVisible(1);
        $geo_novosibirsk->setJivositeCode('<script defer src=\'/js/jivosite/novosib.js\'></script>');
	    $geo_novosibirsk->setVkLink('https://vk.com/visoviycenter54');
        $geo_novosibirsk->setFbLink('https://www.facebook.com/visoviycenter54');
        $geo_novosibirsk->setInstLink('https://www.instagram.com/ivcg.ru/');
        $geo_novosibirsk->setEmail('novosib@ivcg.ru');
        $geo_novosibirsk->setVkMessage('https://vk.com/im?sel=-49285513');

        $geo_novosibirsk->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo_novosibirsk->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');

        $geo_novosibirsk->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo_novosibirsk->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $geo_novosibirsk->setHeadTitleAgency('Лучшие партнерские условия по оформлению виз - «Международный визовый центр»');
        $geo_novosibirsk->setHeadTitleSubdomainAgency('Лучшие партнерские условия {{ geo_preposition_case_with_preposition }} по оформлению виз - «Международный визовый центр»');

        $geo_novosibirsk->setMetaDescriptionAgency('«Международный визовый центр» специализируется на корректном и быстром оформлении любых типов виз, поможем повысить лояльность клиентов и станем надежным партнером вашего агентства');
        $geo_novosibirsk->setMetaDescriptionSubdomainAgency('«Международный визовый центр» специализируется на корректном и быстром оформлении виз {{ geo_preposition_case_with_preposition }} в любую из представленных стран , поможем повысить лояльность клиентов и станем надежным партнером вашего агентства');

        $geo_novosibirsk->setHeadTitleOrganization('Оформление виз с экономией рабочего времени ваших сотрудников до 30% - «Международный визовый центр»');
        $geo_novosibirsk->setHeadTitleSubdomainOrganization('Оформление виз {{ geo_preposition_case_with_preposition }} с экономией рабочего времени ваших сотрудников до 30% - «Международный визовый центр»');

        $geo_novosibirsk->setMetaDescriptionOrganization('«Международный визовый центр» поможет оформить визу для деловой поездки в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня');
        $geo_novosibirsk->setMetaDescriptionSubdomainOrganization('«Международный визовый центр» поможет оформить визу для деловой поездки {{ geo_preposition_case_with_preposition }} в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');

        $team_member = new TeamMember();
        $team_member->setGeo($geo_novosibirsk);
        $team_member->setName('Абрамова Ольга');
        $team_member->setText('CEO компании');
        $team_member->setPhotoUri('/img/team_members/abramova.jpg');
        $team_member->setPosition(30);

        $manager->persist($team_member);

        $team_member = new TeamMember();
        $team_member->setGeo($geo_novosibirsk);
        $team_member->setName('Тимофеева Алёна');
        $team_member->setText('Клиент-менеджер');
        $team_member->setPhotoUri('/img/team_members/timofeeva.jpg');
        $team_member->setPosition(20);
        $manager->persist($team_member);

        $team_member = new TeamMember();
        $team_member->setGeo($geo_novosibirsk);
        $team_member->setName('Кузмичёв Денис');
        $team_member->setText('Менеджер по продажам');
        $team_member->setPhotoUri('/img/team_members/kuzmichev.jpg');
        $team_member->setPosition(10);
        $manager->persist($team_member);




        $manager->persist($geo_novosibirsk);

        $text = '
User-agent: *
Disallow: 

User-agent: Yandex
Disallow: 

User-agent: Googlebot
Disallow: 

Sitemap: https://'.$geo_novosibirsk->getHost().'/sitemap.xml
';

        $robot = new Robot();
        $robot->setGeo($geo_novosibirsk);
        $robot->setText($text);
        $manager->persist($robot);

        $sitemap = new Sitemap();
        $sitemap->setGeo($geo_novosibirsk);
        $sitemap->setText('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"><url><loc>https://novosib.ivcg.ru/</loc><lastmod>2018-09-04T10:28:59+01:00</lastmod><priority>1.0</priority></url><url><loc>https://novosib.ivcg.ru/agency</loc><lastmod>2018-09-04T10:28:59+01:00</lastmod><priority>1.0</priority></url><url><loc>https://novosib.ivcg.ru/organization</loc><lastmod>2018-09-04T10:29:00+01:00</lastmod><priority>1.0</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/</loc><lastmod>2018-09-04T10:29:00+01:00</lastmod><priority>0.8</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-avstriyu/</loc><lastmod>2018-09-04T10:29:01+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-belgiyu/</loc><lastmod>2018-09-04T10:29:02+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-vengriyu/</loc><lastmod>2018-09-04T10:29:02+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-germaniyu/</loc><lastmod>2018-09-04T10:29:02+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-gretsiyu/</loc><lastmod>2018-09-04T10:29:03+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-daniyu/</loc><lastmod>2018-09-04T10:29:03+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-islandiyu/</loc><lastmod>2018-09-04T10:29:04+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-ispaniyu/</loc><lastmod>2018-09-04T10:29:04+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-italiyu/</loc><lastmod>2018-09-04T10:29:05+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-latviyu/</loc><lastmod>2018-09-04T10:29:06+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-litvu/</loc><lastmod>2018-09-04T10:29:07+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-lyuksemburg/</loc><lastmod>2018-09-04T10:29:08+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-na-maltu/</loc><lastmod>2018-09-04T10:29:09+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-niderlandy/</loc><lastmod>2018-09-04T10:29:09+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-norvegiyu/</loc><lastmod>2018-09-04T10:29:10+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-polshu/</loc><lastmod>2018-09-04T10:29:11+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-portugaliyu/</loc><lastmod>2018-09-04T10:29:11+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-slovakiyu/</loc><lastmod>2018-09-04T10:29:12+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-sloveniyu/</loc><lastmod>2018-09-04T10:29:13+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-finlyandiyu/</loc><lastmod>2018-09-04T10:29:14+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-vo-frantsiyu/</loc><lastmod>2018-09-04T10:29:14+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-chehiyu/</loc><lastmod>2018-09-04T10:29:15+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-shveytsariyu/</loc><lastmod>2018-09-04T10:29:16+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-shvetsiyu/</loc><lastmod>2018-09-04T10:29:17+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-shengen/viza-v-estoniyu/</loc><lastmod>2018-09-04T10:29:18+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/</loc><lastmod>2018-09-04T10:29:18+01:00</lastmod><priority>0.8</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-v-bolgariyu/</loc><lastmod>2018-09-04T10:29:19+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-v-velikobritaniyu/</loc><lastmod>2018-09-04T10:29:20+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-na-gibraltar/</loc><lastmod>2018-09-04T10:29:20+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-v-irlandiyu/</loc><lastmod>2018-09-04T10:29:21+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-na-kipr/</loc><lastmod>2018-09-04T10:29:22+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-v-monako/</loc><lastmod>2018-09-04T10:29:23+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-v-rumyniyu/</loc><lastmod>2018-09-04T10:29:24+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-na-farerskie-ostrova/</loc><lastmod>2018-09-04T10:29:25+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-evropa/viza-v-horvatiyu/</loc><lastmod>2018-09-04T10:29:25+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/</loc><lastmod>2018-09-04T10:29:26+01:00</lastmod><priority>0.8</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-vo-vetnam/</loc><lastmod>2018-09-04T10:29:27+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-indiyu/</loc><lastmod>2018-09-04T10:29:27+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-kambodzhu/</loc><lastmod>2018-09-04T10:29:28+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-kitay/</loc><lastmod>2018-09-04T10:29:29+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-myanma/</loc><lastmod>2018-09-04T10:29:29+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-nepal/</loc><lastmod>2018-09-04T10:29:30+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-singapur/</loc><lastmod>2018-09-04T10:29:31+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-tayland/</loc><lastmod>2018-09-04T10:29:32+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-na-shri-lanku/</loc><lastmod>2018-09-04T10:29:32+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-yaponiyu/</loc><lastmod>2018-09-04T10:29:34+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-v-yuzhnuyu-koreyu/</loc><lastmod>2018-09-04T10:29:34+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-aziya/viza-na-tayvan/</loc><lastmod>2018-09-04T10:29:35+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-amerika/</loc><lastmod>2018-09-04T10:29:36+01:00</lastmod><priority>0.8</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-amerika/viza-v-grenlandiyu/</loc><lastmod>2018-09-04T10:29:36+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-amerika/viza-na-karibskie-ostrova/</loc><lastmod>2018-09-04T10:29:37+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-amerika/viza-v-kanadu/</loc><lastmod>2018-09-04T10:29:38+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-amerika/viza-v-meksiku/</loc><lastmod>2018-09-04T10:29:38+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-amerika/viza-v-ssha/</loc><lastmod>2018-09-04T10:29:39+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-amerika/viza-na-folklendskie-malvinskie-ostrova/</loc><lastmod>2018-09-04T10:29:40+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-okeaniya/</loc><lastmod>2018-09-04T10:29:41+01:00</lastmod><priority>0.8</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-okeaniya/viza-v-avstraliyu/</loc><lastmod>2018-09-04T10:29:42+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-okeaniya/viza-v-novuyu-zelandiyu/</loc><lastmod>2018-09-04T10:29:43+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-okeaniya/viza-v-novuyu-kaledoniyu-frantsiya/</loc><lastmod>2018-09-04T10:29:43+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-okeaniya/viza-v-popua-novuyu-gvineyu-avstraliya/</loc><lastmod>2018-09-04T10:29:44+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-okeaniya/viza-na-solomonovy-ostrova/</loc><lastmod>2018-09-04T10:29:45+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-okeaniya/viza-vo-frantsuzskuyu-polineziyu/</loc><lastmod>2018-09-04T10:29:45+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/</loc><lastmod>2018-09-04T10:29:46+01:00</lastmod><priority>0.8</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-iran/</loc><lastmod>2018-09-04T10:29:47+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-mavritaniyu/</loc><lastmod>2018-09-04T10:29:47+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-ruandu/</loc><lastmod>2018-09-04T10:29:48+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-serra-leone/</loc><lastmod>2018-09-04T10:29:49+01:00</lastmod><priority>0.6</priority></url><url><loc>https://novosib.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-alzhir/</loc><lastmod>2018-09-04T10:29:50+01:00</lastmod><priority>0.6</priority></url></urlset>');
        $manager->persist($sitemap);

        $specialist = new Specialist();
        $specialist->setName('Андрей Барасасанов');
        $specialist->setPhotoUri('https://pp.userapi.com/c322424/v322424846/981f/xL1eQjMSv3I.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Владимир Барасасанов');
        $specialist->setPhotoUri('https://pp.userapi.com/c831308/v831308999/9d500/MiWuMmviEQQ.jpg');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Евгений Карпов');
        $specialist->setPhotoUri('https://pp.userapi.com/c637931/v637931846/c7e2/dUxEc2ZDZbE.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Руслан Журчихин');
        $specialist->setPhotoUri('https://pp.userapi.com/c834301/v834301970/cb4a4/-8kTgOSFgBA.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Олег Рашков');
        $specialist->setPhotoUri('https://pp.userapi.com/c639417/v639417019/56959/1QWm3C6JZoc.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $geo = new Geo();
        $geo->setCity('Барнаул');
        $geo->setGenitiveCase('Барнаула');
        $geo->setPrepositionalCase('Барануле');
        $geo->setRegion('Алтайский край');
        $geo->setHost('barnaul.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);

        $geo = new Geo();
        $geo->setCity('Горно-Алтайск');
        $geo->setGenitiveCase('Горно-Алтайска');
        $geo->setPrepositionalCase('Горно-Алтайске');
        $geo->setRegion('Республика Алтай');
        $geo->setHost('gorno-altaisk.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);

        $geo = new Geo();
        $geo->setCity('Улан-Удэ');
        $geo->setGenitiveCase('Улан-Удэ');
        $geo->setPrepositionalCase('Улан-Удэ');
        $geo->setRegion('Забайкальский край');
        $geo->setHost('ulan-ude.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);

        $geo = new Geo();
        $geo->setCity('Иркутск');
        $geo->setGenitiveCase('Иркутска');
        $geo->setPrepositionalCase('Иркутске');
        $geo->setRegion('Иркутская область');
        $geo->setHost('irkutsk.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);

        $geo = new Geo();
        $geo->setCity('Кемерово');
        $geo->setGenitiveCase('Кемерово');
        $geo->setPrepositionalCase('Кемерове');
        $geo->setRegion('Кемеровская область');
        $geo->setHost('kemerovo.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);

        $geo = new Geo();
        $geo->setCity('Красноярск');
        $geo->setGenitiveCase('Красноярска');
        $geo->setPrepositionalCase('Красноярске');
        $geo->setRegion('Красноярский край');
        $geo->setHost('krasnoyarsk.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);

        $geo = new Geo();
        $geo->setCity('Омск');
        $geo->setGenitiveCase('Омска');
        $geo->setPrepositionalCase('Омске');
        $geo->setRegion('Омская область');
        $geo->setHost('omsk.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);

        $geo = new Geo();
        $geo->setCity('Кызыл');
        $geo->setGenitiveCase('Кызыл');
        $geo->setPrepositionalCase('Кызыле');
        $geo->setRegion('Республика Тыва');
        $geo->setHost('kyzyl.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);

        $geo = new Geo();
        $geo->setCity('Абакан');
        $geo->setGenitiveCase('Абакана');
        $geo->setPrepositionalCase('Абакане');
        $geo->setRegion('Республика Хакасия');
        $geo->setHost('abakan.ivcg.ru');
        $geo->setGeo($geo_novosibirsk);
        $geo->setIsVisible(0);

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');
        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $manager->persist($geo);







        $geo = new Geo();
        $geo->setCity('Томск');
        $geo->setGenitiveCase('Томска');
        $geo->setPrepositionalCase('Томске');
        $geo->setRegion('Томская область');
        $geo->setHost('tomsk.ivcg.ru');
        $geo->setPhone('8 (382) 248-94-17');
        $geo->setIsVisible(1);
        $geo->setJivositeCode('<script defer src=\'/js/jivosite/tomsk.js\'></script>');
	    $geo->setVkLink('https://vk.com/visoviycenter70');
        $geo->setFbLink('https://www.facebook.com/visoviycenter70');
        $geo->setInstLink('https://www.instagram.com/ivcg.ru/');
        $geo->setEmail('tomsk@ivcg.ru');
        $geo->setVkMessage('https://vk.com/im?sel=-165934731');

        $geo->setHeadTitle('Быстрое оформление визы в любую страну мира – «Международный визовый центр».');
        $geo->setHeadTitleSubdomain('Быстрое оформление и получение визы в любую страну мира {{ geo_preposition_case_with_preposition }} – «Международный визовый центр»');

        $geo->setMetaDescription('«Международный визовый центр» поможет Вам получить визу в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');
        $geo->setMetaDescriptionSubdomain('«Международный визовый центр» поможет Вам получить визу {{ geo_preposition_case_with_preposition }} в любую из представленных стран в два раза быстрее и проще, чем при самостоятельном получении, с гарантией в 99,98% в срок от одного рабочего дня.');

        $geo->setHeadTitleAgency('Лучшие партнерские условия по оформлению виз - «Международный визовый центр»');
        $geo->setHeadTitleSubdomainAgency('Лучшие партнерские условия {{ geo_preposition_case_with_preposition }} по оформлению виз - «Международный визовый центр»');

        $geo->setMetaDescriptionAgency('«Международный визовый центр» специализируется на корректном и быстром оформлении любых типов виз, поможем повысить лояльность клиентов и станем надежным партнером вашего агентства');
        $geo->setMetaDescriptionSubdomainAgency('«Международный визовый центр» специализируется на корректном и быстром оформлении виз {{ geo_preposition_case_with_preposition }} в любую из представленных стран , поможем повысить лояльность клиентов и станем надежным партнером вашего агентства');

        $geo->setHeadTitleOrganization('Оформление виз с экономией рабочего времени ваших сотрудников до 30% - «Международный визовый центр»');
        $geo->setHeadTitleSubdomainOrganization('Оформление виз {{ geo_preposition_case_with_preposition }} с экономией рабочего времени ваших сотрудников до 30% - «Международный визовый центр»');

        $geo->setMetaDescriptionOrganization('«Международный визовый центр» поможет оформить визу для деловой поездки в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня');
        $geo->setMetaDescriptionSubdomainOrganization('«Международный визовый центр» поможет оформить визу для деловой поездки {{ geo_preposition_case_with_preposition }} в любую из представленных стран с гарантией 99,98% в срок от одного рабочего дня.');

        $team_member = new TeamMember();
        $team_member->setGeo($geo);
        $team_member->setName('Абрамова Ольга');
        $team_member->setText('CEO компании');
        $team_member->setPhotoUri('/img/team_members/abramova.jpg');
        $team_member->setPosition(30);

        $team_member = new TeamMember();
        $team_member->setGeo($geo);
        $team_member->setName('Тимофеева Алёна');
        $team_member->setText('Клиент-менеджер');
        $team_member->setPhotoUri('/img/team_members/timofeeva.jpg');
        $team_member->setPosition(20);
        $manager->persist($team_member);

        $team_member = new TeamMember();
        $team_member->setGeo($geo);
        $team_member->setName('Кузмичёв Денис');
        $team_member->setText('Менеджер по продажам');
        $team_member->setPhotoUri('/img/team_members/kuzmichev.jpg');
        $team_member->setPosition(10);
        $manager->persist($team_member);


        $manager->persist($team_member);


        $manager->persist($geo);

        $text = '
User-agent: *
Disallow: 

User-agent: Yandex
Disallow: 

User-agent: Googlebot
Disallow: 

Sitemap: https://'.$geo->getHost().'/sitemap.xml
';

        $robot = new Robot();
        $robot->setGeo($geo);
        $robot->setText($text);
        $manager->persist($robot);

        $sitemap = new Sitemap();
        $sitemap->setGeo($geo);
        $sitemap->setText('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"><url><loc>https://tomsk.ivcg.ru/</loc><lastmod>2018-09-04T10:24:58+01:00</lastmod><priority>1.0</priority></url><url><loc>https://tomsk.ivcg.ru/agency</loc><lastmod>2018-09-04T10:24:58+01:00</lastmod><priority>1.0</priority></url><url><loc>https://tomsk.ivcg.ru/organization</loc><lastmod>2018-09-04T10:24:59+01:00</lastmod><priority>1.0</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/</loc><lastmod>2018-09-04T10:24:59+01:00</lastmod><priority>0.8</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-avstriyu/</loc><lastmod>2018-09-04T10:25:00+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-belgiyu/</loc><lastmod>2018-09-04T10:25:00+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-vengriyu/</loc><lastmod>2018-09-04T10:25:01+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-germaniyu/</loc><lastmod>2018-09-04T10:25:01+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-gretsiyu/</loc><lastmod>2018-09-04T10:25:02+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-daniyu/</loc><lastmod>2018-09-04T10:25:02+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-islandiyu/</loc><lastmod>2018-09-04T10:25:03+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-ispaniyu/</loc><lastmod>2018-09-04T10:25:03+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-italiyu/</loc><lastmod>2018-09-04T10:25:04+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-latviyu/</loc><lastmod>2018-09-04T10:25:05+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-litvu/</loc><lastmod>2018-09-04T10:25:06+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-lyuksemburg/</loc><lastmod>2018-09-04T10:25:07+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-na-maltu/</loc><lastmod>2018-09-04T10:25:08+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-niderlandy/</loc><lastmod>2018-09-04T10:25:08+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-norvegiyu/</loc><lastmod>2018-09-04T10:25:09+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-polshu/</loc><lastmod>2018-09-04T10:25:10+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-portugaliyu/</loc><lastmod>2018-09-04T10:25:10+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-slovakiyu/</loc><lastmod>2018-09-04T10:25:11+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-sloveniyu/</loc><lastmod>2018-09-04T10:25:12+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-finlyandiyu/</loc><lastmod>2018-09-04T10:25:12+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-vo-frantsiyu/</loc><lastmod>2018-09-04T10:25:14+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-chehiyu/</loc><lastmod>2018-09-04T10:25:15+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-shveytsariyu/</loc><lastmod>2018-09-04T10:25:15+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-shvetsiyu/</loc><lastmod>2018-09-04T10:25:16+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-shengen/viza-v-estoniyu/</loc><lastmod>2018-09-04T10:25:17+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/</loc><lastmod>2018-09-04T10:25:17+01:00</lastmod><priority>0.8</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-v-bolgariyu/</loc><lastmod>2018-09-04T10:25:18+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-v-velikobritaniyu/</loc><lastmod>2018-09-04T10:25:19+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-na-gibraltar/</loc><lastmod>2018-09-04T10:25:19+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-v-irlandiyu/</loc><lastmod>2018-09-04T10:25:20+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-na-kipr/</loc><lastmod>2018-09-04T10:25:21+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-v-monako/</loc><lastmod>2018-09-04T10:25:21+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-v-rumyniyu/</loc><lastmod>2018-09-04T10:25:23+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-na-farerskie-ostrova/</loc><lastmod>2018-09-04T10:25:24+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-evropa/viza-v-horvatiyu/</loc><lastmod>2018-09-04T10:25:24+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/</loc><lastmod>2018-09-04T10:25:25+01:00</lastmod><priority>0.8</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-vo-vetnam/</loc><lastmod>2018-09-04T10:25:26+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-indiyu/</loc><lastmod>2018-09-04T10:25:26+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-kambodzhu/</loc><lastmod>2018-09-04T10:25:27+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-kitay/</loc><lastmod>2018-09-04T10:25:28+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-myanma/</loc><lastmod>2018-09-04T10:25:28+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-nepal/</loc><lastmod>2018-09-04T10:25:29+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-singapur/</loc><lastmod>2018-09-04T10:25:31+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-tayland/</loc><lastmod>2018-09-04T10:25:31+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-na-shri-lanku/</loc><lastmod>2018-09-04T10:25:32+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-yaponiyu/</loc><lastmod>2018-09-04T10:25:33+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-v-yuzhnuyu-koreyu/</loc><lastmod>2018-09-04T10:25:33+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-aziya/viza-na-tayvan/</loc><lastmod>2018-09-04T10:25:34+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-amerika/</loc><lastmod>2018-09-04T10:25:35+01:00</lastmod><priority>0.8</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-amerika/viza-v-grenlandiyu/</loc><lastmod>2018-09-04T10:25:35+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-amerika/viza-na-karibskie-ostrova/</loc><lastmod>2018-09-04T10:25:38+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-amerika/viza-v-kanadu/</loc><lastmod>2018-09-04T10:25:38+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-amerika/viza-v-meksiku/</loc><lastmod>2018-09-04T10:25:38+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-amerika/viza-v-ssha/</loc><lastmod>2018-09-04T10:25:40+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-amerika/viza-na-folklendskie-malvinskie-ostrova/</loc><lastmod>2018-09-04T10:25:40+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-okeaniya/</loc><lastmod>2018-09-04T10:25:40+01:00</lastmod><priority>0.8</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-okeaniya/viza-v-avstraliyu/</loc><lastmod>2018-09-04T10:25:42+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-okeaniya/viza-v-novuyu-zelandiyu/</loc><lastmod>2018-09-04T10:25:42+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-okeaniya/viza-v-novuyu-kaledoniyu-frantsiya/</loc><lastmod>2018-09-04T10:25:42+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-okeaniya/viza-v-popua-novuyu-gvineyu-avstraliya/</loc><lastmod>2018-09-04T10:25:45+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-okeaniya/viza-na-solomonovy-ostrova/</loc><lastmod>2018-09-04T10:25:45+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-okeaniya/viza-vo-frantsuzskuyu-polineziyu/</loc><lastmod>2018-09-04T10:25:45+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/</loc><lastmod>2018-09-04T10:25:47+01:00</lastmod><priority>0.8</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-iran/</loc><lastmod>2018-09-04T10:25:47+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-mavritaniyu/</loc><lastmod>2018-09-04T10:25:47+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-ruandu/</loc><lastmod>2018-09-04T10:25:49+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-serra-leone/</loc><lastmod>2018-09-04T10:25:49+01:00</lastmod><priority>0.6</priority></url><url><loc>https://tomsk.ivcg.ru/napravlenie-afrika-i-blizhniy-vostok/viza-v-alzhir/</loc><lastmod>2018-09-04T10:25:49+01:00</lastmod><priority>0.6</priority></url></urlset>');
        $manager->persist($sitemap);

        $specialist = new Specialist();
        $specialist->setName('Вадим Барасасанов');
        $specialist->setPhotoUri('https://pp.userapi.com/c840229/v840229126/84928/jIWE5XEfhRM.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Олег Барасасанов');
        $specialist->setPhotoUri('https://pp.userapi.com/c629308/v629308793/1fe83/05xx_cb4FYE.jpg');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Руслан Барасасанов');
        $specialist->setPhotoUri('https://pp.userapi.com/c837330/v837330845/63f89/5qel7S2KPzE.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Александр Барасасанов');
        $specialist->setPhotoUri('https://pp.userapi.com/c841229/v841229377/8dc7/uxWfTMDbM5o.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);

        $specialist = new Specialist();
        $specialist->setName('Пётр Барасасанов');
        $specialist->setPhotoUri('https://pp.userapi.com/c844416/v844416853/22483/BoCBEyeSQ0c.jpg');
        $specialist->setVideoUri('http://www.youtube.com/watch?v=dCyv3HQr7b8');
        $specialist->setPosition(0);
        $specialist->setGeo($geo);
        $manager->persist($specialist);






        $manager->flush();

    }
}