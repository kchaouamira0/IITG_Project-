<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230616211931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filiere_parcours DROP FOREIGN KEY FK_ED60833B180AA129');
        $this->addSql('ALTER TABLE filiere_parcours DROP FOREIGN KEY FK_ED60833B6E38C0DB');
        $this->addSql('DROP TABLE filiere_parcours');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filiere_parcours (filiere_id INT NOT NULL, parcours_id INT NOT NULL, INDEX IDX_ED60833B180AA129 (filiere_id), INDEX IDX_ED60833B6E38C0DB (parcours_id), PRIMARY KEY(filiere_id, parcours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE filiere_parcours ADD CONSTRAINT FK_ED60833B180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere_parcours ADD CONSTRAINT FK_ED60833B6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id) ON DELETE CASCADE');
    }
}
