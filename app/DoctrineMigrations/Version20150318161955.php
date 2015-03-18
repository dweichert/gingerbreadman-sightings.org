<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150318161955 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, birthday DATETIME DEFAULT NULL, timezone VARCHAR(50) DEFAULT NULL, createdAt DATETIME DEFAULT NULL, updatedAt DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2DA1797792FC23A8 (username_canonical), UNIQUE INDEX UNIQ_2DA17977A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Organisation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(256) NOT NULL, description LONGTEXT NOT NULL, country VARCHAR(2) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, membersonly TINYINT(1) NOT NULL, createdAt DATETIME DEFAULT NULL, updatedAt DATETIME DEFAULT NULL, createdBy_id INT DEFAULT NULL, updatedBy_id INT DEFAULT NULL, deletedBy_id INT DEFAULT NULL, INDEX IDX_FED0E94CA76ED395 (user_id), INDEX IDX_FED0E94C3174800F (createdBy_id), INDEX IDX_FED0E94C65FF1AEC (updatedBy_id), INDEX IDX_FED0E94C63D8C20E (deletedBy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE OrganisationTranslation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_DBB6206A2C2AC5D3 (translatable_id), UNIQUE INDEX OrganisationTranslation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Organisation ADD CONSTRAINT FK_FED0E94CA76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Organisation ADD CONSTRAINT FK_FED0E94C3174800F FOREIGN KEY (createdBy_id) REFERENCES User (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Organisation ADD CONSTRAINT FK_FED0E94C65FF1AEC FOREIGN KEY (updatedBy_id) REFERENCES User (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Organisation ADD CONSTRAINT FK_FED0E94C63D8C20E FOREIGN KEY (deletedBy_id) REFERENCES User (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE OrganisationTranslation ADD CONSTRAINT FK_DBB6206A2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES Organisation (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Organisation DROP FOREIGN KEY FK_FED0E94CA76ED395');
        $this->addSql('ALTER TABLE Organisation DROP FOREIGN KEY FK_FED0E94C3174800F');
        $this->addSql('ALTER TABLE Organisation DROP FOREIGN KEY FK_FED0E94C65FF1AEC');
        $this->addSql('ALTER TABLE Organisation DROP FOREIGN KEY FK_FED0E94C63D8C20E');
        $this->addSql('ALTER TABLE OrganisationTranslation DROP FOREIGN KEY FK_DBB6206A2C2AC5D3');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE Organisation');
        $this->addSql('DROP TABLE OrganisationTranslation');
    }
}
