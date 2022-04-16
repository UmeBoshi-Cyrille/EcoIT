<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415143027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3D823E37A');
        $this->addSql('DROP INDEX IDX_F87474F3D823E37A ON lesson');
        $this->addSql('ALTER TABLE lesson CHANGE section_id formation_id INT NOT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_F87474F35200282E ON lesson (formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F35200282E');
        $this->addSql('DROP INDEX IDX_F87474F35200282E ON lesson');
        $this->addSql('ALTER TABLE lesson CHANGE formation_id section_id INT NOT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F87474F3D823E37A ON lesson (section_id)');
    }
}
