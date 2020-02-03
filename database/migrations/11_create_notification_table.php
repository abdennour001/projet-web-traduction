<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateNotificationTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('notification', [
            'id_notification' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'title' => 'VARCHAR(300) NOT NULL',
            'description' => 'TEXT',
            'vu' => "BOOLEAN NOT NULL DEFAULT false",
            'type' => "ENUM('devis', 'demande-traduction', 'autre') NOT NULL DEFAULT 'autre'",
            'id_user' => 'INT(6) UNSIGNED NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',

            'FOREIGN KEY (id_user) REFERENCES user(id_user) ON UPDATE CASCADE ON DELETE CASCADE',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('notification');
    }
}

new CreateNotificationTable();
