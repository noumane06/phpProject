<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611141524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE professeur_cours (professeur_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_6C94E7E2BAB22EE9 (professeur_id), INDEX IDX_6C94E7E27ECF78B0 (cours_id), PRIMARY KEY(professeur_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professeur_cours ADD CONSTRAINT FK_6C94E7E2BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_cours ADD CONSTRAINT FK_6C94E7E27ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departements ADD professeur VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE professeur ADD departements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A552991DB279A6 FOREIGN KEY (departements_id) REFERENCES departements (id)');
        $this->addSql('CREATE INDEX IDX_17A552991DB279A6 ON professeur (departements_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE professeur_cours');
        $this->addSql('ALTER TABLE departements DROP professeur');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A552991DB279A6');
        $this->addSql('DROP INDEX IDX_17A552991DB279A6 ON professeur');
        $this->addSql('ALTER TABLE professeur DROP departements_id');
    }
}
