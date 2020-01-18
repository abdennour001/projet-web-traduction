<?php


class Session {

    /**
     * Session constructor.
     */
    public function __construct() {
        session_write_close();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Start a new session.
     */
    public static function start() {
        new static;
    }

    /**
     * Close last session.
     */
    public static function abort() {
        session_unset();
        session_destroy();
    }

    /**
     * Check if a session is started or not.
     *
     * @return bool
     */
    public static function isLive() {
        return !(session_status() == PHP_SESSION_NONE);
    }

    /**
     * Put variables into the session $_SESSION array.
     * @param $keys
     */
    public static function put($keys) {
        if (isset($_SESSION)) {
            foreach ($keys as $k => $v) {
                $_SESSION[$k] = $v;
            }
        }
    }

    /**
     * fetch variables from the session $_SESSION array.
     *
     * @param $key
     * @return mixed|null
     */
    public static function get($key) {
        if (isset($_SESSION) && isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * Check if a $key is set on the $_SESSION array.
     *
     * @param $key
     * @return bool|null
     */
    public static function has($key) {
        if (isset($_SESSION)) {
            return array_key_exists($key, $_SESSION);
        }
        return null;
    }

    /**
     * Delete the $key from the $_SESSION array.
     *
     * @param $key
     */
    public static function forget($key) {
        if (isset($_SESSION)) {
            if (array_key_exists($key, $_SESSION)) {
                unset($_SESSION[$key]);
            }
        }
    }

}
