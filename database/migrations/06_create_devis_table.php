<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateDevisTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('devis', [
            'id_devis' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'nom' => "VARCHAR(30) NOT NULL",
            'prenom' => "VARCHAR(30) NOT NULL",
            'email' => "VARCHAR(30) NOT NULL",
            'numero' => "VARCHAR(30) NOT NULL",
            'adresse' => "VARCHAR(150) NOT NULL",
            'type_traduction' => "ENUM('general', 'scientifique', 'site-web') NOT NULL",
            'commentaires' => "TEXT NOT NULL",
            'etat' => "ENUM('pas-encore-demarre', 'en-cours', 'finis', 'abandonne') NOT NULL DEFAULT 'pas-encore-demarre'",
            'traducteur_assermente' => "BOOLEAN NOT NULL DEFAULT false",
            'date' => "TIMESTAMP",
            'id_client' => 'INT(6) UNSIGNED NOT NULL',
            'id_document' => 'INT(6) UNSIGNED NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',

            'FOREIGN KEY (id_client) REFERENCES client(id_client) ON UPDATE CASCADE ON DELETE CASCADE',
            'FOREIGN KEY (id_document) REFERENCES document(id_document) ON UPDATE CASCADE ON DELETE CASCADE',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('devis');
    }
}

new CreateDevisTable();
