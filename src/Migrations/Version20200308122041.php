<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308122041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX users_id ON tasks');
        $this->addSql('ALTER TABLE tasks ADD tasks_repository VARCHAR(255) NOT NULL, DROP users_id');
        $this->addSql('DROP INDEX tasks_id ON tasks_users');
        $this->addSql('DROP INDEX tasks_id ON users');
        $this->addSql('ALTER TABLE users DROP tasks_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tasks ADD users_id INT DEFAULT NULL, DROP tasks_repository');
        $this->addSql('CREATE INDEX users_id ON tasks (users_id)');
        $this->addSql('CREATE INDEX tasks_id ON tasks_users (tasks_id)');
        $this->addSql('ALTER TABLE users ADD tasks_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX tasks_id ON users (tasks_id)');
    }
}
