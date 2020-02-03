<?php


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

    // section admin
    public static function admin() {
        if (Session::isLive()) {
            return Session::get('admin');
        }
        return null;
    }

    public static function hasAdmin() {
        return Session::has('admin');
    }

}
