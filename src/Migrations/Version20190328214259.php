<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190328214259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY admin_ibfk_1');
        $this->addSql('ALTER TABLE admin DROP nom, DROP prenom');
        $this->addSql('ALTER TABLE admingeneachat ADD CONSTRAINT FK_9F5BCE603414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F5BCE603414710B ON admingeneachat (agent_id)');
        $this->addSql('ALTER TABLE agentaffagence ADD CONSTRAINT FK_9EE136543414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9EE136543414710B ON agentaffagence (agent_id)');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY agent_ibfk_2');
        $this->addSql('ALTER TABLE agent DROP nom, DROP prenom');
        $this->addSql('ALTER TABLE user ADD agent_id INT DEFAULT NULL, ADD admin_id INT DEFAULT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493414710B ON user (agent_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649642B8210 ON user (admin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin ADD nom VARCHAR(255) NOT NULL COLLATE utf8_general_ci, ADD prenom VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT admin_ibfk_1 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admingeneachat DROP FOREIGN KEY FK_9F5BCE603414710B');
        $this->addSql('DROP INDEX UNIQ_9F5BCE603414710B ON admingeneachat');
        $this->addSql('ALTER TABLE agent ADD nom VARCHAR(255) NOT NULL COLLATE utf8_general_ci, ADD prenom VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT agent_ibfk_2 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agentaffagence DROP FOREIGN KEY FK_9EE136543414710B');
        $this->addSql('DROP INDEX UNIQ_9EE136543414710B ON agentaffagence');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493414710B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649642B8210');
        $this->addSql('DROP INDEX UNIQ_8D93D6493414710B ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649642B8210 ON user');
        $this->addSql('ALTER TABLE user DROP agent_id, DROP admin_id, DROP nom, DROP prenom');
    }
}
