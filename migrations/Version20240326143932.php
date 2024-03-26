<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326143932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartements DROP FOREIGN KEY FK_8876962BE5805157');
        $this->addSql('ALTER TABLE appartements ADD CONSTRAINT FK_8876962BE5805157 FOREIGN KEY (id_pro_id) REFERENCES proprietaires (id)');
        $this->addSql('ALTER TABLE proprietaires DROP FOREIGN KEY FK_74D75B7311C087F0');
        $this->addSql('ALTER TABLE proprietaires ADD CONSTRAINT FK_74D75B7311C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE utilisateurs DROP dateinscription');
        $this->addSql('ALTER TABLE visiter ADD id_pro_id INT NOT NULL, ADD id_dem_id INT NOT NULL, ADD numappart_id INT NOT NULL, DROP id_pro, DROP numappart, DROP id_dem');
        $this->addSql('ALTER TABLE visiter ADD CONSTRAINT FK_300A0915E5805157 FOREIGN KEY (id_pro_id) REFERENCES proprietaires (id)');
        $this->addSql('ALTER TABLE visiter ADD CONSTRAINT FK_300A091550E92C3 FOREIGN KEY (id_dem_id) REFERENCES locataires (id)');
        $this->addSql('ALTER TABLE visiter ADD CONSTRAINT FK_300A0915271D98ED FOREIGN KEY (numappart_id) REFERENCES appartements (id)');
        $this->addSql('CREATE INDEX IDX_300A0915E5805157 ON visiter (id_pro_id)');
        $this->addSql('CREATE INDEX IDX_300A091550E92C3 ON visiter (id_dem_id)');
        $this->addSql('CREATE INDEX IDX_300A0915271D98ED ON visiter (numappart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartements DROP FOREIGN KEY FK_8876962BE5805157');
        $this->addSql('ALTER TABLE appartements ADD CONSTRAINT FK_8876962BE5805157 FOREIGN KEY (id_pro_id) REFERENCES proprietaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proprietaires DROP FOREIGN KEY FK_74D75B7311C087F0');
        $this->addSql('ALTER TABLE proprietaires ADD CONSTRAINT FK_74D75B7311C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateurs ADD dateinscription DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE visiter DROP FOREIGN KEY FK_300A0915E5805157');
        $this->addSql('ALTER TABLE visiter DROP FOREIGN KEY FK_300A091550E92C3');
        $this->addSql('ALTER TABLE visiter DROP FOREIGN KEY FK_300A0915271D98ED');
        $this->addSql('DROP INDEX IDX_300A0915E5805157 ON visiter');
        $this->addSql('DROP INDEX IDX_300A091550E92C3 ON visiter');
        $this->addSql('DROP INDEX IDX_300A0915271D98ED ON visiter');
        $this->addSql('ALTER TABLE visiter ADD id_pro INT NOT NULL, ADD numappart INT NOT NULL, ADD id_dem INT NOT NULL, DROP id_pro_id, DROP id_dem_id, DROP numappart_id');
    }
}
