<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190308064547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, Libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, MatriculeF VARCHAR(255) NOT NULL, RaisonSociale VARCHAR(255) NOT NULL, Adresse VARCHAR(255) NOT NULL, Ville VARCHAR(255) NOT NULL, Pays VARCHAR(255) NOT NULL, NoteGlobale VARCHAR(255) NOT NULL, RapportEcrit TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detaildemande (Quantite INT NOT NULL, Note DOUBLE PRECISION NOT NULL, Commentaire TEXT NOT NULL, idMat INT NOT NULL, numCommande INT NOT NULL, INDEX numCommande (numCommande), PRIMARY KEY(idMat, numCommande)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admingeneachat (id INT AUTO_INCREMENT NOT NULL, MatriculeAd VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (NumCommande INT AUTO_INCREMENT NOT NULL, DemandeEcrite VARCHAR(255) NOT NULL, Date DATE NOT NULL, Etat TINYINT(1) NOT NULL, idMat INT NOT NULL, idAgentAff INT NOT NULL, INDEX idMat (idMat), INDEX idAgentAff (idAgentAff), PRIMARY KEY(NumCommande)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agentaffagence (id INT NOT NULL, MatriculeAg VARCHAR(255) NOT NULL, Agence VARCHAR(255) NOT NULL, VilleAgence VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, Libelle VARCHAR(255) NOT NULL, Description TEXT NOT NULL, Stock INT NOT NULL, idCat INT NOT NULL, idF INT NOT NULL, fileName VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX materiel_ibfk_1 (idCat), INDEX idF (idF), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, mdp VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE13654BF396750 FOREIGN KEY (id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091BF165E2F FOREIGN KEY (idCat) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091266963BB FOREIGN KEY (idF) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091BF165E2F');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091266963BB');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE13654BF396750');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE detaildemande');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE admingeneachat');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE agentaffagence');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE admin');
    }
}
