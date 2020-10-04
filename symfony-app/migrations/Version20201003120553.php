<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003120553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE division (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_result (id INT AUTO_INCREMENT NOT NULL, team_1_id INT NOT NULL, team_2_id INT NOT NULL, score_1 INT NOT NULL, score_2 INT NOT NULL, stage VARCHAR(255) NOT NULL, INDEX IDX_6E5F6CDB2132A881 (team_1_id), INDEX IDX_6E5F6CDB3387076F (team_2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, division_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C4E0A61F41859289 (division_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_result ADD CONSTRAINT FK_6E5F6CDB2132A881 FOREIGN KEY (team_1_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game_result ADD CONSTRAINT FK_6E5F6CDB3387076F FOREIGN KEY (team_2_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F41859289 FOREIGN KEY (division_id) REFERENCES division (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F41859289');
        $this->addSql('ALTER TABLE game_result DROP FOREIGN KEY FK_6E5F6CDB2132A881');
        $this->addSql('ALTER TABLE game_result DROP FOREIGN KEY FK_6E5F6CDB3387076F');
        $this->addSql('DROP TABLE division');
        $this->addSql('DROP TABLE game_result');
        $this->addSql('DROP TABLE team');
    }
}
