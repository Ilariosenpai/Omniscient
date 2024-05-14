<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514143409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE players ADD game_id INT DEFAULT NULL, DROP game');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A6E48FD905 FOREIGN KEY (game_id) REFERENCES games (id)');
        $this->addSql('CREATE INDEX IDX_264E43A6E48FD905 ON players (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A6E48FD905');
        $this->addSql('DROP INDEX IDX_264E43A6E48FD905 ON players');
        $this->addSql('ALTER TABLE players ADD game VARCHAR(255) NOT NULL, DROP game_id');
    }
}
