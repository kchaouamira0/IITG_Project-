<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617100634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE speciality ADD filiere_by_parcours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE speciality ADD CONSTRAINT FK_F3D7A08E39C77B2D FOREIGN KEY (filiere_by_parcours_id) REFERENCES filiere_by_parcours (id)');
        $this->addSql('CREATE INDEX IDX_F3D7A08E39C77B2D ON speciality (filiere_by_parcours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE speciality DROP FOREIGN KEY FK_F3D7A08E39C77B2D');
        $this->addSql('DROP INDEX IDX_F3D7A08E39C77B2D ON speciality');
        $this->addSql('ALTER TABLE speciality DROP filiere_by_parcours_id');
    }
}
