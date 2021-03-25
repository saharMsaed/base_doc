<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324135558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A94146F844');
        $this->addSql('DROP INDEX IDX_FEC530A94146F844 ON content');
        $this->addSql('ALTER TABLE content DROP sheets_id');
        $this->addSql('ALTER TABLE sheet ADD content_id INT NOT NULL');
        $this->addSql('ALTER TABLE sheet ADD CONSTRAINT FK_873C91E284A0A3ED FOREIGN KEY (content_id) REFERENCES content (id)');
        $this->addSql('CREATE INDEX IDX_873C91E284A0A3ED ON sheet (content_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content ADD sheets_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A94146F844 FOREIGN KEY (sheets_id) REFERENCES sheet (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A94146F844 ON content (sheets_id)');
        $this->addSql('ALTER TABLE sheet DROP FOREIGN KEY FK_873C91E284A0A3ED');
        $this->addSql('DROP INDEX IDX_873C91E284A0A3ED ON sheet');
        $this->addSql('ALTER TABLE sheet DROP content_id');
    }
}
