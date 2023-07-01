<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624141821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE open_pre_inscription (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pre_inscription ADD open_pre_inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pre_inscription ADD CONSTRAINT FK_B2AA45A94174992D FOREIGN KEY (open_pre_inscription_id) REFERENCES open_pre_inscription (id)');
        $this->addSql('CREATE INDEX IDX_B2AA45A94174992D ON pre_inscription (open_pre_inscription_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription DROP FOREIGN KEY FK_B2AA45A94174992D');
        $this->addSql('DROP TABLE open_pre_inscription');
        $this->addSql('DROP INDEX IDX_B2AA45A94174992D ON pre_inscription');
        $this->addSql('ALTER TABLE pre_inscription DROP open_pre_inscription_id');
    }
}
