<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180914045005 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE info CHANGE visa_id visa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sitemap CHANGE geo_id geo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE map CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE robot CHANGE geo_id geo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specialist CHANGE geo_id geo_id INT DEFAULT NULL, CHANGE position position INT NOT NULL');
        $this->addSql('ALTER TABLE team_member CHANGE geo_id geo_id INT DEFAULT NULL, CHANGE position position INT NOT NULL');
        $this->addSql('ALTER TABLE testimonial CHANGE position position INT NOT NULL');
        $this->addSql('ALTER TABLE visa CHANGE region_id region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE geo ADD contact_address LONGTEXT DEFAULT NULL, CHANGE geo_id geo_id INT DEFAULT NULL, CHANGE vk_link vk_link VARCHAR(255) DEFAULT NULL, CHANGE fb_link fb_link VARCHAR(255) DEFAULT NULL, CHANGE inst_link inst_link VARCHAR(255) DEFAULT NULL, CHANGE vk_message vk_message VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE patronymic patronymic VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fact CHANGE position position INT NOT NULL, CHANGE number1 number1 DOUBLE PRECISION NOT NULL, CHANGE number2 number2 DOUBLE PRECISION NOT NULL, CHANGE number3 number3 DOUBLE PRECISION NOT NULL, CHANGE number4 number4 DOUBLE PRECISION NOT NULL, CHANGE number5 number5 DOUBLE PRECISION NOT NULL');
        $this->addSql('UPDATE `geo` SET `contact_address` = "630089, г. Новосибирск<br> ул.&nbsp;Б.&nbsp;Богаткова&nbsp;210/1<br>офис&nbsp;708, БЦ&nbsp;«Golden Field»" WHERE `geo`.`city` = "Новосибирск";');
        $this->addSql('UPDATE `geo` SET `contact_address` = "634050, г. Томск<br> Батенькова&nbsp;площадь,&nbsp;2<br> офис&nbsp;4а, 3&nbsp;этаж" WHERE `geo`.`city` = "Томск";');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fact CHANGE position position INT NOT NULL, CHANGE number1 number1 DOUBLE PRECISION NOT NULL, CHANGE number2 number2 DOUBLE PRECISION NOT NULL, CHANGE number3 number3 DOUBLE PRECISION NOT NULL, CHANGE number4 number4 DOUBLE PRECISION NOT NULL, CHANGE number5 number5 DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE geo DROP contact_address');
        $this->addSql('ALTER TABLE info CHANGE visa_id visa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE map CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE robot CHANGE geo_id geo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sitemap CHANGE geo_id geo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specialist CHANGE geo_id geo_id INT DEFAULT NULL, CHANGE position position INT NOT NULL');
        $this->addSql('ALTER TABLE team_member CHANGE geo_id geo_id INT DEFAULT NULL, CHANGE position position INT NOT NULL');
        $this->addSql('ALTER TABLE testimonial CHANGE position position INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE patronymic patronymic VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE visa CHANGE region_id region_id INT DEFAULT NULL');
    }
}
