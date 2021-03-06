<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreatePieceJointeTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up() {
        // TODO: Implement up() method.
        Schema::create('piece_jointe', [
            'id_piece_jointe' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'type' => "ENUM('cv', 'reference', 'assermentation') NOT NULL",
            'path' => "VARCHAR(150) NOT NULL",
            'description' => "TEXT",
            'id_traducteur' => 'INT(6) UNSIGNED NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',

            'FOREIGN KEY (id_traducteur) REFERENCES traducteur(id_traducteur) ON UPDATE CASCADE ON DELETE CASCADE',
        ]);
    }

    public function down() {
        // TODO: Implement down() method.
        Schema::dropIfExists('piece_jointe');
    }
}

new CreatePieceJointeTable();
