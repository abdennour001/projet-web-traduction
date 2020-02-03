<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateAdminTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('admin', [
            'id_admin' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'login' => 'VARCHAR(30) NOT NULL',
            'password' => 'CHAR(100) NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down() {
        // TODO: Implement down() method.
        Schema::dropIfExists('admin');
    }
}

new CreateAdminTable();
