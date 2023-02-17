<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216093716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plats_commander (id INT AUTO_INCREMENT NOT NULL, fk_livraisons_id INT DEFAULT NULL, fk_plats_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_88B9B3CC8B1485B (fk_livraisons_id), INDEX IDX_88B9B3C983CA216 (fk_plats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plats_commander ADD CONSTRAINT FK_88B9B3CC8B1485B FOREIGN KEY (fk_livraisons_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE plats_commander ADD CONSTRAINT FK_88B9B3C983CA216 FOREIGN KEY (fk_plats_id) REFERENCES plat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plats_commander DROP FOREIGN KEY FK_88B9B3CC8B1485B');
        $this->addSql('ALTER TABLE plats_commander DROP FOREIGN KEY FK_88B9B3C983CA216');
        $this->addSql('DROP TABLE plats_commander');
    }
}
