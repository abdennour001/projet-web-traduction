<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateClientTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('client', [
            'id_client' => 'INT(6) UNSIGNED PRIMARY KEY',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('client');
    }
}

new CreateClientTable();
