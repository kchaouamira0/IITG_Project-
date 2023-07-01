<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624152256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE institut (id INT AUTO_INCREMENT NOT NULL, adress VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institut_phone (institut_id INT NOT NULL, phone_id INT NOT NULL, INDEX IDX_1995A178ACF64F5F (institut_id), INDEX IDX_1995A1783B7323CB (phone_id), PRIMARY KEY(institut_id, phone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE institut_phone ADD CONSTRAINT FK_1995A178ACF64F5F FOREIGN KEY (institut_id) REFERENCES institut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE institut_phone ADD CONSTRAINT FK_1995A1783B7323CB FOREIGN KEY (phone_id) REFERENCES phone (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE institut_phone DROP FOREIGN KEY FK_1995A178ACF64F5F');
        $this->addSql('ALTER TABLE institut_phone DROP FOREIGN KEY FK_1995A1783B7323CB');
        $this->addSql('DROP TABLE institut');
        $this->addSql('DROP TABLE institut_phone');
    }
}
