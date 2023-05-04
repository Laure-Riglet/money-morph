<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501201950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currency (id VARCHAR(3) NOT NULL, name VARCHAR(64) NOT NULL, symbol VARCHAR(2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id VARCHAR(14) NOT NULL, base_currency_id VARCHAR(3) NOT NULL, into_currency_id VARCHAR(3) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', value DOUBLE PRECISION NOT NULL, INDEX IDX_DFEC3F393101778E (base_currency_id), INDEX IDX_DFEC3F3960C05348 (into_currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F393101778E FOREIGN KEY (base_currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F3960C05348 FOREIGN KEY (into_currency_id) REFERENCES currency (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F393101778E');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F3960C05348');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE rate');
    }
}
