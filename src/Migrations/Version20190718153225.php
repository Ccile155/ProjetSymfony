<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190718153225 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F7E3C61F9');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, is_active TINYINT(1) NOT NULL, role VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F7E3C61F9');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F7E3C61F9');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, passwrd VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, avatar VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, roles VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F7E3C61F9');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id)');
    }
}
