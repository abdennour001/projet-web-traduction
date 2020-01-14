<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateUserTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('user', [
            'id_user' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'nom' => 'VARCHAR(30) NOT NULL',
            'prenom' => 'VARCHAR(30) NOT NULL',
            'email' => 'VARCHAR(30) NOT NULL',
            'numero' => 'VARCHAR(30) NOT NULL',
            'adresse' => 'VARCHAR(150) NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('user');
    }
}

new CreateUserTable();
