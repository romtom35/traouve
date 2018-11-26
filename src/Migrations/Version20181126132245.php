<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181126132245 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment CHANGE user_id user_id BIGINT DEFAULT NULL, CHANGE traobject_id traobject_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE message CHANGE user_form user_form BIGINT DEFAULT NULL, CHANGE user_to user_to BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE traobject CHANGE category_id category_id BIGINT DEFAULT NULL, CHANGE state_id state_id BIGINT DEFAULT NULL, CHANGE user_id user_id BIGINT DEFAULT NULL, CHANGE county_id county_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment CHANGE traobject_id traobject_id BIGINT NOT NULL, CHANGE user_id user_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE user_form user_form BIGINT NOT NULL, CHANGE user_to user_to BIGINT NOT NULL');
        $this->addSql('ALTER TABLE traobject CHANGE category_id category_id BIGINT NOT NULL, CHANGE county_id county_id BIGINT NOT NULL, CHANGE state_id state_id BIGINT NOT NULL, CHANGE user_id user_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE user DROP roles');
    }
}
