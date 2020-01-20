<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateDemandeTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('demande', [
            'id_demande' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'date' => 'TIMESTAMP',
            'etat' => 'BOOLEAN NOT NULL DEFAULT false',
            'id_traducteur' => 'INT(6) UNSIGNED NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',

            'FOREIGN KEY (id_traducteur) REFERENCES traducteur(id_traducteur) ON UPDATE CASCADE ON DELETE CASCADE',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('demande');
    }
}

new CreateDemandeTable();
