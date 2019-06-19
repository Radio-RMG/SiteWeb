<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190619145625 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dedicace (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(25) NOT NULL, message VARCHAR(150) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actuality (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(25) NOT NULL, title VARCHAR(255) NOT NULL, resume VARCHAR(50) NOT NULL, content LONGTEXT NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actuality_category (actuality_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CB33BA80B84BD854 (actuality_id), INDEX IDX_CB33BA8012469DE2 (category_id), PRIMARY KEY(actuality_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actuality_category ADD CONSTRAINT FK_CB33BA80B84BD854 FOREIGN KEY (actuality_id) REFERENCES actuality (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actuality_category ADD CONSTRAINT FK_CB33BA8012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actuality_category DROP FOREIGN KEY FK_CB33BA80B84BD854');
        $this->addSql('ALTER TABLE actuality_category DROP FOREIGN KEY FK_CB33BA8012469DE2');
        $this->addSql('DROP TABLE dedicace');
        $this->addSql('DROP TABLE actuality');
        $this->addSql('DROP TABLE actuality_category');
        $this->addSql('DROP TABLE category');
    }
}
