<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateTraducteurTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('traducteur', [
            'id_traducteur' => 'INT(6) UNSIGNED PRIMARY KEY',
            'est_assermente' => "BOOLEAN NOT NULL DEFAULT false",
            'est_approuve' => "BOOLEAN NOT NULL DEFAULT false",
            'note' => "SMALLINT UNSIGNED DEFAULT 0",

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('traducteur');
    }
}

new CreateTraducteurTable();
