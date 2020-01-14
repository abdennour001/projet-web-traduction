<?php

include_once 'config/autoload.php';

class ConnexionDB {

    private static $dbhost; // database host:port
    private static $dbuser; // username
    private static $dbpass; // user password
    private static $dbname; // database name
    private static $conn; // connexion handler

    /**
     * Connect to the mysql server, if the connexion has established, then we just return the connexion handler.
     *
     *
     * @return PDO
     */
    public static function get_connexion() {

        self::$dbhost = env('DB_HOST', '') . ":" . env('DB_PORT');
        self::$dbuser = env('DB_USERNAME');
        self::$dbpass = env('DB_PASSWORD');
        self::$dbname = env('DB_NAME');


        try {
            self::$conn = new PDO("mysql:host=".self::$dbhost.";dbname=".self::$dbname, self::$dbuser, self::$dbpass);
            // set the PDO error mode to exception
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die ("Connection failed: " . $e->getMessage());
        }

        return self::$conn;
    }

    /**
     * Close the established connexion
     *
     */
    public static function close_connexion() {
        self::$conn = null;
    }

}
