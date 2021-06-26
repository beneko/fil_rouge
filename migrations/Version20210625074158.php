<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210625074158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('DROP TABLE roles');
        $this->addSql('ALTER TABLE lig_com DROP FOREIGN KEY FK_DD0A0C209AF8E3A3');
        $this->addSql('DROP INDEX IDX_DD0A0C209AF8E3A3 ON lig_com');
        $this->addSql('ALTER TABLE lig_com DROP id_commande_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lig_com ADD id_commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE lig_com ADD CONSTRAINT FK_DD0A0C209AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_DD0A0C209AF8E3A3 ON lig_com (id_commande_id)');
    }
}
