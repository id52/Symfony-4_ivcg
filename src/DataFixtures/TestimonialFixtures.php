<?php

namespace App\DataFixtures;

use App\Entity\Testimonial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TestimonialFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //https://cdn1.iconfinder.com/data/icons/user-pictures/101/malecostume-512.png

        $testimonial = new Testimonial();
        $testimonial->setClient('Dobryi-expert');
        $testimonial->setUri('https://novosibirsk.flamp.ru/firm/mezhdunarodnyjj_vizovyjj_centr_vizovoe_agentstvo-141266769656704/otzyv-3240344');
        $testimonial->setPhotoUri('/img/testimonials/661fad4f65ff6acb39f52ad2eebe1ce0_100_100.jpg');
        $testimonial->setPosition(10);

        $testimonial->setText('Делала шенген в данном центре! Работу сотрудников оцениваю на отлично! Все было сделано оперативно и качественно! Девочки всегда готовы ответить на все вопросы, и оказать помощь, если это необходимо! Буду советовать Вас всем...');
        $manager->persist($testimonial);




        $testimonial = new Testimonial();
        $testimonial->setClient('Яна Вергуш');
        $testimonial->setUri('https://novosibirsk.flamp.ru/firm/mezhdunarodnyjj_vizovyjj_centr_vizovoe_agentstvo-141266769656704/otzyv-3861789');
        $testimonial->setPhotoUri('/img/testimonials/3bb390e57a02cc08188a5045b4d0ce73_100_100.jpg');
        $testimonial->setPosition(10);
        $testimonial->setText('От души благородию компанию! ) за комфорт, мгновенные консультации, помощь во всех вопросах, мобильность в предоставлении необходимых документов для оформления визы. Весь коллектив профессионален и приятен...');
        $manager->persist($testimonial);




        $testimonial = new Testimonial();
        $testimonial->setClient('S_Mua');
        $testimonial->setUri('https://novosibirsk.flamp.ru/firm/mezhdunarodnyjj_vizovyjj_centr_vizovoe_agentstvo-141266769656704/otzyv-3566729');
        $testimonial->setPhotoUri('/img/fact/default-avatar-f_100_100.jpg');
        $testimonial->setPosition(0);
        $testimonial->setText('Делали китайскую визу в Международном Визовом центре. Сделали все быстро и качественно, подсказали, помогли заполнить все документы. Без хлопот и очередей. Спасибо за оперативность.');
        $manager->persist($testimonial);




        $testimonial = new Testimonial();
        $testimonial->setClient('Ирина Долженко');
        $testimonial->setUri('https://novosibirsk.flamp.ru/firm/mezhdunarodnyjj_vizovyjj_centr_vizovoe_agentstvo-141266769656704/otzyv-3209455');
        $testimonial->setPhotoUri('/img/testimonials/917c3c2d0c018d825efdd61b352421b7_100_100.jpg');
        $testimonial->setPosition(10);
        $testimonial->setText('Благодарим Вас за оперативность! Вы смогли оформить настолько оперативно и сопровождать в процессе, что мы сэкономили много времени, денег и нервов! Обращались по срочному оформлению шенгена после отказа...');
        $manager->persist($testimonial);




        $testimonial = new Testimonial();
        $testimonial->setClient('tatarina.72');
        $testimonial->setUri('https://novosibirsk.flamp.ru/firm/mezhdunarodnyjj_vizovyjj_centr_vizovoe_agentstvo-141266769656704/otzyv-3018595');
        $testimonial->setPhotoUri('/img/fact/default-avatar-f_100_100.jpg');
        $testimonial->setPosition(0);
        $testimonial->setText('Лучшая компания! Нужно было сделать визу в Испанию на семью из 4 человек. Сами из другого города(Кемерово),поэтому искала в Интернете любой визовый центр. Случайно попала на акцию...');

        $manager->persist($testimonial);

        $manager->flush();

    }
}