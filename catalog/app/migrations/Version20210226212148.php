<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226212148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, stock INT NOT NULL, PRIMARY KEY(id))');
    }

    public function postUp(Schema $schema): void
    {
        $products = [
            ["id" => 1, "name" => "Parou de douche", "description" => "Parou transparente de 100 par 100, double vitrage", "price" => 667.2, "stock" => 10],
            ["id" => 2, "name" => "Vitre de douche", "description" => "Parou transparente de 100 par 100, double vitrage", "price" => 456.2, "stock" => 5],
            ["id" => 3, "name" => "Verre de table", "description" => "Parou transparente de 100 par 100, double vitrage", "price" => 23.9, "stock" => 2],
            ["id" => 4, "name" => "Table de verre", "description" => "Parou transparente de 100 par 100, double vitrage", "price" => 890.2, "stock" => 1],
        ];

        foreach ($products as $product) {
            $this->connection->insert("product", $product);
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP TABLE product');
    }
}
