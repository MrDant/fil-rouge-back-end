<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307125113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE media_id_seq CASCADE');
        $this->addSql('DROP TABLE media');
        $this->addSql('ALTER TABLE product ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function postUp(Schema $schema): void
    {
        $images = [
            ["id" => 1, "src" => '/catalog/img/product1.jpg'],
            ["id" => 2, "src" => '/catalog/img/product2.jpg'],
            ["id" => 3, "src" => '/catalog/img/product4.jpg'],
        ];
        foreach ($images as $image) {
            $this->connection->update('product', ['image' => $image['src']], ['id' => $image['id']]);
        }

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('CREATE SEQUENCE media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE media (id INT NOT NULL, product_id INT DEFAULT NULL, src VARCHAR(255) NOT NULL, type VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_6a2ca10c4584665a ON media (product_id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT fk_6a2ca10c4584665a FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product DROP image');
        $this->addSql('ALTER TABLE category DROP image');
    }
}
