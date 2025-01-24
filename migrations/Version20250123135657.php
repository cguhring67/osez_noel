<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123135657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier CHANGE case_couleur_fond case_couleur_fond VARCHAR(7) NOT NULL, CHANGE case_bordure_couleur case_bordure_couleur VARCHAR(7) NOT NULL, CHANGE texte_couleur texte_couleur VARCHAR(7) NOT NULL, CHANGE texte_bordure_couleur texte_bordure_couleur VARCHAR(7) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier CHANGE case_couleur_fond case_couleur_fond VARCHAR(6) NOT NULL, CHANGE case_bordure_couleur case_bordure_couleur VARCHAR(6) NOT NULL, CHANGE texte_couleur texte_couleur VARCHAR(6) NOT NULL, CHANGE texte_bordure_couleur texte_bordure_couleur VARCHAR(6) NOT NULL');
    }
}
