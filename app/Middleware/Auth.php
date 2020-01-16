<?php

require_once 'config/Session.php';
require_once 'app/Models/Client.php';
require_once 'app/Models/Traducteur.php';
require_once 'app/Models/User.php';

class Auth {

    public static function user() {
        if (Session::isLive()) {
            return Session::get('user');
        }
        return null;
    }

    public static function id() {
        return Session::get('user')->id_user;
    }

    public static function hasUser() {
        return Session::has('user');
    }

    public static function type() {
        if (Session::isLive() && Session::has('user')) {
            $user = self::user();
            $client_bool = $user->client();

            return $client_bool ? Client::class : Traducteur::class;
        }
        return null;
    }

}
