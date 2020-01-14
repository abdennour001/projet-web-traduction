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

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down() {
        // TODO: Implement down() method.
        Schema::dropIfExists('piece_jointe');
    }
}

new CreatePieceJointeTable();
