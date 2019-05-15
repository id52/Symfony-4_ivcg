<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180911101855 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geo_article (geo_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_B52C8364FA49D0B (geo_id), INDEX IDX_B52C83647294869C (article_id), PRIMARY KEY(geo_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info (id INT AUTO_INCREMENT NOT NULL, visa_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, fees VARCHAR(255) NOT NULL, term VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, INDEX IDX_CB89315799C772A6 (visa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sitemap (id INT AUTO_INCREMENT NOT NULL, geo_id INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, INDEX IDX_35179CDFA49D0B (geo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, photo_uri LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE robot (id INT AUTO_INCREMENT NOT NULL, geo_id INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, INDEX IDX_D82B7EE4FA49D0B (geo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialist (id INT AUTO_INCREMENT NOT NULL, geo_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, photo_uri LONGTEXT NOT NULL, video_uri LONGTEXT DEFAULT NULL, position INT NOT NULL, INDEX IDX_C2274AF4FA49D0B (geo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_member (id INT AUTO_INCREMENT NOT NULL, geo_id INT DEFAULT NULL, photo_uri LONGTEXT DEFAULT NULL, name VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, position INT NOT NULL, INDEX IDX_6FFBDA1FA49D0B (geo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimonial (id INT AUTO_INCREMENT NOT NULL, photo_uri LONGTEXT NOT NULL, uri LONGTEXT NOT NULL, client VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passport_photo (id INT AUTO_INCREMENT NOT NULL, uri LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visa (id INT AUTO_INCREMENT NOT NULL, region_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, accusative_title_with_preposition VARCHAR(255) NOT NULL, price INT NOT NULL, img LONGTEXT NOT NULL, intro_title VARCHAR(255) NOT NULL, info_main_title VARCHAR(255) NOT NULL, info_sub_title VARCHAR(255) NOT NULL, documents_title VARCHAR(255) NOT NULL, five_circles_main_title VARCHAR(255) NOT NULL, five_circles_sub_title VARCHAR(255) NOT NULL, ten_advantages_main_title VARCHAR(255) NOT NULL, ten_advantages_sub_title VARCHAR(255) NOT NULL, text_main_title VARCHAR(255) NOT NULL, consultation_form_2 VARCHAR(255) NOT NULL, text_sub_title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, document_list LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, meta_description LONGTEXT DEFAULT NULL, head_title LONGTEXT DEFAULT NULL, meta_description_subdomain LONGTEXT DEFAULT NULL, head_title_subdomain LONGTEXT DEFAULT NULL, INDEX IDX_16B1AB0898260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geo (id INT AUTO_INCREMENT NOT NULL, geo_id INT DEFAULT NULL, city VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, host VARCHAR(255) NOT NULL, video_uri LONGTEXT DEFAULT NULL, genitive_case LONGTEXT DEFAULT NULL, phone LONGTEXT DEFAULT NULL, email LONGTEXT DEFAULT NULL, is_visible TINYINT(1) NOT NULL, prepositional_case LONGTEXT DEFAULT NULL, jivosite_code LONGTEXT DEFAULT NULL, vk_link VARCHAR(255) DEFAULT NULL, fb_link VARCHAR(255) DEFAULT NULL, inst_link VARCHAR(255) DEFAULT NULL, head_title LONGTEXT DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, meta_description_subdomain LONGTEXT DEFAULT NULL, head_title_subdomain LONGTEXT DEFAULT NULL, vk_message VARCHAR(255) DEFAULT NULL, meta_description_organization LONGTEXT DEFAULT NULL, meta_description_subdomain_organization LONGTEXT DEFAULT NULL, head_title_subdomain_organization LONGTEXT DEFAULT NULL, head_title_organization LONGTEXT DEFAULT NULL, meta_description_agency LONGTEXT DEFAULT NULL, meta_description_subdomain_agency LONGTEXT DEFAULT NULL, head_title_subdomain_agency LONGTEXT DEFAULT NULL, head_title_agency LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_775EE79CF62F176 (region), INDEX IDX_775EE79CFA49D0B (geo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, intro_title VARCHAR(255) NOT NULL, flag_main_title VARCHAR(255) NOT NULL, flag_sub_title VARCHAR(255) NOT NULL, text_main_title VARCHAR(255) NOT NULL, text_sub_title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, consultation_form_direction_2 VARCHAR(255) NOT NULL, ten_advantages_main_title VARCHAR(255) NOT NULL, ten_advantages_sub_title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, meta_description LONGTEXT NOT NULL, head_title LONGTEXT NOT NULL, meta_description_subdomain LONGTEXT NOT NULL, head_title_subdomain LONGTEXT NOT NULL, five_steps_main_title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', first_name VARCHAR(255) NOT NULL, patronymic VARCHAR(255) DEFAULT NULL, second_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fact (id INT AUTO_INCREMENT NOT NULL, client VARCHAR(255) NOT NULL, photo_uri LONGTEXT DEFAULT NULL, sex VARCHAR(255) NOT NULL, vk_uri LONGTEXT DEFAULT NULL, problem LONGTEXT NOT NULL, solution LONGTEXT NOT NULL, position INT NOT NULL, number1 DOUBLE PRECISION NOT NULL, measure1 TINYTEXT NOT NULL, option1 TINYTEXT NOT NULL, number2 DOUBLE PRECISION NOT NULL, measure2 TINYTEXT NOT NULL, option2 TINYTEXT NOT NULL, number3 DOUBLE PRECISION NOT NULL, measure3 TINYTEXT NOT NULL, option3 TINYTEXT NOT NULL, number4 DOUBLE PRECISION NOT NULL, measure4 TINYTEXT NOT NULL, option4 TINYTEXT NOT NULL, number5 DOUBLE PRECISION NOT NULL, measure5 TINYTEXT NOT NULL, option5 TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE geo_article ADD CONSTRAINT FK_B52C8364FA49D0B FOREIGN KEY (geo_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE geo_article ADD CONSTRAINT FK_B52C83647294869C FOREIGN KEY (article_id) REFERENCES geo (id)');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB89315799C772A6 FOREIGN KEY (visa_id) REFERENCES visa (id)');
        $this->addSql('ALTER TABLE sitemap ADD CONSTRAINT FK_35179CDFA49D0B FOREIGN KEY (geo_id) REFERENCES geo (id)');
        $this->addSql('ALTER TABLE robot ADD CONSTRAINT FK_D82B7EE4FA49D0B FOREIGN KEY (geo_id) REFERENCES geo (id)');
        $this->addSql('ALTER TABLE specialist ADD CONSTRAINT FK_C2274AF4FA49D0B FOREIGN KEY (geo_id) REFERENCES geo (id)');
        $this->addSql('ALTER TABLE team_member ADD CONSTRAINT FK_6FFBDA1FA49D0B FOREIGN KEY (geo_id) REFERENCES geo (id)');
        $this->addSql('ALTER TABLE visa ADD CONSTRAINT FK_16B1AB0898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE geo ADD CONSTRAINT FK_775EE79CFA49D0B FOREIGN KEY (geo_id) REFERENCES geo (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE geo_article DROP FOREIGN KEY FK_B52C8364FA49D0B');
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB89315799C772A6');
        $this->addSql('ALTER TABLE geo_article DROP FOREIGN KEY FK_B52C83647294869C');
        $this->addSql('ALTER TABLE sitemap DROP FOREIGN KEY FK_35179CDFA49D0B');
        $this->addSql('ALTER TABLE robot DROP FOREIGN KEY FK_D82B7EE4FA49D0B');
        $this->addSql('ALTER TABLE specialist DROP FOREIGN KEY FK_C2274AF4FA49D0B');
        $this->addSql('ALTER TABLE team_member DROP FOREIGN KEY FK_6FFBDA1FA49D0B');
        $this->addSql('ALTER TABLE geo DROP FOREIGN KEY FK_775EE79CFA49D0B');
        $this->addSql('ALTER TABLE visa DROP FOREIGN KEY FK_16B1AB0898260155');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE geo_article');
        $this->addSql('DROP TABLE info');
        $this->addSql('DROP TABLE sitemap');
        $this->addSql('DROP TABLE map');
        $this->addSql('DROP TABLE robot');
        $this->addSql('DROP TABLE specialist');
        $this->addSql('DROP TABLE team_member');
        $this->addSql('DROP TABLE testimonial');
        $this->addSql('DROP TABLE passport_photo');
        $this->addSql('DROP TABLE visa');
        $this->addSql('DROP TABLE geo');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE fact');
    }
}
