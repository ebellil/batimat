<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190508192015 extends AbstractMigration
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
        $this->addSql('ALTER TABLE demande ADD idMat INT NOT NULL, CHANGE Etat Etat TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5B5887325 FOREIGN KEY (idMat) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A51899A8C9 FOREIGN KEY (idAgentAff) REFERENCES agentaffagence (id)');
        $this->addSql('CREATE INDEX idMat ON demande (idMat)');
        $this->addSql('DROP INDEX IDX_NOTE ON fournisseur');
        $this->addSql('DROP INDEX IDX_RAPPORT ON fournisseur');
        $this->addSql('ALTER TABLE fournisseur ADD noteglobale DOUBLE PRECISION NOT NULL, DROP note, DROP rapport');
        $this->addSql('ALTER TABLE detaildemande DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE detaildemande CHANGE numCommande numcommande INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detaildemande ADD CONSTRAINT FK_CD6D29BDDFA15DE9 FOREIGN KEY (numcommande) REFERENCES demande (numcommande)');
        $this->addSql('ALTER TABLE detaildemande ADD PRIMARY KEY (idMat)');
        $this->addSql('ALTER TABLE note DROP INDEX UNIQ_CFBDFA14748960DE, ADD INDEX IDX_CFBDFA14748960DE (admingeneral_id)');
        $this->addSql('ALTER TABLE note DROP INDEX UNIQ_CFBDFA14670C757F, ADD INDEX IDX_CFBDFA14670C757F (fournisseur_id)');
        $this->addSql('ALTER TABLE agent ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD roles VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY agentaffagence_ibfk_1');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE13654BF396750 FOREIGN KEY (id) REFERENCES agent (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE demandematerielrapport');
        $this->addSql('ALTER TABLE agent DROP username, DROP password, DROP roles, DROP nom, DROP prenom, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE13654BF396750');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT agentaffagence_ibfk_1 FOREIGN KEY (id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5B5887325');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A51899A8C9');
        $this->addSql('DROP INDEX idMat ON demande');
        $this->addSql('ALTER TABLE demande DROP idMat, CHANGE Etat Etat TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE detaildemande DROP FOREIGN KEY FK_CD6D29BDDFA15DE9');
        $this->addSql('ALTER TABLE detaildemande DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE detaildemande CHANGE numcommande numCommande INT NOT NULL');
        $this->addSql('ALTER TABLE detaildemande ADD PRIMARY KEY (idMat, numCommande)');
        $this->addSql('ALTER TABLE fournisseur ADD note INT DEFAULT NULL, ADD rapport INT DEFAULT NULL, DROP noteglobale');
        $this->addSql('CREATE INDEX IDX_NOTE ON fournisseur (note)');
        $this->addSql('CREATE INDEX IDX_RAPPORT ON fournisseur (rapport)');
        $this->addSql('ALTER TABLE note DROP INDEX IDX_CFBDFA14670C757F, ADD UNIQUE INDEX UNIQ_CFBDFA14670C757F (fournisseur_id)');
        $this->addSql('ALTER TABLE note DROP INDEX IDX_CFBDFA14748960DE, ADD UNIQUE INDEX UNIQ_CFBDFA14748960DE (admingeneral_id)');
    }
}
