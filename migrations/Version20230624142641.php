<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624142641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE academic_year (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE open_pre_inscription ADD academic_year_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE open_pre_inscription ADD CONSTRAINT FK_36BA55B8C54F3401 FOREIGN KEY (academic_year_id) REFERENCES academic_year (id)');
        $this->addSql('CREATE INDEX IDX_36BA55B8C54F3401 ON open_pre_inscription (academic_year_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE open_pre_inscription DROP FOREIGN KEY FK_36BA55B8C54F3401');
        $this->addSql('DROP TABLE academic_year');
        $this->addSql('DROP INDEX IDX_36BA55B8C54F3401 ON open_pre_inscription');
        $this->addSql('ALTER TABLE open_pre_inscription DROP academic_year_id');
    }
}
