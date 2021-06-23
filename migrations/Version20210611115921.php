<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611115921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43A76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
        $this->addSql('CREATE INDEX IDX_39986E43A76ED395 ON album (user_id)');
        $this->addSql('ALTER TABLE app_users ADD profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C2502824CCFA12B8 FOREIGN KEY (profile_id) REFERENCES user_data (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824CCFA12B8 ON app_users (profile_id)');
        $this->addSql('ALTER TABLE image ADD album_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F1137ABCF ON image (album_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43A76ED395');
        $this->addSql('DROP INDEX IDX_39986E43A76ED395 ON album');
        $this->addSql('ALTER TABLE album DROP user_id');
        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C2502824CCFA12B8');
        $this->addSql('DROP INDEX UNIQ_C2502824CCFA12B8 ON app_users');
        $this->addSql('ALTER TABLE app_users DROP profile_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F1137ABCF');
        $this->addSql('DROP INDEX IDX_C53D045F1137ABCF ON image');
        $this->addSql('ALTER TABLE image DROP album_id');
    }
}
