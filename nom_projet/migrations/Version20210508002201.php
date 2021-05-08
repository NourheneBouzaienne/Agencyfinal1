<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210508002201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_emploi ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D1BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_132AD0D1BCF5E72D ON offre_emploi (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D1BCF5E72D');
        $this->addSql('DROP INDEX IDX_132AD0D1BCF5E72D ON offre_emploi');
        $this->addSql('ALTER TABLE offre_emploi DROP categorie_id');
    }
}
