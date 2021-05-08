<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210508042958 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D18D0EB82');
        $this->addSql('DROP INDEX o ON offre_emploi');
        $this->addSql('ALTER TABLE offre_emploi DROP con');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_emploi ADD con INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D18D0EB82 FOREIGN KEY (con) REFERENCES candidat (id)');
        $this->addSql('CREATE INDEX o ON offre_emploi (con)');
    }
}
