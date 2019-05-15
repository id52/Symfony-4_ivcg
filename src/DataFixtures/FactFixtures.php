<?php

namespace App\DataFixtures;

use App\Entity\Fact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FactFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {


        $fact = new Fact();
        $fact->setClient('Буцких Кристина');
        $fact->setSex('female');

        $fact->setProblem('<ul><li>Поехать к отцу и его семье в Австралию</li><li>Получить визу после отказа</li><li>Получить визу жениху, который никогда не был в Австралии, также получил отказ и имеет небольшую историю путешествий</li><li>Поездка в декабре, а в сентябре состоится бракосочетание, вследствие чего меняется фамилия</li></ul>');
        $fact->setSolution('<ul><li>Сотрудники «Международный визовый центр» изучили все документы</li><li>Благодаря накопленной базе знаний, по предыдущему заявлению была выяснена причина отказа</li><li>Приняты меры по устранению неточностей в оформлении заявления</li><li>Был составлен список дополнительных документов, которые подкрепили заявление</li></ul>');

        $fact->setNumber1(3);
        $fact->setNumber2(4);
        $fact->setNumber3(15000);
        $fact->setNumber4(25400);
        $fact->setNumber5(1);

        $fact->setMeasure1('недели');
        $fact->setMeasure2('часа');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('рублей');
        $fact->setMeasure5('раз');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('— выяснена причина отказа');
        $fact->setOption3('сэкономлено клиенту');
        $fact->setOption4('— стоимость оформления');
        $fact->setOption5('клиент посетил офис');

        $fact->setPosition(0);
        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Давлатмуродов Шараф и Конаков Денис');
        $fact->setSex('male');
        $fact->setProblem('<ul><li>Получить визу в Австралию для участия в профессиональных спортивных соревнованиях</li><li>Исключить отказ</li><li>Получить разрешение на посещение страны в срок до 3 недель</li></ul>');
        $fact->setSolution('<ul><li>Составление индивидуального списка документов для данной цели поездки</li><li>Подготовка документов и оформление заявления за 2 рабочих дня</li><li>Составление корректного CV клиента</li><li>Получение готовой визы</li></ul>');

        $fact->setNumber1(5);
        $fact->setNumber2(2);
        $fact->setNumber3(32);
        $fact->setNumber4(39800);
        $fact->setNumber5(2);

        $fact->setMeasure1('дней');
        $fact->setMeasure2('раза');
        $fact->setMeasure3('файла');
        $fact->setMeasure4('рублей');
        $fact->setMeasure5('новых клиента');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('клиент посетил офис');
        $fact->setOption3('отправлено в консульство');
        $fact->setOption4('— стоимость оформления');
        $fact->setOption5('по рекомендации');

        $fact->setPosition(0);

        $manager->persist($fact);















        $fact = new Fact();
        $fact->setClient('Юргина Юлия');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Поездка в Австралию с гостевой целью к жениху</li><li>Понять причины предыдущего отказа</li><li>Устранить препятствия в получении</li><li>Гарантировано получить визу</li></ul>');
        $fact->setSolution('<ul><li>Сотрудники «Международный визовый центр» выяснили причины предыдущего отказа</li><li>Собрали максимальный пакет документов</li><li>Написали сопроводительное письмо, объясняющие цель поездки</li><li>Приложили документы, подтверждающие гарантии возвращения</li><li>Получили визу</li></ul>');

        $fact->setNumber1(1);
        $fact->setNumber2(55);
        $fact->setNumber3(1);
        $fact->setNumber4(13400);
        $fact->setNumber5(30);

        $fact->setMeasure1('месяц');
        $fact->setMeasure2('файлов');
        $fact->setMeasure3('раз');
        $fact->setMeasure4('рублей');
        $fact->setMeasure5('дней');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('отправлено в консульство');
        $fact->setOption3('посетил офис');
        $fact->setOption4('— стоимость оформления');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);
        $manager->persist($fact);





        $fact = new Fact();
        $fact->setClient('Терехов Анатолий Михайлович (ветеран ВОВ)');
        $fact->setSex('male');
        $fact->setProblem('<ul><li>Поездка в Австрию с целью посещения мест сражений</li><li>Гарантировано получить визу</li><li>Получить визу в срок до 10 рабочих дней</li><li>Получить визу с минимальными затратами</li></ul>');
        //$fact->setSolution('<ul><li>Составили индивидуальный список документов, в том числе приложили справку об инвалидности с целью освобождения от сборов</li><li>Написали сопроводительное письмо, объясняющие цель поездки и составили маршрут поездки</li><li>Приложили документы, подтверждающие гарантии возвращения</li><li>Организовали получение паспорта в Москве с целью сокращения сроков рассмотрения</li><li>Сделали скидку ветерану ВОВ</li><li>Получили визу вовремя</li></ul>');
        $fact->setSolution('<ul><li>Составили список документов, приложили справку об инвалидности с целью освобождения от сборов</li><li>Написали сопроводительное письмо, объясняющие цель поездки и составили маршрут поездки</li><li>Приложили документы, гарантирующие возвращение</li><li>Организовали получение паспорта в Москве с целью сокращения сроков рассмотрения</li><li>Сделали скидку ветерану ВОВ</li><li>Получили визу вовремя</li></ul>');

        $fact->setNumber1(10000);
        $fact->setNumber2(10);
        $fact->setNumber3(29);
        $fact->setNumber4(0);
        $fact->setNumber5(6000);

        $fact->setMeasure1('рублей');
        $fact->setMeasure2('дней');
        $fact->setMeasure3('файлов');
        $fact->setMeasure4('раз');
        $fact->setMeasure5('рублей');

        $fact->setOption1('— стоимость оформления');
        $fact->setOption2('ушло на получение визы');
        $fact->setOption3('отправлено в консульство');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('сэкономлено клиенту');

        $fact->setPosition(0);
        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Быковская Елена');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить бельгийскую шенгенскую визу сроком на 3-5 лет</li></ul>');
        $fact->setSolution('<ul><li>Составили индивидуальный список документов</li><li>Написали сопроводительное письмо, объясняющие причины получения визы на долгий срок</li><li>Приложили документы, подтверждающие цель поездки (приглашения делового и личного характера)</li><li>Приложили документы, подтверждающие гарантии возвращения</li><li>Получили визу</li></ul>');

        $fact->setNumber1(12);
        $fact->setNumber2(10200);
        $fact->setNumber3(5);
        $fact->setNumber4(2);
        $fact->setNumber5(30000);

        $fact->setMeasure1('дней');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('лет');
        $fact->setMeasure4('раза');
        $fact->setMeasure5('рублей');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('стоимость оформления');
        $fact->setOption3('— срок действия визы');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('— сэкономлено клиенту');

        $fact->setPosition(0);
        $manager->persist($fact);






        $fact = new Fact();
        $fact->setClient('Жоголева Наталья');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Поездка в к супругу, который живет и работает в Бельгии</li><li>Гарантировано получить визу </li><li>Получить визу минимум на полгода при отсутствии шенгенских виз ранее</li></ul>');
        $fact->setSolution('<ul><li>Составили индивидуальный список документов</li><li>Написали сопроводительное письмо, объясняющие цель поездки и причины запроса визы на долгий срок</li><li>Приложили документы от приглашающей стороны</li><li>Собрали максимальный пакет дополнительных документов</li><li>Получили визу на год</li></ul>');

        $fact->setNumber1(14520);
        $fact->setNumber2(1);
        $fact->setNumber3(10);
        $fact->setNumber4(2);
        $fact->setNumber5(5000);

        $fact->setMeasure1('рублей');
        $fact->setMeasure2('год');
        $fact->setMeasure3('дней');
        $fact->setMeasure4('раза');
        $fact->setMeasure5('рублей');

        $fact->setOption1('— стоимость оформления');
        $fact->setOption2('— срок действия визы');
        $fact->setOption3('ушло на получение визы');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('— сэкономлено клиенту');

        $fact->setPosition(0);
        $manager->persist($fact);







        $fact = new Fact();
        $fact->setClient('Подоляк Наталья');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Поездка в Великобританию на свадьбу к сестре</li><li>Гарантировано получить визу при отсутствии истории путешествий</li></ul>');
        $fact->setSolution('<ul><li>Составили список необходимых документов</li><li>Приложили максимум документов от принимающей стороны</li><li>Документально подтвердили родство с приглашающей стороной</li><li>Приложили документы, подтверждающие гарантии возвращения</li><li>Виза получена</li></ul>');

        $fact->setNumber1(14);
        $fact->setNumber2(13400);
        $fact->setNumber3(10000);
        $fact->setNumber4(2);
        $fact->setNumber5(54);

        $fact->setMeasure1('дней');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('раза');
        $fact->setMeasure5('файла');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('— стоимость оформления');
        $fact->setOption3('сэкономлено клиенту');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('отправлено в консульство');

        $fact->setPosition(0);
        
        $manager->persist($fact);







        $fact = new Fact();
        $fact->setClient('Абдазимова Елена');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить визу в Венгрию по гостевой цели без приглашения</li><li>Получить визу сроком не менее, чем на 2 года</li><li>Получить визу в срок до 10 рабочих дней</li></ul>');
        $fact->setSolution('<ul><li>Собрали документы по туристической цели поездки</li><li>Сделали запрос многократной двухгодовой визы</li><li>Подготовили документы в срочном порядке и подали на срочное рассмотрение</li><li>Получили визу вовремя</li></ul>');

        $fact->setNumber1(11480);
        $fact->setNumber2(2);
        $fact->setNumber3(0);
        $fact->setNumber4(15);
        $fact->setNumber5(20000);

        $fact->setMeasure1('рублей');
        $fact->setMeasure2('года');
        $fact->setMeasure3('раз');
        $fact->setMeasure4('дней');
        $fact->setMeasure5('рублей');

        $fact->setOption1('— стоимость оформления');
        $fact->setOption2('— срок действия визы');
        $fact->setOption3('клиент посетил офис');
        $fact->setOption4('ушло на получение визы');
        $fact->setOption5('сэкономлено клиенту');

        $fact->setPosition(0);

        $manager->persist($fact);





        $fact = new Fact();
        $fact->setClient('Ашуркина Анна');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить шенгенскую визу за 5 рабочих дней</li></ul>');
        $fact->setSolution('<ul><li>Собрали документы для немецкой шенгенской визы</li><li>Подготовили и подали документы на срочную визу за 1 рабочий день </li><li>Получили визу вовремя</li></ul>');

        $fact->setNumber1(3);
        $fact->setNumber2(30000);
        $fact->setNumber3(9000);
        $fact->setNumber4(0);
        $fact->setNumber5(14);

        $fact->setMeasure1('дня');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('раз');
        $fact->setMeasure5('файлов');


        $fact->setOption1('дня ушло на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('отправлено в консульство');

        $fact->setPosition(0);
        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Пикалов Максим');
        $fact->setSex('male');
        $fact->setProblem('<ul><li>Получить шенгенскую визу на долгий срок</li><li>Получить визу в срок до 8 рабочих дней</li></ul>');
        $fact->setSolution('<ul><li>Собрали документы для греческой шенгенской визы</li><li>Подготовили и подали документы на визу за 1 рабочий день </li><li>Получили визу вовремя</li></ul>');

        $fact->setNumber1(8);
        $fact->setNumber2(30000);
        $fact->setNumber3(8000);
        $fact->setNumber4(3);
        $fact->setNumber5(10);

        $fact->setMeasure1('дней');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('года');
        $fact->setMeasure5('новых клиентов');


        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('— срок действия визы');
        $fact->setOption5('по рекомендации');

        $fact->setPosition(0);
        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Абдурахманов Фарух');
        $fact->setSex('male');
        $fact->setProblem('<ul><li>Получить гостевую греческую визу после отказа</li><li>Понять причину отказа в оформлении визы</li><li>Устранить препятствия в получении</li></ul>');
        $fact->setSolution('<ul><li>Проанализировали причины отказа</li><li>Подготовили пакет документов на гостевую визу в соответствии требованиям консульства</li><li>Приложили дополнительные документы, объясняющие цель поездки и гарантии возвращения</li><li>Получили визу</li></ul>');

        $fact->setNumber1(8);
        $fact->setNumber2(50000);
        $fact->setNumber3(7500);
        $fact->setNumber4(30);
        $fact->setNumber5(15);

        $fact->setMeasure1('дней');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('минут');
        $fact->setMeasure5('дней');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('— выяснена причина отказа');
        $fact->setOption5('— срок действия визы');


        $fact->setPosition(0);
        $manager->persist($fact);







        $fact = new Fact();
        $fact->setClient('Катлеева Светлана');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить визу в Данию на 30 дней</li><li>При отсутствии работы</li><li>При отсутствии финансовых документов</li><li>При отсутствии шенгенских виз ранее</li></ul>');
        $fact->setSolution('<ul><li>Собрали пакет документов для оформления гостевой визы в Данию</li><li>В качестве финансовых документов показали спонсорство</li><li>Прописали сопроводительное письмо, подробно объясняющее цель поездки</li><li>Приложили документы принимающей стороны</li><li>Получили визу</li></ul>');

        $fact->setNumber1(9000);
        $fact->setNumber2(10);
        $fact->setNumber3(0);
        $fact->setNumber4(24);
        $fact->setNumber5(32);

        $fact->setMeasure1('рублей');
        $fact->setMeasure2('дней');
        $fact->setMeasure3('раз');
        $fact->setMeasure4('файла');
        $fact->setMeasure5('дня');

        $fact->setOption1('— стоимость оформления');
        $fact->setOption2('ушло на получение визы');
        $fact->setOption3('клиент посетил офис');
        $fact->setOption4('отправлено в консульство');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);
        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Козлова Елена');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить многократную рабочую визу в Индию сроком на полгода</li></ul>');
        $fact->setSolution('<ul><li>Составили индивидуальный перечень документов согласно требованиям консульства</li><li>Получили необходимые документы от приглашающей стороны</li><li>Подготовили пакет документов согласно требованиям</li><li>Получили визу</li></ul>');

        $fact->setNumber1(15);
        $fact->setNumber2(17000);
        $fact->setNumber3(0);
        $fact->setNumber4(21);
        $fact->setNumber5(6);

        $fact->setMeasure1('дней');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('раз');
        $fact->setMeasure4('файл');
        $fact->setMeasure5('месяцев');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('— стоимость оформления');
        $fact->setOption3('клиент посетил офис');
        $fact->setOption4('отправлен в консульство');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);

        $manager->persist($fact);











        $fact = new Fact();
        $fact->setClient('Бурдуков Петр');
        $fact->setSex('male');
        $fact->setProblem('<ul><li>Получить визу в Индию за 3 дня до поездки</li></ul>');
        $fact->setSolution('<ul><li>Собрали документы для электронной визы в Индию</li><li>Подготовили и отправили заявление за 1 рабочий день</li><li>Получили визу на следующий день</li></ul>');

        $fact->setNumber1(7100);
        $fact->setNumber2(30000);
        $fact->setNumber3(0);
        $fact->setNumber4(1);
        $fact->setNumber5(4);

        $fact->setMeasure1('рублей');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('раз');
        $fact->setMeasure4('день');
        $fact->setMeasure5('месяца');

        $fact->setOption1('— стоимость оформления');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('раз клиент посетил офис');
        $fact->setOption4('ушёл на получение визы');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);
        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Чеботарева Инна');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить многократную визу в Индию сроком на год для прохождения стажировки по программе AIESEC</li></ul>');
        $fact->setSolution('<ul><li>Составили индивидуальный перечень документов согласно требованиям консульства</li><li>Получили необходимые документы от приглашающей стороны</li><li>Подготовили пакет документов согласно требованиям</li><li>Получили визу</li></ul>');

        $fact->setNumber1(15);
        $fact->setNumber2(17000);
        $fact->setNumber3(0);
        $fact->setNumber4(23);
        $fact->setNumber5(1);

        $fact->setMeasure1('дней');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('раз');
        $fact->setMeasure4('файла');
        $fact->setMeasure5('год');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('— стоимость оформления');
        $fact->setOption3('клиент посетил офис');
        $fact->setOption4('отправлено в консульство');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);
        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Володина Ольга');
        $fact->setSex('female');
        $fact->setPhotoUri('https://ivcg.ru/img/fact/image1.jpg');
        $fact->setProblem('<ul><li>Получить визу в Норвегию для воссоединения семьи после нарушения правил пребывания в шенгенской зоне и двух отказов в гостевой визе</li><li>Понять причину отказов в оформлении визы</li><li>Устранить препятствия в получении визы</li></ul>');
        $fact->setSolution('<ul><li>Проанализировали причины отказа</li><li>Корректно заполнили анкету в системе UDI</li><li>Подготовили пакет документов на визу в соответствии требованиям консульства</li><li>Приложили дополнительные документы, объясняющие цель поездки</li><li>Прописали сопроводительное письмо</li><li>Получили визу</li></ul>');

        $fact->setNumber1(1);
        $fact->setNumber2(30);
        $fact->setNumber3(7400);
        $fact->setNumber4(23);
        $fact->setNumber5(63);

        $fact->setMeasure1('месяц');
        $fact->setMeasure2('минут');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('раза');
        $fact->setMeasure5('файла');

        $fact->setOption1('ушёл на получение визы');
        $fact->setOption2('— выяснена причина отказа');
        $fact->setOption3('стоимость оформления');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('отправлено в консульство');

        $fact->setPosition(10);
        $manager->persist($fact);







        $fact = new Fact();
        $fact->setClient('Долженко Ирина');
        $fact->setSex('female');
        $fact->setPhotoUri('https://ivcg.ru/img/fact/image3.jpg');
        $fact->setProblem('<ul><li>Получить туристическую визу во Францию визу после отказа Шведского консульства</li><li>Получить визу за 10 рабочих дней</li></ul>');
        $fact->setSolution('<ul><li>Проанализировали причины отказа</li><li>За несколько часов подготовили и подали пакет документов на туристическую визу в соответствии требованиям консульства</li><li>Прописали сопроводительное письмо, объясняющее цель поездки и смену маршрута</li><li>Организовали получение паспорта в Москве</li><li>Получили визу</li></ul>');
        $fact->setVkUri('https://novosibirsk.flamp.ru/firm/mezhdunarodnyjj_vizovyjj_centr_vizovoe_agentstvo-141266769656704/otzyv-3209455#comments');

        $fact->setNumber1(10);
        $fact->setNumber2(160000);
        $fact->setNumber3(9700);
        $fact->setNumber4(30);
        $fact->setNumber5(6);

        $fact->setMeasure1('дней');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('минут');
        $fact->setMeasure5('месяцев');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('— выяснена причина отказа');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(10);
        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Галочкина Любовь');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить визу в США повторно</li><li>Есть родственники в стране назначения</li><li>Нет приглашения от родственников</li><li>Отсутствует история путешествий за 5 лет, кроме США</li><li>Получить визу в консульстве США в РФ</li></ul>');
        $fact->setSolution('<ul><li>Правильно заполнили консульскую анкету DS-160</li><li>Часто мониторили наличие записи на собеседование, чтобы записать в консульство США в Екатеринбурге</li><li>Проконсультировали по собеседованию</li><li>Получили визу</li></ul>');

        $fact->setNumber1(1);
        $fact->setNumber2(10000);
        $fact->setNumber3(14700);
        $fact->setNumber4(2);
        $fact->setNumber5(3);

        $fact->setMeasure1('месяц');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('раз');
        $fact->setMeasure5('года');

        $fact->setOption1('ушёл на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);

        $manager->persist($fact);








        $fact = new Fact();
        $fact->setClient('Реттлинг Владимир');
        $fact->setSex('male');
        $fact->setPhotoUri('https://ivcg.ru/img/fact/image2.jpg');
        $fact->setProblem('<ul><li>Получить визу в Сингапур для участия в тренинге группе из 12 человек, среди которых молодые девушки до 32 лет</li><li>Исключить отказ</li><li>Оформить визы без личного присутствия</li></ul>');
        $fact->setSolution('<ul><li>Собрали необходимый минимум документов</li><li>Корректно заполнили анкету в системе</li><li>Подготовили пакет документов для девушек в соответствии требованиям консульства</li><li>Приложили дополнительные документы, объясняющие цель поездки</li><li>Получили визы</li></ul>');
        $fact->setVkUri('https://novosibirsk.flamp.ru/firm/mezhdunarodnyjj_vizovyjj_centr_vizovoe_agentstvo-141266769656704/otzyv-3865877#comments');


        $fact->setNumber1(2);
        $fact->setNumber2(280000);
        $fact->setNumber3(42000);
        $fact->setNumber4(0);
        $fact->setNumber5(63);

        $fact->setMeasure1('недели');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('раз');
        $fact->setMeasure5('файла');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(10);

        $manager->persist($fact);












        $fact = new Fact();
        $fact->setClient('Гапшис Татьяна');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить визу в Ирландию для двух пенсионеров</li><li>Есть родственники в стране назначения</li><li>Отсутствует история путешествий</li><li>Отсутствуют собственные финансы</li></ul>');
        $fact->setSolution('<ul><li>Составили необходимый список документов согласно требованиям консульства</li><li>Помогли подготовить пакет документов от принимающей стороны</li><li>Правильно заполнили анкету в системе Консульства Ирландии</li><li>Сделали переводы документов</li><li>Получили визы</li></ul>');

        $fact->setNumber1(1);
        $fact->setNumber2(8000);
        $fact->setNumber3(21400);
        $fact->setNumber4(2);
        $fact->setNumber5(3);

        $fact->setMeasure1('месяц');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('раза');
        $fact->setMeasure5('месяца');

        $fact->setOption1('ушёл на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);

        $manager->persist($fact);






        $fact = new Fact();
        $fact->setClient('Зимбицкая Татьяна');
        $fact->setSex('female');
        $fact->setProblem('<ul><li>Получить визу в Испанию для мамы и ребенка</li><li>Нет согласия на выезд от папы </li><li>Отсутствуют документы по цели поездки</li></ul>');
        $fact->setSolution('<ul><li>Составили необходимый список документов согласно требованиям консульства</li><li>Помогли подготовить документы, заменяющие согласие</li><li>Подготовили документы по цели поездки</li><li>Получили визы</li></ul>');

        $fact->setNumber1(2);
        $fact->setNumber2(7000);
        $fact->setNumber3(72000);
        $fact->setNumber4(1);
        $fact->setNumber5(1);

        $fact->setMeasure1('недели');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('раз');
        $fact->setMeasure5('год');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);

        $manager->persist($fact);







        $fact = new Fact();
        $fact->setClient('Паршиков Вадим');
        $fact->setSex('male');
        $fact->setProblem('<ul><li>Получить визу в Испанию на долгий срок</li><li>Приглашает владелец недвижимости</li></ul>');
        $fact->setSolution('<ul><li>Составили необходимый список документов согласно требованиям консульства</li><li>Правильно составил</li></ul><ul><li>Получили визы</li></ul>');

        $fact->setNumber1(2);
        $fact->setNumber2(7000);
        $fact->setNumber3(72000);
        $fact->setNumber4(1);
        $fact->setNumber5(1);

        $fact->setMeasure1('недели');
        $fact->setMeasure2('рублей');
        $fact->setMeasure3('рублей');
        $fact->setMeasure4('раз');
        $fact->setMeasure5('год');

        $fact->setOption1('ушло на получение визы');
        $fact->setOption2('сэкономлено клиенту');
        $fact->setOption3('— стоимость оформления');
        $fact->setOption4('клиент посетил офис');
        $fact->setOption5('— срок действия визы');

        $fact->setPosition(0);

        $manager->persist($fact);















        $manager->flush();

    }
}