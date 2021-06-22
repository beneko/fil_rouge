<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622131934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E7879EB34');
        $this->addSql('DROP INDEX IDX_497B315E7879EB34 ON utilisateurs');
        $this->addSql('DROP INDEX IDX_497B315E89E8BDC ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, DROP id_pays_id, DROP id_role_id, DROP mot_de_passe, DROP telephone, DROP code_postal, DROP ville, DROP adresse, DROP date_naissance, CHANGE mail mail VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_497B315E5126AC48 ON utilisateurs (mail)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_497B315E5126AC48 ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs ADD id_pays_id INT NOT NULL, ADD id_role_id INT NOT NULL, ADD telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD code_postal VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD date_naissance DATETIME DEFAULT NULL, DROP roles, CHANGE mail mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E7879EB34 FOREIGN KEY (id_pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_497B315E7879EB34 ON utilisateurs (id_pays_id)');
        $this->addSql('CREATE INDEX IDX_497B315E89E8BDC ON utilisateurs (id_role_id)');
    }
}
