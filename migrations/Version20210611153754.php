<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611153754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_users ADD profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C2502824CCFA12B8 FOREIGN KEY (profile_id) REFERENCES user_data (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824CCFA12B8 ON app_users (profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C2502824CCFA12B8');
        $this->addSql('DROP INDEX UNIQ_C2502824CCFA12B8 ON app_users');
        $this->addSql('ALTER TABLE app_users DROP profile_id');
    }
}
