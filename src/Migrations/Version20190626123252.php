<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190626123252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actuality ADD category_id INT DEFAULT NULL, DROP category');
        $this->addSql('ALTER TABLE actuality ADD CONSTRAINT FK_4093DDD812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_4093DDD812469DE2 ON actuality (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actuality DROP FOREIGN KEY FK_4093DDD812469DE2');
        $this->addSql('DROP INDEX IDX_4093DDD812469DE2 ON actuality');
        $this->addSql('ALTER TABLE actuality ADD category VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP category_id');
    }
}
