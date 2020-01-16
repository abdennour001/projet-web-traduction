<?php


class HomeController {


    /**
     * Render the home page requested by the user.
     *
     * @throws Exception
     */
    public static function index() {
        // check if there is an authenticated user in the system.

        if (Auth::hasUser()) { // redirect the user to his home page (Client or Traducteur)
            $type = Auth::type();
            if ($type == Client::class) { // Client account, redirect to client home page

            } else if ($type == Traducteur::class) { // Traducteur account, redirect to traducteur home page.

            } else {
                redirect("/login");
            }
        } else { // redirect the user to the login page
            redirect("/login");
        }
    }
}
