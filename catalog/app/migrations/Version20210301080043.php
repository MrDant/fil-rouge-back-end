<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301080043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE media (id INT NOT NULL, product_id INT DEFAULT NULL, src VARCHAR(255) NOT NULL, type VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4584665A ON media (product_id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE product ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
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

        $categories = [
            [ "id" => 1, "name" => "Paroi de douche"],
            ["id" => 2, "name" => "Plan de travail"]
        ];
        foreach ($categories as $category){
            $this->connection->insert("category", $category);
        }

        $this->connection->update("product", ['category_id' => 1], ["id" => 1]);
        $this->connection->update("product", ['category_id' => 2], ["id" => 2]);
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD12469DE2');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE media_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP category_id');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10C4584665A');
        $this->addSql('DROP TABLE media');
    }
}
