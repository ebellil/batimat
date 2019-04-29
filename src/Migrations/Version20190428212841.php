<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428212841 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fournisseur ADD NoteGlobale VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE fournisseur_rapport DROP INDEX IDX_6CF4EF31670C757F, ADD UNIQUE INDEX UNIQ_6CF4EF31670C757F (fournisseur_id)');
        $this->addSql('ALTER TABLE fournisseur_rapport DROP INDEX IDX_6CF4EF31748960DE, ADD UNIQUE INDEX UNIQ_6CF4EF31748960DE (admingeneral_id)');
        $this->addSql('ALTER TABLE agent ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD roles VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY agentaffagence_ibfk_1');
        $this->addSql('ALTER TABLE agentaffagence ADD agent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE13654BF396750 FOREIGN KEY (id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE136543414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9EE136543414710B ON agentaffagence (agent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agent DROP username, DROP password, DROP roles, DROP nom, DROP prenom, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE13654BF396750');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE136543414710B');
        $this->addSql('DROP INDEX UNIQ_9EE136543414710B ON agentaffagence');
        $this->addSql('ALTER TABLE agentaffagence DROP agent_id');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT agentaffagence_ibfk_1 FOREIGN KEY (id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur DROP NoteGlobale');
        $this->addSql('ALTER TABLE fournisseur_rapport DROP INDEX UNIQ_6CF4EF31670C757F, ADD INDEX IDX_6CF4EF31670C757F (fournisseur_id)');
        $this->addSql('ALTER TABLE fournisseur_rapport DROP INDEX UNIQ_6CF4EF31748960DE, ADD INDEX IDX_6CF4EF31748960DE (admingeneral_id)');
    }
}
