<?php

require_once "database/ConnexionDB.php";
require_once "app/Models/User.php";
require_once "app/Models/Langue.php";

class MainController {

    public static function index() {
        var_dump(User::where([
            'nom' => 'Abdennour',
            'OR',
            'numero' => '0123456789',
            'OR',
            'adresse' => 'Batna'
        ]));
    }
}
