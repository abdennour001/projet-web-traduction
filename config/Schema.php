<?php

require_once 'database/ConnexionDB.php';

class Schema
{

    private static $conn;

    private static function connect() {
        self::$conn = ConnexionDB::get_connexion();
    }

    private static function disconnect() {
        self::$conn = null;
    }

    public static function create($table_name, $column_map) {
        self::connect();

        try {
            $sql_string = "CREATE TABLE ". $table_name ." (";

            foreach ($column_map as $column => $type) {
                if (!is_numeric($column)) {
                    $sql_string .= $column . ' ' . $type . ', ';
                } else {
                    $sql_string .= ' ' . $type . ', ';
                }
            }

            $sql_string = substr($sql_string, 0, -2);
            $sql_string .= " );";

            self::$conn->exec($sql_string);

            echo "[+] table '". $table_name ."' created successfully." . "\n";
        } catch (PDOException $e) {
            die($sql_string . "\n" . $e->getMessage());
        }

        self::disconnect();
    }

    public static function dropIfExists($table_name) {
        self::connect();

        try {
            $sql_string = "DROP TABLE IF EXISTS ". $table_name . ";";

            self::$conn->exec($sql_string);

            echo "[-] table '". $table_name ."' dropped successfully." . "\n";
        } catch (PDOException $e) {
            die($sql_string . "\n" . $e->getMessage());
        }

        self::disconnect();
    }
}
