<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629102839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone ADD direction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDAF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('CREATE INDEX IDX_444F97DDAF73D997 ON phone (direction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DDAF73D997');
        $this->addSql('DROP INDEX IDX_444F97DDAF73D997 ON phone');
        $this->addSql('ALTER TABLE phone DROP direction_id');
    }
}
