<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230710234410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE academic_year (id INT AUTO_INCREMENT NOT NULL, value INT NOT NULL, current TINYINT(1) DEFAULT 0, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) DEFAULT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, sign VARCHAR(255) NOT NULL, image_profile VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction_email (direction_id INT NOT NULL, email_id INT NOT NULL, INDEX IDX_9F3DD719AF73D997 (direction_id), INDEX IDX_9F3DD719A832C1C9 (email_id), PRIMARY KEY(direction_id, email_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction_phone (direction_id INT NOT NULL, phone_id INT NOT NULL, INDEX IDX_3CE03CB0AF73D997 (direction_id), INDEX IDX_3CE03CB03B7323CB (phone_id), PRIMARY KEY(direction_id, phone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, domaine_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_2ED05D9E4272FC9F (domaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere_by_parcours (id INT AUTO_INCREMENT NOT NULL, parcours_id INT DEFAULT NULL, filiere_id INT DEFAULT NULL, INDEX IDX_45401ACD6E38C0DB (parcours_id), INDEX IDX_45401ACD180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institut (id INT NOT NULL, adress VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institut_phone (institut_id INT NOT NULL, phone_id INT NOT NULL, INDEX IDX_1995A178ACF64F5F (institut_id), INDEX IDX_1995A1783B7323CB (phone_id), PRIMARY KEY(institut_id, phone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institut_email (institut_id INT NOT NULL, email_id INT NOT NULL, INDEX IDX_BA484AD1ACF64F5F (institut_id), INDEX IDX_BA484AD1A832C1C9 (email_id), PRIMARY KEY(institut_id, email_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE open_pre_inscription (id INT AUTO_INCREMENT NOT NULL, academic_year_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, description LONGTEXT NOT NULL, current TINYINT(1) DEFAULT 0, INDEX IDX_36BA55B8C54F3401 (academic_year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, abrv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_444F97DD96901F54 (number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, type_post_id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_poster VARCHAR(255) NOT NULL, title_fr VARCHAR(255) NOT NULL, description_fr VARCHAR(255) DEFAULT NULL, content_fr LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_5A8A6C8D989D9B62 (slug), INDEX IDX_5A8A6C8D63A86CD9 (type_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pre_inscription (id INT AUTO_INCREMENT NOT NULL, speciality_id INT DEFAULT NULL, open_pre_inscription_id INT DEFAULT NULL, annee_univ INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, place_of_birth VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, etab VARCHAR(255) NOT NULL, bac VARCHAR(255) NOT NULL, is_accepted TINYINT(1) DEFAULT 0 NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B2AA45A93B5A08D7 (speciality_id), INDEX IDX_B2AA45A94174992D (open_pre_inscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speciality (id INT AUTO_INCREMENT NOT NULL, filiere_by_parcours_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_F3D7A08E39C77B2D (filiere_by_parcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, id_student VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, email VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, etab VARCHAR(255) NOT NULL, bac VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, place_birth VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_post (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE direction_email ADD CONSTRAINT FK_9F3DD719AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE direction_email ADD CONSTRAINT FK_9F3DD719A832C1C9 FOREIGN KEY (email_id) REFERENCES email (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE direction_phone ADD CONSTRAINT FK_3CE03CB0AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE direction_phone ADD CONSTRAINT FK_3CE03CB03B7323CB FOREIGN KEY (phone_id) REFERENCES phone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere ADD CONSTRAINT FK_2ED05D9E4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE filiere_by_parcours ADD CONSTRAINT FK_45401ACD6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE filiere_by_parcours ADD CONSTRAINT FK_45401ACD180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE institut_phone ADD CONSTRAINT FK_1995A178ACF64F5F FOREIGN KEY (institut_id) REFERENCES institut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE institut_phone ADD CONSTRAINT FK_1995A1783B7323CB FOREIGN KEY (phone_id) REFERENCES phone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE institut_email ADD CONSTRAINT FK_BA484AD1ACF64F5F FOREIGN KEY (institut_id) REFERENCES institut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE institut_email ADD CONSTRAINT FK_BA484AD1A832C1C9 FOREIGN KEY (email_id) REFERENCES email (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE open_pre_inscription ADD CONSTRAINT FK_36BA55B8C54F3401 FOREIGN KEY (academic_year_id) REFERENCES academic_year (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D63A86CD9 FOREIGN KEY (type_post_id) REFERENCES type_post (id)');
        $this->addSql('ALTER TABLE pre_inscription ADD CONSTRAINT FK_B2AA45A93B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE pre_inscription ADD CONSTRAINT FK_B2AA45A94174992D FOREIGN KEY (open_pre_inscription_id) REFERENCES open_pre_inscription (id)');
        $this->addSql('ALTER TABLE speciality ADD CONSTRAINT FK_F3D7A08E39C77B2D FOREIGN KEY (filiere_by_parcours_id) REFERENCES filiere_by_parcours (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direction_email DROP FOREIGN KEY FK_9F3DD719AF73D997');
        $this->addSql('ALTER TABLE direction_email DROP FOREIGN KEY FK_9F3DD719A832C1C9');
        $this->addSql('ALTER TABLE direction_phone DROP FOREIGN KEY FK_3CE03CB0AF73D997');
        $this->addSql('ALTER TABLE direction_phone DROP FOREIGN KEY FK_3CE03CB03B7323CB');
        $this->addSql('ALTER TABLE filiere DROP FOREIGN KEY FK_2ED05D9E4272FC9F');
        $this->addSql('ALTER TABLE filiere_by_parcours DROP FOREIGN KEY FK_45401ACD6E38C0DB');
        $this->addSql('ALTER TABLE filiere_by_parcours DROP FOREIGN KEY FK_45401ACD180AA129');
        $this->addSql('ALTER TABLE institut_phone DROP FOREIGN KEY FK_1995A178ACF64F5F');
        $this->addSql('ALTER TABLE institut_phone DROP FOREIGN KEY FK_1995A1783B7323CB');
        $this->addSql('ALTER TABLE institut_email DROP FOREIGN KEY FK_BA484AD1ACF64F5F');
        $this->addSql('ALTER TABLE institut_email DROP FOREIGN KEY FK_BA484AD1A832C1C9');
        $this->addSql('ALTER TABLE open_pre_inscription DROP FOREIGN KEY FK_36BA55B8C54F3401');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D63A86CD9');
        $this->addSql('ALTER TABLE pre_inscription DROP FOREIGN KEY FK_B2AA45A93B5A08D7');
        $this->addSql('ALTER TABLE pre_inscription DROP FOREIGN KEY FK_B2AA45A94174992D');
        $this->addSql('ALTER TABLE speciality DROP FOREIGN KEY FK_F3D7A08E39C77B2D');
        $this->addSql('DROP TABLE academic_year');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE direction_email');
        $this->addSql('DROP TABLE direction_phone');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE filiere_by_parcours');
        $this->addSql('DROP TABLE institut');
        $this->addSql('DROP TABLE institut_phone');
        $this->addSql('DROP TABLE institut_email');
        $this->addSql('DROP TABLE open_pre_inscription');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE pre_inscription');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE type_post');
        $this->addSql('DROP TABLE user');
    }
}
