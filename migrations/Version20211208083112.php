<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211208083112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(1) NOT NULL, nom VARCHAR(100) NOT NULL, mail VARCHAR(100) NOT NULL, tel VARCHAR(15) NOT NULL, date_premier_contact DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B95CAA23C7 FOREIGN KEY (idLieu) REFERENCES lieu (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B95CAA23C7 ON employe (idLieu)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B95CAA23C7');
        $this->addSql('DROP INDEX IDX_F804D3B95CAA23C7 ON employe');
    }
}
