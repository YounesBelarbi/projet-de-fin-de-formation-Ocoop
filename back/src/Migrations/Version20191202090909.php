<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191202090909 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, guild_id INT DEFAULT NULL, frequency_id INT NOT NULL, status_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, birth DATETIME NOT NULL, email VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D6495F2131EF (guild_id), INDEX IDX_8D93D64994879022 (frequency_id), INDEX IDX_8D93D6496BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite_game (id INT AUTO_INCREMENT NOT NULL, rank_id INT DEFAULT NULL, game_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_CD2D28B37616678F (rank_id), INDEX IDX_CD2D28B3E48FD905 (game_id), INDEX IDX_CD2D28B3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, poster VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_plateform (game_id INT NOT NULL, plateform_id INT NOT NULL, INDEX IDX_DC247165E48FD905 (game_id), INDEX IDX_DC247165CCAA542F (plateform_id), PRIMARY KEY(game_id, plateform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495F2131EF FOREIGN KEY (guild_id) REFERENCES guild (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64994879022 FOREIGN KEY (frequency_id) REFERENCES frequency (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE favorite_game ADD CONSTRAINT FK_CD2D28B37616678F FOREIGN KEY (rank_id) REFERENCES rank (id)');
        $this->addSql('ALTER TABLE favorite_game ADD CONSTRAINT FK_CD2D28B3E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE favorite_game ADD CONSTRAINT FK_CD2D28B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game_plateform ADD CONSTRAINT FK_DC247165E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_plateform ADD CONSTRAINT FK_DC247165CCAA542F FOREIGN KEY (plateform_id) REFERENCES plateform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rank ADD games_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rank ADD CONSTRAINT FK_8879E8E597FFC673 FOREIGN KEY (games_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_8879E8E597FFC673 ON rank (games_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE favorite_game DROP FOREIGN KEY FK_CD2D28B3A76ED395');
        $this->addSql('ALTER TABLE rank DROP FOREIGN KEY FK_8879E8E597FFC673');
        $this->addSql('ALTER TABLE favorite_game DROP FOREIGN KEY FK_CD2D28B3E48FD905');
        $this->addSql('ALTER TABLE game_plateform DROP FOREIGN KEY FK_DC247165E48FD905');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE favorite_game');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_plateform');
        $this->addSql('DROP INDEX IDX_8879E8E597FFC673 ON rank');
        $this->addSql('ALTER TABLE rank DROP games_id');
    }
}
