<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191129162647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE favorite_game DROP FOREIGN KEY FK_CD2D28B352BF775D');
        $this->addSql('CREATE TABLE frequency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guild (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, banner VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plateform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE rank_by_game');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD description LONGTEXT DEFAULT NULL, ADD firstname VARCHAR(255) DEFAULT NULL, ADD lastname VARCHAR(255) DEFAULT NULL, ADD birth DATETIME NOT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD longitude DOUBLE PRECISION DEFAULT NULL, ADD latitude DOUBLE PRECISION DEFAULT NULL, ADD mobile VARCHAR(255) DEFAULT NULL, ADD avatar VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL, CHANGE username username VARCHAR(180) NOT NULL, CHANGE role email VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('ALTER TABLE favorite_game DROP FOREIGN KEY FK_CD2D28B3A76ED395');
        $this->addSql('ALTER TABLE favorite_game DROP FOREIGN KEY FK_CD2D28B3E48FD905');
        $this->addSql('DROP INDEX IDX_CD2D28B3A76ED395 ON favorite_game');
        $this->addSql('DROP INDEX IDX_CD2D28B352BF775D ON favorite_game');
        $this->addSql('DROP INDEX IDX_CD2D28B3E48FD905 ON favorite_game');
        $this->addSql('ALTER TABLE favorite_game DROP user_id, DROP game_id, DROP rank_by_game_id');
        $this->addSql('ALTER TABLE game ADD description LONGTEXT DEFAULT NULL, ADD poster VARCHAR(255) NOT NULL, ADD logo VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rank_by_game (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_37C8ED63E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE rank_by_game ADD CONSTRAINT FK_37C8ED63E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('DROP TABLE frequency');
        $this->addSql('DROP TABLE guild');
        $this->addSql('DROP TABLE rank');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE plateform');
        $this->addSql('ALTER TABLE favorite_game ADD user_id INT DEFAULT NULL, ADD game_id INT DEFAULT NULL, ADD rank_by_game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorite_game ADD CONSTRAINT FK_CD2D28B352BF775D FOREIGN KEY (rank_by_game_id) REFERENCES rank_by_game (id)');
        $this->addSql('ALTER TABLE favorite_game ADD CONSTRAINT FK_CD2D28B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite_game ADD CONSTRAINT FK_CD2D28B3E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_CD2D28B3A76ED395 ON favorite_game (user_id)');
        $this->addSql('CREATE INDEX IDX_CD2D28B352BF775D ON favorite_game (rank_by_game_id)');
        $this->addSql('CREATE INDEX IDX_CD2D28B3E48FD905 ON favorite_game (game_id)');
        $this->addSql('ALTER TABLE game DROP description, DROP poster, DROP logo, DROP created_at, DROP updated_at');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user DROP roles, DROP description, DROP firstname, DROP lastname, DROP birth, DROP city, DROP longitude, DROP latitude, DROP mobile, DROP avatar, DROP created_at, DROP updated_at, CHANGE username username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
