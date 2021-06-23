<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611131218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_data DROP FOREIGN KEY FK_D772BFAA9D86650F');
        $this->addSql('DROP INDEX UNIQ_D772BFAA9D86650F ON user_data');
        $this->addSql('ALTER TABLE user_data DROP user_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_data ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_data ADD CONSTRAINT FK_D772BFAA9D86650F FOREIGN KEY (user_id_id) REFERENCES app_users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D772BFAA9D86650F ON user_data (user_id_id)');
    }
}
