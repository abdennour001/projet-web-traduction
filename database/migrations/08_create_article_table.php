<?php

require_once 'config/Migration.php';
require_once 'config/Schema.php';

class CreateArticleTable extends Migration {

    public function __construct() {
        $this->down();
        $this->up();
    }

    public function up()
    {
        // TODO: Implement up() method.
        Schema::create('article', [
            'id_article' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'titre' => 'VARCHAR(100) NOT NULL',
            'corps' => 'LONGTEXT NOT NULL',
            'image_path' => 'VARCHAR(150) NOT NULL',

            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ]);
    }

    public function down()
    {
        // TODO: Implement down() method.
        Schema::dropIfExists('article');
    }
}

new CreateArticleTable();
