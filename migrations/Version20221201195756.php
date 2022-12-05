<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201195756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_bancaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, numero VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande_paiement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, paiement_email_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, type_virement VARCHAR(255) NOT NULL, statut TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_F78533DCA76ED395 (user_id), INDEX IDX_F78533DC629539F3 (paiement_email_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement_email (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, email VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_4F0A996BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande_paiement ADD CONSTRAINT FK_F78533DCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demande_paiement ADD CONSTRAINT FK_F78533DC629539F3 FOREIGN KEY (paiement_email_id) REFERENCES paiement_email (id)');
        $this->addSql('ALTER TABLE paiement_email ADD CONSTRAINT FK_4F0A996BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_paiement DROP FOREIGN KEY FK_F78533DC629539F3');
        $this->addSql('DROP TABLE carte_bancaire');
        $this->addSql('DROP TABLE demande_paiement');
        $this->addSql('DROP TABLE paiement_email');
    }
}
