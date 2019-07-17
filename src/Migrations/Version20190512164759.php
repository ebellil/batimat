<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190512164759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE demandematerielrapport (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, admingeneral_id INT DEFAULT NULL, rapport VARCHAR(255) DEFAULT NULL, INDEX IDX_9C71F47A670C757F (fournisseur_id), INDEX IDX_9C71F47A748960DE (admingeneral_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demandematerielrapport ADD CONSTRAINT FK_9C71F47A670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE demandematerielrapport ADD CONSTRAINT FK_9C71F47A748960DE FOREIGN KEY (admingeneral_id) REFERENCES admingeneachat (id)');
        $this->addSql('ALTER TABLE demande DROP quantite, DROP rapport, DROP note, CHANGE idmat idMat INT NOT NULL, CHANGE Etat Etat TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_RAPPORT ON fournisseur');
        $this->addSql('DROP INDEX IDX_NOTE ON fournisseur');
        $this->addSql('ALTER TABLE fournisseur DROP note, DROP rapport');
        $this->addSql('ALTER TABLE detaildemande DROP FOREIGN KEY FK_12IDMAT');
        $this->addSql('DROP INDEX numCommande_6 ON detaildemande');
        $this->addSql('DROP INDEX numCommande_3 ON detaildemande');
        $this->addSql('DROP INDEX idMat ON detaildemande');
        $this->addSql('DROP INDEX numCommande_4 ON detaildemande');
        $this->addSql('DROP INDEX numCommande_2 ON detaildemande');
        $this->addSql('DROP INDEX numCommande_5 ON detaildemande');
        $this->addSql('ALTER TABLE detaildemande DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE detaildemande DROP idAgent, CHANGE numCommande numcommande INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detaildemande ADD PRIMARY KEY (idMat)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F16880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE note CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE admingeneral_id admingeneral_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE note RENAME INDEX fk_cfbdfa14670c757f TO IDX_CFBDFA14670C757F');
        $this->addSql('ALTER TABLE note RENAME INDEX fk_cfbdfa14748960de TO IDX_CFBDFA14748960DE');
        $this->addSql('ALTER TABLE agent ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD roles VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY agentaffagence_ibfk_1');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE13654BF396750 FOREIGN KEY (id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091BF165E2F FOREIGN KEY (idCat) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091266963BB FOREIGN KEY (idF) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE demandematerielrapport');
        $this->addSql('ALTER TABLE agent DROP username, DROP password, DROP roles, DROP nom, DROP prenom, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE13654BF396750');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT agentaffagence_ibfk_1 FOREIGN KEY (id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande ADD quantite INT NOT NULL, ADD rapport TEXT DEFAULT NULL COLLATE latin1_swedish_ci, ADD note DOUBLE PRECISION DEFAULT NULL, CHANGE Etat Etat TINYINT(1) DEFAULT \'0\', CHANGE idMat idmat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detaildemande DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE detaildemande ADD idAgent INT NOT NULL, CHANGE numcommande numCommande INT NOT NULL');
        $this->addSql('ALTER TABLE detaildemande ADD CONSTRAINT FK_12IDMAT FOREIGN KEY (idMat) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX numCommande_6 ON detaildemande (numCommande)');
        $this->addSql('CREATE UNIQUE INDEX numCommande_3 ON detaildemande (numCommande)');
        $this->addSql('CREATE INDEX idMat ON detaildemande (idMat)');
        $this->addSql('CREATE INDEX numCommande_4 ON detaildemande (numCommande)');
        $this->addSql('CREATE INDEX numCommande_2 ON detaildemande (numCommande)');
        $this->addSql('CREATE INDEX numCommande_5 ON detaildemande (numCommande)');
        $this->addSql('ALTER TABLE detaildemande ADD PRIMARY KEY (idMat, numCommande)');
        $this->addSql('ALTER TABLE fournisseur ADD note INT DEFAULT NULL, ADD rapport INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_RAPPORT ON fournisseur (rapport)');
        $this->addSql('CREATE INDEX IDX_NOTE ON fournisseur (note)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F16880AAF');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091BF165E2F');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091266963BB');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14670C757F');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14748960DE');
        $this->addSql('ALTER TABLE note CHANGE fournisseur_id fournisseur_id INT NOT NULL, CHANGE admingeneral_id admingeneral_id INT NOT NULL');
        $this->addSql('ALTER TABLE note RENAME INDEX idx_cfbdfa14748960de TO FK_CFBDFA14748960DE');
        $this->addSql('ALTER TABLE note RENAME INDEX idx_cfbdfa14670c757f TO FK_CFBDFA14670C757F');
    }
}
