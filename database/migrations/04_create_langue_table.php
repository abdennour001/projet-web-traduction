<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateLangueTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('langue', [
            'id_langue' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'nom' => 'VARCHAR(30) NOT NULL',
            'description' => 'TEXT',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('langue');
    }
}

new CreateLangueTable();
