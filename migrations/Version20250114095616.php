<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250114095616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendrier (id INT AUTO_INCREMENT NOT NULL, calendrier_user_id_id INT NOT NULL, token VARCHAR(50) NOT NULL, nom_calendrier VARCHAR(100) NOT NULL, message VARCHAR(255) NOT NULL, arriere_plan VARCHAR(50) NOT NULL, case_couleur_fond VARCHAR(6) NOT NULL, case_opacite DOUBLE PRECISION NOT NULL, case_bordure_couleur VARCHAR(6) NOT NULL, case_bordure_epaisseur SMALLINT NOT NULL, case_bordure_opacite DOUBLE PRECISION NOT NULL, texte_couleur VARCHAR(6) NOT NULL, texte_opacite DOUBLE PRECISION NOT NULL, texte_bordure_couleur VARCHAR(6) NOT NULL, texte_bordure_epaisseur SMALLINT NOT NULL, texte_bordure_opacite DOUBLE PRECISION NOT NULL, texte_police VARCHAR(50) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME NOT NULL, INDEX IDX_B2753CB98623E087 (calendrier_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uploads (id INT AUTO_INCREMENT NOT NULL, upload_user_id_id INT NOT NULL, upload_date DATETIME NOT NULL, upload_fichier VARCHAR(255) NOT NULL, INDEX IDX_96117F18366AC7B4 (upload_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, role VARCHAR(5) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB98623E087 FOREIGN KEY (calendrier_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE uploads ADD CONSTRAINT FK_96117F18366AC7B4 FOREIGN KEY (upload_user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB98623E087');
        $this->addSql('ALTER TABLE uploads DROP FOREIGN KEY FK_96117F18366AC7B4');
        $this->addSql('DROP TABLE calendrier');
        $this->addSql('DROP TABLE uploads');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
