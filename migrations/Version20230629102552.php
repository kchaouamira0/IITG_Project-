<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629102552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direction_phone DROP FOREIGN KEY FK_3CE03CB03B7323CB');
        $this->addSql('ALTER TABLE direction_phone DROP FOREIGN KEY FK_3CE03CB0AF73D997');
        $this->addSql('DROP TABLE direction_phone');
        $this->addSql('ALTER TABLE direction DROP current');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE direction_phone (direction_id INT NOT NULL, phone_id INT NOT NULL, INDEX IDX_3CE03CB03B7323CB (phone_id), INDEX IDX_3CE03CB0AF73D997 (direction_id), PRIMARY KEY(direction_id, phone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE direction_phone ADD CONSTRAINT FK_3CE03CB03B7323CB FOREIGN KEY (phone_id) REFERENCES phone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE direction_phone ADD CONSTRAINT FK_3CE03CB0AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE direction ADD current TINYINT(1) DEFAULT 0');
    }
}
