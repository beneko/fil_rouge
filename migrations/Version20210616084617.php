<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616084617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse_livraison (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_pays_id INT NOT NULL, ville_livr VARCHAR(255) NOT NULL, adresse_livraison VARCHAR(255) NOT NULL, code_postal_livr VARCHAR(255) NOT NULL, INDEX IDX_B0B09C9C6EE5C49 (id_utilisateur_id), INDEX IDX_B0B09C97879EB34 (id_pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, id_cat_id INT DEFAULT NULL, nom_cat VARCHAR(255) NOT NULL, libelle_cat VARCHAR(255) DEFAULT NULL, INDEX IDX_3AF34668C09A1CAE (id_cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, id_addr_livr_id INT NOT NULL, id_mode_livr_id INT NOT NULL, id_reduc_id INT DEFAULT NULL, date_com DATETIME NOT NULL, total_commande NUMERIC(10, 2) NOT NULL, INDEX IDX_35D4282CCCF8C1AA (id_addr_livr_id), INDEX IDX_35D4282C227224D7 (id_mode_livr_id), INDEX IDX_35D4282C10C6A06F (id_reduc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lig_com (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, qte_produit INT NOT NULL, remise NUMERIC(10, 2) NOT NULL, com_sous_tot NUMERIC(10, 2) NOT NULL, INDEX IDX_DD0A0C20AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marques (id INT AUTO_INCREMENT NOT NULL, nom_marque VARCHAR(255) NOT NULL, libelle_marque VARCHAR(255) DEFAULT NULL, logo_marque VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modes_livraison (id INT AUTO_INCREMENT NOT NULL, nom_mode VARCHAR(255) NOT NULL, libelle_liv VARCHAR(255) NOT NULL, delai_moy_liv INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom_pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, id_marque_id INT NOT NULL, nom_produit VARCHAR(255) NOT NULL, libelle_produit VARCHAR(255) DEFAULT NULL, prix_produit NUMERIC(10, 2) NOT NULL, stock_produit INT NOT NULL, pds_produit NUMERIC(10, 2) NOT NULL, INDEX IDX_BE2DDF8CC8120595 (id_marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reduc_passee (id INT AUTO_INCREMENT NOT NULL, id_reduc_id INT NOT NULL, INDEX IDX_DEF97F9A10C6A06F (id_reduc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reduc_passee_utilisateurs (reduc_passee_id INT NOT NULL, utilisateurs_id INT NOT NULL, INDEX IDX_D89A4E8AFA03D749 (reduc_passee_id), INDEX IDX_D89A4E8A1E969C5 (utilisateurs_id), PRIMARY KEY(reduc_passee_id, utilisateurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reduction (id INT AUTO_INCREMENT NOT NULL, nom_reduc VARCHAR(255) NOT NULL, montant_reduc NUMERIC(10, 2) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, qte_reduction INT NOT NULL, statut_reduc VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, date_naissance DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse_livraison ADD CONSTRAINT FK_B0B09C9C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE adresse_livraison ADD CONSTRAINT FK_B0B09C97879EB34 FOREIGN KEY (id_pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668C09A1CAE FOREIGN KEY (id_cat_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CCCF8C1AA FOREIGN KEY (id_addr_livr_id) REFERENCES adresse_livraison (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C227224D7 FOREIGN KEY (id_mode_livr_id) REFERENCES modes_livraison (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C10C6A06F FOREIGN KEY (id_reduc_id) REFERENCES reduction (id)');
        $this->addSql('ALTER TABLE lig_com ADD CONSTRAINT FK_DD0A0C20AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CC8120595 FOREIGN KEY (id_marque_id) REFERENCES marques (id)');
        $this->addSql('ALTER TABLE reduc_passee ADD CONSTRAINT FK_DEF97F9A10C6A06F FOREIGN KEY (id_reduc_id) REFERENCES reduction (id)');
        $this->addSql('ALTER TABLE reduc_passee_utilisateurs ADD CONSTRAINT FK_D89A4E8AFA03D749 FOREIGN KEY (reduc_passee_id) REFERENCES reduc_passee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reduc_passee_utilisateurs ADD CONSTRAINT FK_D89A4E8A1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CCCF8C1AA');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668C09A1CAE');
        $this->addSql('ALTER TABLE lig_com DROP FOREIGN KEY FK_DD0A0C209AF8E3A3');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CC8120595');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C227224D7');
        $this->addSql('ALTER TABLE adresse_livraison DROP FOREIGN KEY FK_B0B09C97879EB34');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E7879EB34');
        $this->addSql('ALTER TABLE lig_com DROP FOREIGN KEY FK_DD0A0C20AABEFE2C');
        $this->addSql('ALTER TABLE reduc_passee_utilisateurs DROP FOREIGN KEY FK_D89A4E8AFA03D749');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C10C6A06F');
        $this->addSql('ALTER TABLE reduc_passee DROP FOREIGN KEY FK_DEF97F9A10C6A06F');
        $this->addSql('ALTER TABLE adresse_livraison DROP FOREIGN KEY FK_B0B09C9C6EE5C49');
        $this->addSql('ALTER TABLE reduc_passee_utilisateurs DROP FOREIGN KEY FK_D89A4E8A1E969C5');
        $this->addSql('DROP TABLE adresse_livraison');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE lig_com');
        $this->addSql('DROP TABLE marques');
        $this->addSql('DROP TABLE modes_livraison');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE reduc_passee');
        $this->addSql('DROP TABLE reduc_passee_utilisateurs');
        $this->addSql('DROP TABLE reduction');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
