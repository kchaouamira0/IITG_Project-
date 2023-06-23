<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615232332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription DROP FOREIGN KEY FK_B2AA45A9CB944F1A');
        $this->addSql('DROP INDEX IDX_B2AA45A9CB944F1A ON pre_inscription');
        $this->addSql('ALTER TABLE pre_inscription ADD id_student VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD birthdate DATE NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD etab VARCHAR(255) NOT NULL, ADD bac VARCHAR(255) NOT NULL, DROP student_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription ADD student_id INT DEFAULT NULL, DROP id_student, DROP first_name, DROP last_name, DROP birthdate, DROP email, DROP adress, DROP phone, DROP etab, DROP bac');
        $this->addSql('ALTER TABLE pre_inscription ADD CONSTRAINT FK_B2AA45A9CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_B2AA45A9CB944F1A ON pre_inscription (student_id)');
    }
}
