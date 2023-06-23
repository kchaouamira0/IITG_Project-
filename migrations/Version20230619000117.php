<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619000117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription ADD speciality_id INT DEFAULT NULL, DROP sector, CHANGE is_accepted is_accepted TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE pre_inscription ADD CONSTRAINT FK_B2AA45A93B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('CREATE INDEX IDX_B2AA45A93B5A08D7 ON pre_inscription (speciality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription DROP FOREIGN KEY FK_B2AA45A93B5A08D7');
        $this->addSql('DROP INDEX IDX_B2AA45A93B5A08D7 ON pre_inscription');
        $this->addSql('ALTER TABLE pre_inscription ADD sector VARCHAR(255) NOT NULL, DROP speciality_id, CHANGE is_accepted is_accepted TINYINT(1) NOT NULL');
    }
}
