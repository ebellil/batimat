<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190512172132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demande DROP rapport, DROP note, CHANGE idmat idMat INT NOT NULL, CHANGE Etat Etat TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091BF165E2F FOREIGN KEY (idCat) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091266963BB FOREIGN KEY (idF) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE agent ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD roles VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY agentaffagence_ibfk_1');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE13654BF396750 FOREIGN KEY (id) REFERENCES agent (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agent DROP username, DROP password, DROP roles, DROP nom, DROP prenom, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE13654BF396750');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT agentaffagence_ibfk_1 FOREIGN KEY (id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande ADD rapport TEXT DEFAULT NULL COLLATE latin1_swedish_ci, ADD note DOUBLE PRECISION DEFAULT NULL, CHANGE Etat Etat TINYINT(1) DEFAULT \'0\', CHANGE idMat idmat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091BF165E2F');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091266963BB');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14670C757F');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14748960DE');
    }
}
