<?php

	$variables = [
		'APP_KEY' => '937a4a8c13e317dfd28effdd479cad2f',
        'ROOT_PATH' => $_SERVER['DOCUMENT_ROOT'] . 'projet/',
		'DB_HOST' => 'localhost',
		'DB_PORT' => '3306',
		'DB_USERNAME' => 'root',
		'DB_PASSWORD' => '',
		'DB_NAME' => 'projet_tdw',
	];

	foreach ($variables as $key => $value) {
		putenv("$key=$value");
	}
