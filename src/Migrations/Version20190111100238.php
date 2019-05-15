<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190111100238 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE quiz_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_answer (id INT AUTO_INCREMENT NOT NULL, position INT NOT NULL DEFAULT 0, quiz_question_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_3799BA7C3101E51F (quiz_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_question (id INT AUTO_INCREMENT NOT NULL, position INT NOT NULL DEFAULT 0, quiz_type_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, email_title VARCHAR(255) NOT NULL,  placeholder VARCHAR(255) DEFAULT NULL, INDEX IDX_6033B00BD7162133 (quiz_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quiz_answer ADD CONSTRAINT FK_3799BA7C3101E51F FOREIGN KEY (quiz_question_id) REFERENCES quiz_question (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE quiz_question ADD CONSTRAINT FK_6033B00BD7162133 FOREIGN KEY (quiz_type_id) REFERENCES quiz_type (id) ON DELETE SET NULL');

        $this->addSql('INSERT INTO `quiz_type` (`id`, `title`) VALUES(1, \'textarea\')');
        $this->addSql('INSERT INTO `quiz_type` (`id`, `title`) VALUES(2, \'radio\')');
        $this->addSql('INSERT INTO `quiz_type` (`id`, `title`) VALUES(3, \'checkbox\')');
        $this->addSql('INSERT INTO `quiz_type` (`id`, `title`) VALUES(4, \'text\')');
        $this->addSql('INSERT INTO `quiz_type` (`id`, `title`) VALUES(5, \'phone\')');

        $this->addSql('INSERT INTO `quiz_question` (`id`, `quiz_type_id`, `title`, `email_title`, `placeholder`) VALUES(1, 4, \'Напишите страну,<br> в которую хотите поехать?\', \'Страна\', \'Страна\')');
        $this->addSql('INSERT INTO `quiz_question` (`id`, `quiz_type_id`, `title`, `email_title`, `placeholder`) VALUES(2, 2, \'Цель поездки?\', \'Цель поездки\', \'Цель поездки\')');
        $this->addSql('INSERT INTO `quiz_question` (`id`, `quiz_type_id`, `title`, `email_title`, `placeholder`) VALUES(3, 3, \'Кто едет?<br> (Можно выбрать несколько вариантов)\', \'Кто едет\', \'Кто едет\')');
        $this->addSql('INSERT INTO `quiz_question` (`id`, `quiz_type_id`, `title`, `email_title`, `placeholder`) VALUES(4, 4, \'Какое у вас гражданство?\', \'Гражданство\', \'Гражданство\')');
        $this->addSql('INSERT INTO `quiz_question` (`id`, `quiz_type_id`, `title`, `email_title`, `placeholder`) VALUES(5, 2, \'Ваш трудовой статус?\', \'Трудовой статус\', \'Трудовой статус\')');
        $this->addSql('INSERT INTO `quiz_question` (`id`, `quiz_type_id`, `title`, `email_title`, `placeholder`) VALUES(6, 2, \'Дата поездки?\', \'Дата поездки\', \'Дата поездки\')');
        $this->addSql('INSERT INTO `quiz_question` (`id`, `quiz_type_id`, `title`, `email_title`, `placeholder`) VALUES(7, 4, \'Как Вас зовут?\', \'Имя\', \'Имя\')');
        $this->addSql('INSERT INTO `quiz_question` (`id`, `quiz_type_id`, `title`, `email_title`, `placeholder`) VALUES(8, 5, \'Оставьте номер телефона, чтобы мы могли сообщить Вам стоимость визы, а также проконсультировать о возможности бесплатного оформления.\', \'Телефон\', \'Телефон\')');

        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(1, 2, \'Командировка\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(2, 2, \'Семейный отдых\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(3, 2, \'К друзьям, к членам семьи\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(4, 2, \'Работа за рубежом\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(5, 2, \'Отпуск\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(6, 3, \'Один\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(7, 3, \'Семья\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(8, 3, \'Друзья\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(9, 3, \'Присутствуют дети\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(10, 5, \'Работаю (официально)\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(11, 5, \'Работаю (не официально)\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(12, 5, \'Учусь\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(13, 5, \'Юридическое лицо (ИП, ООО)\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(14, 5, \'Безработный\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(15, 6, \'В ближайшие дни\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(16, 6, \'На этой неделе\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(17, 6, \'В этом месяце\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(18, 6, \'В ближайшие 2-3 месяца\')');
        $this->addSql('INSERT INTO `quiz_answer` (`id`, `quiz_question_id`, `title`) VALUES(19, 6, \'В этом году\')');


    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quiz_question DROP FOREIGN KEY FK_6033B00BD7162133');
        $this->addSql('ALTER TABLE quiz_answer DROP FOREIGN KEY FK_3799BA7C3101E51F');
        $this->addSql('DROP TABLE quiz_type');
        $this->addSql('DROP TABLE quiz_answer');
        $this->addSql('DROP TABLE quiz_question');
    }
}
