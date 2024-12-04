<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204093131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_tag DROP FOREIGN KEY FK_91F26D6091F26D60');
        $this->addSql('DROP INDEX IDX_91F26D6091F26D60 ON project_tag');
        $this->addSql('DROP INDEX `primary` ON project_tag');
        $this->addSql('ALTER TABLE project_tag CHANGE project_tag project_id INT NOT NULL');
        $this->addSql('ALTER TABLE project_tag ADD CONSTRAINT FK_91F26D60166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_91F26D60166D1F9C ON project_tag (project_id)');
        $this->addSql('ALTER TABLE project_tag ADD PRIMARY KEY (project_id, tag_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_tag DROP FOREIGN KEY FK_91F26D60166D1F9C');
        $this->addSql('DROP INDEX IDX_91F26D60166D1F9C ON project_tag');
        $this->addSql('DROP INDEX `PRIMARY` ON project_tag');
        $this->addSql('ALTER TABLE project_tag CHANGE project_id project_tag INT NOT NULL');
        $this->addSql('ALTER TABLE project_tag ADD CONSTRAINT FK_91F26D6091F26D60 FOREIGN KEY (project_tag) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_91F26D6091F26D60 ON project_tag (project_tag)');
        $this->addSql('ALTER TABLE project_tag ADD PRIMARY KEY (project_tag, tag_id)');
    }
}
