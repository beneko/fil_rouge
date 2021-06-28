<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616122056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lig_com ADD ref_commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE lig_com ADD CONSTRAINT FK_DD0A0C2078E3D6D8 FOREIGN KEY (ref_commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_DD0A0C2078E3D6D8 ON lig_com (ref_commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE lig_com DROP FOREIGN KEY FK_DD0A0C2078E3D6D8');
        $this->addSql('DROP INDEX IDX_DD0A0C2078E3D6D8 ON lig_com');
        $this->addSql('ALTER TABLE lig_com DROP ref_commande_id');
    }
}
