<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateTraductionTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('traduction', [
            'id_traduction' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'etat' => "ENUM('pas-encore-demarre', 'en-cours', 'finis', 'abandonne') NOT NULL DEFAULT 'pas-encore-demarre'",
            'date' => "TIMESTAMP",
            'note' => "INT NOT NULL DEFAULT 0",
            'id_devis' => 'INT(6) UNSIGNED NOT NULL',
            'id_document' => 'INT(6) UNSIGNED NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',

            'FOREIGN KEY (id_devis) REFERENCES client(id_devis) ON UPDATE CASCADE ON DELETE CASCADE',
            'FOREIGN KEY (id_document) REFERENCES document(id_document) ON UPDATE CASCADE ON DELETE CASCADE',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('traduction');
    }
}

new CreateTraductionTable();
