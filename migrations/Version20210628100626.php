<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628100626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes ADD adr_fact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF883D573 FOREIGN KEY (adr_fact_id) REFERENCES adresse_livraison (id)');
        $this->addSql('CREATE INDEX IDX_35D4282CF883D573 ON commandes (adr_fact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF883D573');
        $this->addSql('DROP INDEX IDX_35D4282CF883D573 ON commandes');
        $this->addSql('ALTER TABLE commandes DROP adr_fact_id');
    }
}
