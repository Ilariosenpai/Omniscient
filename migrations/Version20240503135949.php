<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503135949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE games (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, player_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, plateform VARCHAR(255) NOT NULL, palmares VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FF232B313DA5256D (image_id), UNIQUE INDEX UNIQ_FF232B3199E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE players (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, game VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_264E43A63DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B313DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B3199E6F5DF FOREIGN KEY (player_id) REFERENCES players (id)');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A63DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B313DA5256D');
        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B3199E6F5DF');
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A63DA5256D');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE players');
    }
}
