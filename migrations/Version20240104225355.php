<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104225355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE district ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C15487F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_31C15487F92F3E70 ON district (country_id)');
        $this->addSql('ALTER TABLE town ADD district_id INT NOT NULL');
        $this->addSql('ALTER TABLE town ADD CONSTRAINT FK_4CE6C7A4B08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
        $this->addSql('CREATE INDEX IDX_4CE6C7A4B08FA272 ON town (district_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE district DROP FOREIGN KEY FK_31C15487F92F3E70');
        $this->addSql('DROP INDEX IDX_31C15487F92F3E70 ON district');
        $this->addSql('ALTER TABLE district DROP country_id');
        $this->addSql('ALTER TABLE town DROP FOREIGN KEY FK_4CE6C7A4B08FA272');
        $this->addSql('DROP INDEX IDX_4CE6C7A4B08FA272 ON town');
        $this->addSql('ALTER TABLE town DROP district_id');
    }
}
