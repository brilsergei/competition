<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003120753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO team (name, division_id) VALUES "
          . "('A', 1), "
          . "('B', 1), "
          . "('C', 1), "
          . "('D', 1), "
          . "('E', 1), "
          . "('F', 1), "
          . "('G', 1), "
          . "('H', 1), "
          . "('I', 2), "
          . "('J', 2), "
          . "('K', 2), "
          . "('L', 2), "
          . "('M', 2), "
          . "('N', 2), "
          . "('O', 2), "
          . "('P', 2)"
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM team WHERE name IN ('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P')");
    }
}
