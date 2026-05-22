<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260522222500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Step 1: add as nullable
        $this->addSql('ALTER TABLE `user` ADD created_at DATETIME DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL');

        // Step 2: fill existing rows with a default date
        $this->addSql("UPDATE `user` SET created_at = NOW() WHERE created_at IS NULL");

        // Step 3: now make it NOT NULL
        $this->addSql('ALTER TABLE `user` MODIFY created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP phone, DROP created_at');
    }
}
