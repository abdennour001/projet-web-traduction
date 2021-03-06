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
            'id_document' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'path' => "VARCHAR(150) NOT NULL",
            'date' => 'TIMESTAMP',
            'id_devis' => 'INT(6) UNSIGNED NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',

            'FOREIGN KEY (id_devis) REFERENCES devis(id_devis) ON UPDATE CASCADE ON DELETE CASCADE',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('document');
    }
}

new CreateDocumentTable();
