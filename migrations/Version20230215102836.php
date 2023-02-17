<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215102836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE restaurant_plat (restaurant_id INT NOT NULL, plat_id INT NOT NULL, INDEX IDX_E22E3263B1E7706E (restaurant_id), INDEX IDX_E22E3263D73DB560 (plat_id), PRIMARY KEY(restaurant_id, plat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE restaurant_plat ADD CONSTRAINT FK_E22E3263B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant_plat ADD CONSTRAINT FK_E22E3263D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_plat DROP FOREIGN KEY FK_E22E3263B1E7706E');
        $this->addSql('ALTER TABLE restaurant_plat DROP FOREIGN KEY FK_E22E3263D73DB560');
        $this->addSql('DROP TABLE restaurant_plat');
    }
}
