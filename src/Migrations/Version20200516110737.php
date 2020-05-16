<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516110737 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2D5B0234F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code SMALLINT NOT NULL, flag VARCHAR(255) NOT NULL, capital VARCHAR(255) NOT NULL, language VARCHAR(255) NOT NULL, INDEX name_index (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education_center (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, INDEX status_index (status), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, sex_id INT NOT NULL, relationship_status_id INT DEFAULT NULL, education_status_id INT DEFAULT NULL, city_id INT NOT NULL, education_center_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, age INT NOT NULL, image VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, about LONGTEXT DEFAULT NULL, birth_date DATETIME NOT NULL, INDEX IDX_8157AA0F5A2DB2A0 (sex_id), INDEX IDX_8157AA0F47BACE1C (relationship_status_id), INDEX IDX_8157AA0FFF1B2F47 (education_status_id), INDEX IDX_8157AA0F8BAC62AF (city_id), INDEX IDX_8157AA0FCDDEDC8D (education_center_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relationship_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, INDEX relationship_index (status), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sex (id INT AUTO_INCREMENT NOT NULL, sex VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_B723AF33E7927C74 (email), UNIQUE INDEX UNIQ_B723AF33CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F5A2DB2A0 FOREIGN KEY (sex_id) REFERENCES sex (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F47BACE1C FOREIGN KEY (relationship_status_id) REFERENCES relationship_status (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FFF1B2F47 FOREIGN KEY (education_status_id) REFERENCES education_status (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FCDDEDC8D FOREIGN KEY (education_center_id) REFERENCES education_center (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F8BAC62AF');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234F92F3E70');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FCDDEDC8D');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FFF1B2F47');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33CCFA12B8');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F47BACE1C');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F5A2DB2A0');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE education_center');
        $this->addSql('DROP TABLE education_status');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE relationship_status');
        $this->addSql('DROP TABLE sex');
        $this->addSql('DROP TABLE student');
    }
}
