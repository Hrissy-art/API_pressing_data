<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240310105018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_product_material (order_product_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_D5180B1EF65E9B0F (order_product_id), INDEX IDX_D5180B1EE308AC6F (material_id), PRIMARY KEY(order_product_id, material_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product_service (order_product_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_FB4D423EF65E9B0F (order_product_id), INDEX IDX_FB4D423EED5CA9E6 (service_id), PRIMARY KEY(order_product_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_product_material ADD CONSTRAINT FK_D5180B1EF65E9B0F FOREIGN KEY (order_product_id) REFERENCES order_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product_material ADD CONSTRAINT FK_D5180B1EE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product_service ADD CONSTRAINT FK_FB4D423EF65E9B0F FOREIGN KEY (order_product_id) REFERENCES order_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product_service ADD CONSTRAINT FK_FB4D423EED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD status_order_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981045CAE0 FOREIGN KEY (status_order_id) REFERENCES status_order (id)');
        $this->addSql('CREATE INDEX IDX_F52993981045CAE0 ON `order` (status_order_id)');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE63A9FC940');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6976B7D37');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6AEF5A6C1');
        $this->addSql('DROP INDEX IDX_2530ADE63A9FC940 ON order_product');
        $this->addSql('DROP INDEX IDX_2530ADE6976B7D37 ON order_product');
        $this->addSql('DROP INDEX IDX_2530ADE6AEF5A6C1 ON order_product');
        $this->addSql('ALTER TABLE order_product DROP materials_id, DROP statuses_orders_id, DROP services_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product_material DROP FOREIGN KEY FK_D5180B1EF65E9B0F');
        $this->addSql('ALTER TABLE order_product_material DROP FOREIGN KEY FK_D5180B1EE308AC6F');
        $this->addSql('ALTER TABLE order_product_service DROP FOREIGN KEY FK_FB4D423EF65E9B0F');
        $this->addSql('ALTER TABLE order_product_service DROP FOREIGN KEY FK_FB4D423EED5CA9E6');
        $this->addSql('DROP TABLE order_product_material');
        $this->addSql('DROP TABLE order_product_service');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981045CAE0');
        $this->addSql('DROP INDEX IDX_F52993981045CAE0 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP status_order_id');
        $this->addSql('ALTER TABLE order_product ADD materials_id INT NOT NULL, ADD statuses_orders_id INT NOT NULL, ADD services_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE63A9FC940 FOREIGN KEY (materials_id) REFERENCES material (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6976B7D37 FOREIGN KEY (statuses_orders_id) REFERENCES status_order (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6AEF5A6C1 FOREIGN KEY (services_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2530ADE63A9FC940 ON order_product (materials_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6976B7D37 ON order_product (statuses_orders_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6AEF5A6C1 ON order_product (services_id)');
    }
}
