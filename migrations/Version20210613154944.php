<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210613154944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F9FCD471');
        $this->addSql('DROP INDEX IDX_C53D045F9FCD471 ON image');
        $this->addSql('ALTER TABLE image DROP album_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD album_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F9FCD471 FOREIGN KEY (album_id_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F9FCD471 ON image (album_id_id)');
    }
}
