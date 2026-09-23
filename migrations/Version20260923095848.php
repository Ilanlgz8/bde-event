<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260923095848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campus (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE evenements (id INT AUTO_INCREMENT NOT NULL, img VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start_time TIME NOT NULL, start_date DATE NOT NULL, end_time TIME NOT NULL, end_date DATE NOT NULL, location VARCHAR(10) DEFAULT NULL, cree_par_id INT DEFAULT NULL, salle_id INT NOT NULL, INDEX IDX_E10AD400FC29C013 (cree_par_id), INDEX IDX_E10AD400DC304035 (salle_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, capacite INT NOT NULL, campus_id INT NOT NULL, INDEX IDX_4E977E5CAF5D55E1 (campus_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_E10AD400FC29C013 FOREIGN KEY (cree_par_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_E10AD400DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5CAF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(100) NOT NULL, ADD nom VARCHAR(100) NOT NULL, ADD prenom VARCHAR(100) NOT NULL, ADD is_verified TINYINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenements DROP FOREIGN KEY FK_E10AD400FC29C013');
        $this->addSql('ALTER TABLE evenements DROP FOREIGN KEY FK_E10AD400DC304035');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5CAF5D55E1');
        $this->addSql('DROP TABLE campus');
        $this->addSql('DROP TABLE evenements');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user DROP username, DROP nom, DROP prenom, DROP is_verified');
    }
}
