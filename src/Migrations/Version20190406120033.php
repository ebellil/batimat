<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190406120033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY agent_ibfk_1');
        $this->addSql('ALTER TABLE agent CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE admingeneachat DROP FOREIGN KEY admingeneachat_ibfk_1');
        $this->addSql('ALTER TABLE admingeneachat ADD agent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admingeneachat ADD CONSTRAINT FK_9F5BCE603414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F5BCE603414710B ON admingeneachat (agent_id)');
        $this->addSql('ALTER TABLE demande CHANGE Date Date DATE NOT NULL, CHANGE Etat Etat TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY agentaffagence_ibfk_1');
        $this->addSql('ALTER TABLE agentaffagence ADD agent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE13654BF396750 FOREIGN KEY (id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE136543414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9EE136543414710B ON agentaffagence (agent_id)');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY admin_ibfk_1');
        $this->addSql('ALTER TABLE admin CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT admin_ibfk_1 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admingeneachat DROP FOREIGN KEY FK_9F5BCE603414710B');
        $this->addSql('DROP INDEX UNIQ_9F5BCE603414710B ON admingeneachat');
        $this->addSql('ALTER TABLE admingeneachat DROP agent_id');
        $this->addSql('ALTER TABLE admingeneachat ADD CONSTRAINT admingeneachat_ibfk_1 FOREIGN KEY (id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT agent_ibfk_1 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE13654BF396750');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE136543414710B');
        $this->addSql('DROP INDEX UNIQ_9EE136543414710B ON agentaffagence');
        $this->addSql('ALTER TABLE agentaffagence DROP agent_id');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT agentaffagence_ibfk_1 FOREIGN KEY (id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande CHANGE Date Date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE Etat Etat TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
