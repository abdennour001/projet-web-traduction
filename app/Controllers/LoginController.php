<?php


class LoginController {

    /**
     * Render tha login page.
     *
     * @throws Exception
     */
    public static function index() {
        $login_page = new View(env('ROOT_PATH').'resources/views/forms/signin.php');
        $login_page->render();
    }

    /**
     * Handle the login attempt by th user.
     *
     * @param $request
     */
    public static function login($request) {

    }

    /**
     * Handle the logout attempt by the user.
     *
     */
    public static function logout() {

    }

}
