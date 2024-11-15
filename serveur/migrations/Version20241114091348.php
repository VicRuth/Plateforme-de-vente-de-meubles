<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114091348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE furniture (id INT AUTO_INCREMENT NOT NULL, family_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(500) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, state VARCHAR(255) DEFAULT NULL, stock BIGINT NOT NULL, color VARCHAR(255) NOT NULL, material VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_665DDAB3C35E566A (family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE furniture_room (id INT AUTO_INCREMENT NOT NULL, furniture_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_66F77B7BCF5485C3 (furniture_id), INDEX IDX_66F77B7B54177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, furniture_id INT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) DEFAULT NULL, INDEX IDX_C53D045FCF5485C3 (furniture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE furniture ADD CONSTRAINT FK_665DDAB3C35E566A FOREIGN KEY (family_id) REFERENCES family (id)');
        $this->addSql('ALTER TABLE furniture_room ADD CONSTRAINT FK_66F77B7BCF5485C3 FOREIGN KEY (furniture_id) REFERENCES furniture (id)');
        $this->addSql('ALTER TABLE furniture_room ADD CONSTRAINT FK_66F77B7B54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FCF5485C3 FOREIGN KEY (furniture_id) REFERENCES furniture (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE furniture DROP FOREIGN KEY FK_665DDAB3C35E566A');
        $this->addSql('ALTER TABLE furniture_room DROP FOREIGN KEY FK_66F77B7BCF5485C3');
        $this->addSql('ALTER TABLE furniture_room DROP FOREIGN KEY FK_66F77B7B54177093');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FCF5485C3');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE furniture');
        $this->addSql('DROP TABLE furniture_room');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE room');
    }
}
