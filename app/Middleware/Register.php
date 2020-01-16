<?php


class Register {

    /**
     * Render the sign up page.
     *
     */
    public static function index() {
        $login_page = new View(env('ROOT_PATH').'resources/views/forms/signup.php');
        $login_page->render();
    }

    /**
     * Handle the sign up request sent by the user.
     *
     * @param $request
     */
    public static function sign_up($request) {

    }
}
