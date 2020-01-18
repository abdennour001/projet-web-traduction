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
                $client_page = new View('home-client.php');
                $client_page->render();
            } else if ($type == Traducteur::class) { // Traducteur account, redirect to traducteur home page.
                $traducteur_page = new View('home-traducteur.php');
                $traducteur_page->render();
            } else {
                redirect("/login");
            }
        } else { // redirect the user to the login page
            redirect("/login");
        }
    }

    /**
     * Render the about view.
     */
    public static function about() {
        $about_page = new View('about.php');
        $about_page->render();
    }
}
