<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240330192200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6E13A8542');
        $this->addSql('DROP TABLE quality_product');
        $this->addSql('DROP TABLE payment');
        $this->addSql('ALTER TABLE `admin` CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee DROP is_admin');
        $this->addSql('ALTER TABLE `order` ADD employee_id INT DEFAULT NULL, ADD number_order INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_F52993988C03F15C ON `order` (employee_id)');
        $this->addSql('DROP INDEX IDX_2530ADE6E13A8542 ON order_product');
        $this->addSql('ALTER TABLE order_product DROP products_qualities_id, DROP quantity');
        $this->addSql('ALTER TABLE product ADD description VARCHAR(255) DEFAULT NULL, ADD product_img VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quality_product (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE `admin` CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988C03F15C');
        $this->addSql('DROP INDEX IDX_F52993988C03F15C ON `order`');
        $this->addSql('ALTER TABLE `order` DROP employee_id, DROP number_order');
        $this->addSql('ALTER TABLE order_product ADD products_qualities_id INT NOT NULL, ADD quantity SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6E13A8542 FOREIGN KEY (products_qualities_id) REFERENCES quality_product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2530ADE6E13A8542 ON order_product (products_qualities_id)');
        $this->addSql('ALTER TABLE employee ADD is_admin TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE product DROP description, DROP product_img');
    }
}
