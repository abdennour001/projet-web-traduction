<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateTraducteurDevisTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('traducteur_devis', [
            'id_traducteur_devis' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'id_traducteur' => 'INT(6) UNSIGNED NOT NULL',
            'id_devis' => 'INT(6) UNSIGNED NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',

            'FOREIGN KEY (id_traducteur) REFERENCES traducteur(id_traducteur) ON UPDATE CASCADE ON DELETE CASCADE',
            'FOREIGN KEY (id_devis) REFERENCES devis(id_devis) ON UPDATE CASCADE ON DELETE CASCADE',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('traducteur_devis');
    }
}

new CreateTraducteurDevisTable();
