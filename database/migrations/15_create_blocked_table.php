<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateBlockedTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('blocked', [
            'id_blocked' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'id_user' => "INT(6) UNSIGNED NOT NULL",

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('blocked');
    }
}

new CreateBlockedTable();
