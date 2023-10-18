<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018074542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, usuarios_id INTEGER DEFAULT NULL, nombre VARCHAR(32) NOT NULL, apellido_paterno VARCHAR(16) NOT NULL, apellido_materno VARCHAR(16) NOT NULL, dni INTEGER NOT NULL, CONSTRAINT FK_1435D52DF01D3B25 FOREIGN KEY (usuarios_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1435D52DF01D3B25 ON alumno (usuarios_id)');
        $this->addSql('CREATE TABLE curso (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(32) NOT NULL, creditos INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE matricula (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, alumno_id_alumno_id INTEGER DEFAULT NULL, curso_id_curso_id INTEGER DEFAULT NULL, CONSTRAINT FK_15DF1885617394DB FOREIGN KEY (alumno_id_alumno_id) REFERENCES alumno (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_15DF1885AF80B3EB FOREIGN KEY (curso_id_curso_id) REFERENCES curso (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_15DF1885617394DB ON matricula (alumno_id_alumno_id)');
        $this->addSql('CREATE INDEX IDX_15DF1885AF80B3EB ON matricula (curso_id_curso_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE alumno');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE matricula');
        $this->addSql('DROP TABLE user');
    }
}
