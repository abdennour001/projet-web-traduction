<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateDocumentTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('document', [
            'id_document' => 'INT(6) UNSIGNED PRIMARY KEY',
            'path' => "VARCHAR(150) NOT NULL",
            'date' => 'TIMESTAMP',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('document');
    }
}

new CreateDocumentTable();
