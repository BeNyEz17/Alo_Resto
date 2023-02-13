<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213143938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat ADD fk_type_plat_id INT NOT NULL');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207DEC1D88C FOREIGN KEY (fk_type_plat_id) REFERENCES typeplat (id)');
        $this->addSql('CREATE INDEX IDX_2038A207DEC1D88C ON plat (fk_type_plat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207DEC1D88C');
        $this->addSql('DROP INDEX IDX_2038A207DEC1D88C ON plat');
        $this->addSql('ALTER TABLE plat DROP fk_type_plat_id');
    }
}