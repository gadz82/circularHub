<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611153643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address_book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address_book_entry (id INT AUTO_INCREMENT NOT NULL, address_book_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(125) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, next_update_at DATETIME DEFAULT NULL, INDEX IDX_5D7E00974D474419 (address_book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, topic_id INT DEFAULT NULL, title VARCHAR(75) NOT NULL, INDEX IDX_6DC044C51F55203D (topic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_8F02BF9DA76ED395 (user_id), INDEX IDX_8F02BF9DFE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topic (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, closes_at DATETIME DEFAULT NULL, type LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topic_comment (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, topic_id INT NOT NULL, text LONGTEXT NOT NULL, INDEX IDX_1CDF0FB9A76ED395 (user_id), INDEX IDX_1CDF0FB91F55203D (topic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address_book_entry ADD CONSTRAINT FK_5D7E00974D474419 FOREIGN KEY (address_book_id) REFERENCES address_book (id)');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C51F55203D FOREIGN KEY (topic_id) REFERENCES topic (id)');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DA76ED395 FOREIGN KEY (user_id) REFERENCES symfony_demo_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE topic_comment ADD CONSTRAINT FK_1CDF0FB9A76ED395 FOREIGN KEY (user_id) REFERENCES symfony_demo_user (id)');
        $this->addSql('ALTER TABLE topic_comment ADD CONSTRAINT FK_1CDF0FB91F55203D FOREIGN KEY (topic_id) REFERENCES topic (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address_book_entry DROP FOREIGN KEY FK_5D7E00974D474419');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DFE54D947');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C51F55203D');
        $this->addSql('ALTER TABLE topic_comment DROP FOREIGN KEY FK_1CDF0FB91F55203D');
        $this->addSql('DROP TABLE address_book');
        $this->addSql('DROP TABLE address_book_entry');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE topic_comment');
    }
}
