<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190718143405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonces ADD owner_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_CB988C6F7E3C61F9 ON annonces (owner_id)');
        $this->addSql('ALTER TABLE users ADD roles VARCHAR(255) NOT NULL, ADD role VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F7E3C61F9');
        $this->addSql('DROP INDEX IDX_CB988C6F7E3C61F9 ON annonces');
        $this->addSql('ALTER TABLE annonces DROP owner_id, CHANGE description description TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE users DROP roles, DROP role');
    }
}
