<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230616213150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filiere_by_parcours (id INT AUTO_INCREMENT NOT NULL, parcours_id INT DEFAULT NULL, filiere_id INT DEFAULT NULL, INDEX IDX_45401ACD6E38C0DB (parcours_id), INDEX IDX_45401ACD180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filiere_by_parcours ADD CONSTRAINT FK_45401ACD6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE filiere_by_parcours ADD CONSTRAINT FK_45401ACD180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filiere_by_parcours DROP FOREIGN KEY FK_45401ACD6E38C0DB');
        $this->addSql('ALTER TABLE filiere_by_parcours DROP FOREIGN KEY FK_45401ACD180AA129');
        $this->addSql('DROP TABLE filiere_by_parcours');
    }
}
