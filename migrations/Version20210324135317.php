<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324135317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, editor_id INT NOT NULL, content_type_id INT NOT NULL, title VARCHAR(255) NOT NULL, abstract LONGTEXT DEFAULT NULL, keywords VARCHAR(255) NOT NULL, INDEX IDX_FEC530A96995AC4C (editor_id), INDEX IDX_FEC530A91A445520 (content_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_user (content_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_40F13B8C84A0A3ED (content_id), INDEX IDX_40F13B8CA76ED395 (user_id), PRIMARY KEY(content_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_tag (content_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_B662E17684A0A3ED (content_id), INDEX IDX_B662E176BAD26311 (tag_id), PRIMARY KEY(content_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sheet (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, modification_date DATETIME NOT NULL, publication_date DATETIME DEFAULT NULL, expiration_date DATETIME DEFAULT NULL, description LONGTEXT NOT NULL, short_info VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, tag_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_389B783F77DA139 (tag_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A96995AC4C FOREIGN KEY (editor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A91A445520 FOREIGN KEY (content_type_id) REFERENCES content_type (id)');
        $this->addSql('ALTER TABLE content_user ADD CONSTRAINT FK_40F13B8C84A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_user ADD CONSTRAINT FK_40F13B8CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_tag ADD CONSTRAINT FK_B662E17684A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_tag ADD CONSTRAINT FK_B662E176BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783F77DA139 FOREIGN KEY (tag_type_id) REFERENCES tag (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content_user DROP FOREIGN KEY FK_40F13B8C84A0A3ED');
        $this->addSql('ALTER TABLE content_tag DROP FOREIGN KEY FK_B662E17684A0A3ED');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A91A445520');
        $this->addSql('ALTER TABLE content_tag DROP FOREIGN KEY FK_B662E176BAD26311');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783F77DA139');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE content_user');
        $this->addSql('DROP TABLE content_tag');
        $this->addSql('DROP TABLE content_type');
        $this->addSql('DROP TABLE sheet');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_type');
    }
}
