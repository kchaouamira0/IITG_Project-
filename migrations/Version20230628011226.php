<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628011226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institut_email (institut_id INT NOT NULL, email_id INT NOT NULL, INDEX IDX_BA484AD1ACF64F5F (institut_id), INDEX IDX_BA484AD1A832C1C9 (email_id), PRIMARY KEY(institut_id, email_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE institut_email ADD CONSTRAINT FK_BA484AD1ACF64F5F FOREIGN KEY (institut_id) REFERENCES institut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE institut_email ADD CONSTRAINT FK_BA484AD1A832C1C9 FOREIGN KEY (email_id) REFERENCES email (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE institut_email DROP FOREIGN KEY FK_BA484AD1ACF64F5F');
        $this->addSql('ALTER TABLE institut_email DROP FOREIGN KEY FK_BA484AD1A832C1C9');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE institut_email');
    }
}
