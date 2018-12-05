<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128133329 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', brand_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', color VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, INDEX IDX_773DE69D44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_seat (car_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', seat_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_F63622CAC3C6F69F (car_id), INDEX IDX_F63622CAC1DAFE35 (seat_id), PRIMARY KEY(car_id, seat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seat (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE car_seat ADD CONSTRAINT FK_F63622CAC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_seat ADD CONSTRAINT FK_F63622CAC1DAFE35 FOREIGN KEY (seat_id) REFERENCES seat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car_seat DROP FOREIGN KEY FK_F63622CAC3C6F69F');
        $this->addSql('ALTER TABLE car_seat DROP FOREIGN KEY FK_F63622CAC1DAFE35');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE car_seat');
        $this->addSql('DROP TABLE seat');
    }
}
