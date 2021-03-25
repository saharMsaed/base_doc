<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324154153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783F77DA139');
        $this->addSql('ALTER TABLE tag CHANGE tag_type_id tag_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783F77DA139 FOREIGN KEY (tag_type_id) REFERENCES tag_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783F77DA139');
        $this->addSql('ALTER TABLE tag CHANGE tag_type_id tag_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783F77DA139 FOREIGN KEY (tag_type_id) REFERENCES tag (id)');
    }
}
