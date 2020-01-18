<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200118170743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__page AS SELECT id, name, title, template, description, url, generator, parent_id, created_at, updated_at FROM page');
        $this->addSql('DROP TABLE page');
        $this->addSql('CREATE TABLE page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, title CLOB DEFAULT NULL COLLATE BINARY, template CLOB DEFAULT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, generator CLOB DEFAULT NULL COLLATE BINARY, parent_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO page (id, name, title, template, description, path, generator, parent_id, created_at, updated_at) SELECT id, name, title, template, description, url, generator, parent_id, created_at, updated_at FROM __temp__page');
        $this->addSql('DROP TABLE __temp__page');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__page AS SELECT id, name, title, template, description, created_at, updated_at, path, generator, parent_id FROM page');
        $this->addSql('DROP TABLE page');
        $this->addSql('CREATE TABLE page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, title CLOB DEFAULT NULL, template CLOB DEFAULT NULL, description CLOB DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, generator CLOB DEFAULT NULL, parent_id INTEGER DEFAULT NULL, url VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO page (id, name, title, template, description, created_at, updated_at, url, generator, parent_id) SELECT id, name, title, template, description, created_at, updated_at, path, generator, parent_id FROM __temp__page');
        $this->addSql('DROP TABLE __temp__page');
    }
}
