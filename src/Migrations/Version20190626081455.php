<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190626081455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actuality_tag (actuality_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_4E30125B84BD854 (actuality_id), INDEX IDX_4E30125BAD26311 (tag_id), PRIMARY KEY(actuality_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actuality_tag ADD CONSTRAINT FK_4E30125B84BD854 FOREIGN KEY (actuality_id) REFERENCES actuality (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actuality_tag ADD CONSTRAINT FK_4E30125BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE actuality_category');
        $this->addSql('ALTER TABLE actuality ADD category_id INT DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE actuality ADD CONSTRAINT FK_4093DDD812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_4093DDD812469DE2 ON actuality (category_id)');
        $this->addSql('ALTER TABLE category ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actuality_tag DROP FOREIGN KEY FK_4E30125BAD26311');
        $this->addSql('CREATE TABLE actuality_category (actuality_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CB33BA80B84BD854 (actuality_id), INDEX IDX_CB33BA8012469DE2 (category_id), PRIMARY KEY(actuality_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE actuality_category ADD CONSTRAINT FK_CB33BA8012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actuality_category ADD CONSTRAINT FK_CB33BA80B84BD854 FOREIGN KEY (actuality_id) REFERENCES actuality (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE actuality_tag');
        $this->addSql('ALTER TABLE actuality DROP FOREIGN KEY FK_4093DDD812469DE2');
        $this->addSql('DROP INDEX IDX_4093DDD812469DE2 ON actuality');
        $this->addSql('ALTER TABLE actuality DROP category_id, DROP slug');
        $this->addSql('ALTER TABLE category DROP slug');
    }
}
