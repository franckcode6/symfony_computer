<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302100328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE computer_component (computer_id INT NOT NULL, component_id INT NOT NULL, INDEX IDX_CB0F8FAA426D518 (computer_id), INDEX IDX_CB0F8FAE2ABAFFF (component_id), PRIMARY KEY(computer_id, component_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE computer_device (computer_id INT NOT NULL, device_id INT NOT NULL, INDEX IDX_D66A2B50A426D518 (computer_id), INDEX IDX_D66A2B5094A4C7D4 (device_id), PRIMARY KEY(computer_id, device_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE computer_component ADD CONSTRAINT FK_CB0F8FAA426D518 FOREIGN KEY (computer_id) REFERENCES computer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE computer_component ADD CONSTRAINT FK_CB0F8FAE2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE computer_device ADD CONSTRAINT FK_D66A2B50A426D518 FOREIGN KEY (computer_id) REFERENCES computer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE computer_device ADD CONSTRAINT FK_D66A2B5094A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE computer_component');
        $this->addSql('DROP TABLE computer_device');
    }
}
