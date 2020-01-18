<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200118182046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE program_category ADD COLUMN image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE program_category ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE program_category ADD COLUMN updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__program_category AS SELECT id, title, description, rank FROM program_category');
        $this->addSql('DROP TABLE program_category');
        $this->addSql('CREATE TABLE program_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, rank SMALLINT NOT NULL)');
        $this->addSql('INSERT INTO program_category (id, title, description, rank) SELECT id, title, description, rank FROM __temp__program_category');
        $this->addSql('DROP TABLE __temp__program_category');
    }
}
