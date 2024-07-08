<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240705130941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE games_players (games_id INT NOT NULL, players_id INT NOT NULL, INDEX IDX_9D872C4A97FFC673 (games_id), INDEX IDX_9D872C4AF1849495 (players_id), PRIMARY KEY(games_id, players_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE games_players ADD CONSTRAINT FK_9D872C4A97FFC673 FOREIGN KEY (games_id) REFERENCES games (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE games_players ADD CONSTRAINT FK_9D872C4AF1849495 FOREIGN KEY (players_id) REFERENCES players (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE games ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B3199E6F5DF FOREIGN KEY (player_id) REFERENCES players (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF232B3199E6F5DF ON games (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE games_players DROP FOREIGN KEY FK_9D872C4A97FFC673');
        $this->addSql('ALTER TABLE games_players DROP FOREIGN KEY FK_9D872C4AF1849495');
        $this->addSql('DROP TABLE games_players');
        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B3199E6F5DF');
        $this->addSql('DROP INDEX UNIQ_FF232B3199E6F5DF ON games');
        $this->addSql('ALTER TABLE games DROP player_id');
    }
}
