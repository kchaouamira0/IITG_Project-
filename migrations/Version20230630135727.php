<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230630135727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE direction_email (direction_id INT NOT NULL, email_id INT NOT NULL, INDEX IDX_9F3DD719AF73D997 (direction_id), INDEX IDX_9F3DD719A832C1C9 (email_id), PRIMARY KEY(direction_id, email_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction_phone (direction_id INT NOT NULL, phone_id INT NOT NULL, INDEX IDX_3CE03CB0AF73D997 (direction_id), INDEX IDX_3CE03CB03B7323CB (phone_id), PRIMARY KEY(direction_id, phone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE direction_email ADD CONSTRAINT FK_9F3DD719AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE direction_email ADD CONSTRAINT FK_9F3DD719A832C1C9 FOREIGN KEY (email_id) REFERENCES email (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE direction_phone ADD CONSTRAINT FK_3CE03CB0AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE direction_phone ADD CONSTRAINT FK_3CE03CB03B7323CB FOREIGN KEY (phone_id) REFERENCES phone (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direction_email DROP FOREIGN KEY FK_9F3DD719AF73D997');
        $this->addSql('ALTER TABLE direction_email DROP FOREIGN KEY FK_9F3DD719A832C1C9');
        $this->addSql('ALTER TABLE direction_phone DROP FOREIGN KEY FK_3CE03CB0AF73D997');
        $this->addSql('ALTER TABLE direction_phone DROP FOREIGN KEY FK_3CE03CB03B7323CB');
        $this->addSql('DROP TABLE direction_email');
        $this->addSql('DROP TABLE direction_phone');
    }
}
