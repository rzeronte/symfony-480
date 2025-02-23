<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250222023933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE measurement (id UUID NOT NULL, wine_id UUID NOT NULL, sensor_id UUID NOT NULL, year INT NOT NULL, color VARCHAR(255) NOT NULL, temperature VARCHAR(255) NOT NULL, alcohol_content VARCHAR(255) NOT NULL, ph VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CE0D81128A2BD76 ON measurement (wine_id)');
        $this->addSql('CREATE INDEX IDX_2CE0D811A247991F ON measurement (sensor_id)');
        $this->addSql('COMMENT ON COLUMN measurement.id IS \'(DC2Type:UUIDType)\'');
        $this->addSql('COMMENT ON COLUMN measurement.wine_id IS \'(DC2Type:UUIDType)\'');
        $this->addSql('COMMENT ON COLUMN measurement.sensor_id IS \'(DC2Type:UUIDType)\'');
        $this->addSql('COMMENT ON COLUMN measurement.year IS \'(DC2Type:WineYearType)\'');
        $this->addSql('COMMENT ON COLUMN measurement.color IS \'(DC2Type:MeasurementColorType)\'');
        $this->addSql('COMMENT ON COLUMN measurement.temperature IS \'(DC2Type:MeasurementTemperatureType)\'');
        $this->addSql('COMMENT ON COLUMN measurement.alcohol_content IS \'(DC2Type:MeasurementAlcoholContentType)\'');
        $this->addSql('COMMENT ON COLUMN measurement.ph IS \'(DC2Type:MeasurementPhType)\'');
        $this->addSql('CREATE TABLE sensor (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN sensor.id IS \'(DC2Type:UUIDType)\'');
        $this->addSql('COMMENT ON COLUMN sensor.name IS \'(DC2Type:SensorNameType)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:UUIDType)\'');
        $this->addSql('CREATE TABLE wine (id UUID NOT NULL, name VARCHAR(255) NOT NULL, year INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN wine.id IS \'(DC2Type:UUIDType)\'');
        $this->addSql('COMMENT ON COLUMN wine.year IS \'(DC2Type:WineYearType)\'');
        $this->addSql('COMMENT ON COLUMN wine.name IS \'(DC2Type:WineNameType)\'');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D81128A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D811A247991F FOREIGN KEY (sensor_id) REFERENCES sensor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE measurement DROP CONSTRAINT FK_2CE0D81128A2BD76');
        $this->addSql('ALTER TABLE measurement DROP CONSTRAINT FK_2CE0D811A247991F');
        $this->addSql('DROP TABLE measurement');
        $this->addSql('DROP TABLE sensor');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE wine');
    }
}
