<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629095623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE email ADD direction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('CREATE INDEX IDX_E7927C74AF73D997 ON email (direction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74AF73D997');
        $this->addSql('DROP INDEX IDX_E7927C74AF73D997 ON email');
        $this->addSql('ALTER TABLE email DROP direction_id');
    }
}
