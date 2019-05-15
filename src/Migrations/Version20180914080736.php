<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180914080736 extends AbstractMigration
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
        $this->addSql('ALTER TABLE geo ADD contact_2gis_uri LONGTEXT DEFAULT NULL, CHANGE geo_id geo_id INT DEFAULT NULL, CHANGE vk_link vk_link VARCHAR(255) DEFAULT NULL, CHANGE fb_link fb_link VARCHAR(255) DEFAULT NULL, CHANGE inst_link inst_link VARCHAR(255) DEFAULT NULL, CHANGE vk_message vk_message VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE patronymic patronymic VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fact CHANGE position position INT NOT NULL, CHANGE number1 number1 DOUBLE PRECISION NOT NULL, CHANGE number2 number2 DOUBLE PRECISION NOT NULL, CHANGE number3 number3 DOUBLE PRECISION NOT NULL, CHANGE number4 number4 DOUBLE PRECISION NOT NULL, CHANGE number5 number5 DOUBLE PRECISION NOT NULL');
        $this->addSql('UPDATE `geo` SET `contact_2gis_uri` = "https://2gis.ru/novosibirsk/firm/141265770389393%2C82.977365%2C55.036538/rsType/bus/to/82.977632%2C55.03659%7C%D0%9C%D0%B5%D0%B6%D0%B4%D1%83%D0%BD%D0%B0%D1%80%D0%BE%D0%B4%D0%BD%D1%8B%D0%B9%20%D0%92%D0%B8%D0%B7%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%A6%D0%B5%D0%BD%D1%82%D1%80%2C%20%D0%B2%D0%B8%D0%B7%D0%BE%D0%B2%D0%BE%D0%B5%20%D0%B0%D0%B3%D0%B5%D0%BD%D1%82%D1%81%D1%82%D0%B2%D0%BE%7C141266769656704%7Cfirm?queryState=center%2F82.977773%2C55.036634%2Fzoom%2F17%2FrouteTab" WHERE `geo`.`city` = "Новосибирск";');
        $this->addSql('UPDATE `geo` SET `contact_2gis_uri` = "https://2gis.ru/tomsk/query/%D0%BC%D0%B5%D0%B6%D0%B4%D1%83%D0%BD%D0%B0%D1%80%D0%BE%D0%B4%D0%BD%D1%8B%D0%B9%20%D0%B2%D0%B8%D0%B7%D0%BE%D0%B2%D1%8B%D0%B9%20%D1%86%D0%B5%D0%BD%D1%82%D1%80/firm/70000001031661924/to/84.951303%2C56.484708%7C%D0%9C%D0%B5%D0%B6%D0%B4%D1%83%D0%BD%D0%B0%D1%80%D0%BE%D0%B4%D0%BD%D1%8B%D0%B9%20%D0%92%D0%B8%D0%B7%D0%BE%D0%B2%D1%8B%D0%B9%20%D0%A6%D0%B5%D0%BD%D1%82%D1%80%2C%20%D0%B2%D0%B8%D0%B7%D0%BE%D0%B2%D0%BE%D0%B5%20%D0%B0%D0%B3%D0%B5%D0%BD%D1%82%D1%81%D1%82%D0%B2%D0%BE%7C70000001031661924%7Cfirm?queryState=center%2F84.951303%2C56.484708%2Fzoom%2F16%2FrouteTab" WHERE `geo`.`city` = "Томск";');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fact CHANGE position position INT NOT NULL, CHANGE number1 number1 DOUBLE PRECISION NOT NULL, CHANGE number2 number2 DOUBLE PRECISION NOT NULL, CHANGE number3 number3 DOUBLE PRECISION NOT NULL, CHANGE number4 number4 DOUBLE PRECISION NOT NULL, CHANGE number5 number5 DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE geo DROP contact_2gis_uri, CHANGE geo_id geo_id INT DEFAULT NULL, CHANGE vk_link vk_link VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE fb_link fb_link VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE inst_link inst_link VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE vk_message vk_message VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
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
