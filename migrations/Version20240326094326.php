<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326094326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE appartements DROP FOREIGN KEY FK_8876962B43327F3C');
        //$this->addSql('ALTER TABLE appartements DROP FOREIGN KEY FK_8876962BE5805157');
        $this->addSql('ALTER TABLE appartements ADD CONSTRAINT FK_8876962B43327F3C FOREIGN KEY (id_loc_id) REFERENCES locataires (id)');
        $this->addSql('ALTER TABLE appartements ADD CONSTRAINT FK_8876962BE5805157 FOREIGN KEY (id_pro_id) REFERENCES proprietaires (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartements DROP FOREIGN KEY FK_8876962BE5805157');
        $this->addSql('ALTER TABLE appartements DROP FOREIGN KEY FK_8876962B43327F3C');
        $this->addSql('ALTER TABLE appartements ADD CONSTRAINT FK_8876962BE5805157 FOREIGN KEY (id_pro_id) REFERENCES proprietaires (id_pro)');
        $this->addSql('ALTER TABLE appartements ADD CONSTRAINT FK_8876962B43327F3C FOREIGN KEY (id_loc_id) REFERENCES locataires (id_loc)');
        $this->addSql('ALTER TABLE locataires MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON locataires');
        $this->addSql('ALTER TABLE locataires CHANGE id id_loc INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE locataires ADD PRIMARY KEY (id_loc)');
        $this->addSql('ALTER TABLE proprietaires MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON proprietaires');
        $this->addSql('ALTER TABLE proprietaires CHANGE id id_pro INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE proprietaires ADD PRIMARY KEY (id_pro)');
    }
}
