<?php

function get_table_name($migration_file) {
    if (preg_match('/create_(.*?)_table/', $migration_file , $match) == 1) {
        echo $match[1];
    }
}

if ($handle = opendir('database/migrations')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {
            echo "[~] Read migration file : " . $entry . "\n";

            echo "[*] Migrating : " . $entry . "\n";
            include_once 'database/migrations/' . $entry;
            echo "\n";
        }
    }

    closedir($handle);
}

echo "[*] End of migrations.";
