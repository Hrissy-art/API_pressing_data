<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240106125904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_product (id INT AUTO_INCREMENT NOT NULL, products_id INT DEFAULT NULL, orders_id INT DEFAULT NULL, materials_id INT NOT NULL, products_qualities_id INT NOT NULL, statuses_orders_id INT NOT NULL, services_id INT NOT NULL, quantity SMALLINT NOT NULL, INDEX IDX_2530ADE66C8A81A9 (products_id), INDEX IDX_2530ADE6CFFE9AD6 (orders_id), INDEX IDX_2530ADE63A9FC940 (materials_id), INDEX IDX_2530ADE6E13A8542 (products_qualities_id), INDEX IDX_2530ADE6976B7D37 (statuses_orders_id), INDEX IDX_2530ADE6AEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE66C8A81A9 FOREIGN KEY (products_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE63A9FC940 FOREIGN KEY (materials_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6E13A8542 FOREIGN KEY (products_qualities_id) REFERENCES quality_product (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6976B7D37 FOREIGN KEY (statuses_orders_id) REFERENCES status_order (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6AEF5A6C1 FOREIGN KEY (services_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE `order` ADD client_id INT NOT NULL, ADD date_order DATETIME DEFAULT NULL, ADD date_render DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_F529939819EB6921 ON `order` (client_id)');
        $this->addSql('ALTER TABLE quality_product ADD status_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD name VARCHAR(255) NOT NULL, ADD coeff DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE status_order ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD birthday DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE66C8A81A9');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6CFFE9AD6');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE63A9FC940');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6E13A8542');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6976B7D37');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6AEF5A6C1');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939819EB6921');
        $this->addSql('DROP INDEX IDX_F529939819EB6921 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP client_id, DROP date_order, DROP date_render');
        $this->addSql('ALTER TABLE quality_product DROP status_name');
        $this->addSql('ALTER TABLE service DROP name, DROP coeff');
        $this->addSql('ALTER TABLE status_order DROP status');
        $this->addSql('ALTER TABLE user DROP first_name, DROP last_name, DROP adress, DROP birthday');
    }
}
