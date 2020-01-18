<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200118173837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__conseiller AS SELECT id, first_name, name, age, job, bio, rank FROM conseiller');
        $this->addSql('DROP TABLE conseiller');
        $this->addSql('CREATE TABLE conseiller (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, age SMALLINT DEFAULT NULL, job VARCHAR(255) DEFAULT NULL COLLATE BINARY, bio CLOB DEFAULT NULL COLLATE BINARY, rank SMALLINT NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO conseiller (id, slug, name, age, job, bio, rank) SELECT id, first_name, name, age, job, bio, rank FROM __temp__conseiller');
        $this->addSql('DROP TABLE __temp__conseiller');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__conseiller AS SELECT id, name, slug, age, job, bio, rank FROM conseiller');
        $this->addSql('DROP TABLE conseiller');
        $this->addSql('CREATE TABLE conseiller (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, age SMALLINT DEFAULT NULL, job VARCHAR(255) DEFAULT NULL, bio CLOB DEFAULT NULL, rank SMALLINT NOT NULL, first_name VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO conseiller (id, name, first_name, age, job, bio, rank) SELECT id, name, slug, age, job, bio, rank FROM __temp__conseiller');
        $this->addSql('DROP TABLE __temp__conseiller');
    }
}
