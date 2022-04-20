<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420093745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL, is_published TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, instructor_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, sentence VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, published_at DATETIME NOT NULL, is_published TINYINT(1) DEFAULT NULL, INDEX IDX_404021BF12469DE2 (category_id), INDEX IDX_404021BF8C4FC193 (instructor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lessons (id INT AUTO_INCREMENT NOT NULL, section_id INT NOT NULL, title VARCHAR(255) NOT NULL, video VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, published_at DATETIME DEFAULT NULL, is_published TINYINT(1) DEFAULT NULL, INDEX IDX_3F4218D9D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_published TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2D737AEF5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) DEFAULT NULL, surname VARCHAR(50) DEFAULT NULL, pseudo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, employe_id INT DEFAULT NULL, rgpdconsent TINYINT(1) DEFAULT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF8C4FC193 FOREIGN KEY (instructor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D9D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF12469DE2');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF5200282E');
        $this->addSql('ALTER TABLE lessons DROP FOREIGN KEY FK_3F4218D9D823E37A');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF8C4FC193');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE lessons');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE user');
    }
}
