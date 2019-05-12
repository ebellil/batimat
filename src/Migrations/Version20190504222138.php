<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190504222138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

       
        $this->addSql('ALTER TABLE fournisseur ADD noteglobale DOUBLE PRECISION NOT NULL');
     
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agent DROP username, DROP password, DROP roles, DROP nom, DROP prenom, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE13654BF396750');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT agentaffagence_ibfk_1 FOREIGN KEY (id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande ADD DemandeEcrite VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE Etat Etat TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE detaildemande DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE detaildemande CHANGE numcommande numCommande INT NOT NULL, CHANGE Note Note DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE detaildemande ADD CONSTRAINT FK_12IDMAT FOREIGN KEY (idMat) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX idMat ON detaildemande (idMat)');
        $this->addSql('ALTER TABLE detaildemande ADD PRIMARY KEY (idMat, numCommande)');
        $this->addSql('ALTER TABLE fournisseur ADD note INT DEFAULT NULL, ADD rapport INT DEFAULT NULL, DROP noteglobale');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT fournisseur_ibfk_1 FOREIGN KEY (note) REFERENCES note (id)');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT fournisseur_ibfk_2 FOREIGN KEY (rapport) REFERENCES rapport (id)');
        $this->addSql('CREATE INDEX IDX_RAPPORT ON fournisseur (rapport)');
        $this->addSql('CREATE INDEX IDX_NOTE ON fournisseur (note)');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14670C757F');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14748960DE');
        $this->addSql('ALTER TABLE note CHANGE fournisseur_id fournisseur_id INT NOT NULL, CHANGE admingeneral_id admingeneral_id INT NOT NULL');
        $this->addSql('ALTER TABLE note RENAME INDEX idx_cfbdfa14748960de TO FK_CFBDFA14748960DE');
        $this->addSql('ALTER TABLE note RENAME INDEX idx_cfbdfa14670c757f TO FK_CFBDFA14670C757F');
    }
}
