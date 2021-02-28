<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227111642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE SEQUENCE media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE media (id INT NOT NULL, product_id INT DEFAULT NULL, src VARCHAR(255) NOT NULL, type VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4584665A ON media (product_id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function postUp(Schema $schema): void
    {
        $medias = [
            ["id" => 1, "src" => "/catalog/img/product1.jpg", "product_id" => 1, "type" => "image/jpg"],
            ["id" => 2, "src" => "/catalog/img/product2.jpg", "product_id" => 2, "type" => "image/jpg"],
            ["id" => 3, "src" => "/catalog/img/product4.jpg", "product_id" => 4, "type" => "image/jpg"],
        ];
        foreach ($medias as $media){
            $this->connection->insert("media", $media);
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE media_id_seq CASCADE');
        $this->addSql('DROP TABLE media');
    }
}
