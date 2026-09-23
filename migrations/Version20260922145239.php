<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260922145239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY `FK_717E22E3DDEAB1A3`');
        $this->addSql('ALTER TABLE membre_bde DROP FOREIGN KEY `FK_75ECA4C297BD50D5`');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE membre_bde');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD promotion VARCHAR(100) DEFAULT NULL, ADD role VARCHAR(100) DEFAULT NULL, DROP name, DROP username, DROP date_creation, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, classe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, etudiant_id INT NOT NULL, UNIQUE INDEX UNIQ_717E22E3DDEAB1A3 (etudiant_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE membre_bde (id INT AUTO_INCREMENT NOT NULL, membre_bde_id INT NOT NULL, UNIQUE INDEX UNIQ_75ECA4C297BD50D5 (membre_bde_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT `FK_717E22E3DDEAB1A3` FOREIGN KEY (etudiant_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE membre_bde ADD CONSTRAINT `FK_75ECA4C297BD50D5` FOREIGN KEY (membre_bde_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL, ADD date_creation VARCHAR(255) NOT NULL, DROP roles, DROP promotion, DROP role, CHANGE email email VARCHAR(255) NOT NULL, CHANGE type name VARCHAR(255) NOT NULL');
    }
}
