<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200118143539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE punch_line (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text CLOB NOT NULL)');
        $this->addSql('CREATE TABLE punch_line_program_category (punch_line_id INTEGER NOT NULL, program_category_id INTEGER NOT NULL, PRIMARY KEY(punch_line_id, program_category_id))');
        $this->addSql('CREATE TABLE site_setting (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, domain VARCHAR(255) NOT NULL, protocol VARCHAR(16) NOT NULL, facebook_page CLOB DEFAULT NULL, twitter_page CLOB DEFAULT NULL, youtube_page CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE program_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, rank SMALLINT NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE punch_line');
        $this->addSql('DROP TABLE punch_line_program_category');
        $this->addSql('DROP TABLE site_setting');
        $this->addSql('DROP TABLE program_category');
    }
}
