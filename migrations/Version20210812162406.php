<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812162406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO departements (name, email) VALUES
        (\'RH\',\'rh@efficience-it.com\'),  
        (\'commerciaux\',\'commerce@efficience-it.com\'),
        (\'informations\',\'info@efficience-it.com\'),
        (\'IT\',\'it@efficience-it.com\');
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE TABLE departements');
    }
}
