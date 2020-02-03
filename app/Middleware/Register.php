<?php


class Register {

    /**
     * Render the sign up page.
     *
     */
    public static function index() {
        if (Auth::hasUser()) {
            redirect('/');
        } else {
            $login_page = new View('forms/signup.php');
            $login_page->render();
        }
    }

    /**
     * Handle the sign up request sent by the user.
     *
     * @param $request
     */
    public static function sign_up($request) {
        $email = $request->getBody()['email'];

        $user_array = User::where([
            'email' => $email
        ]);
        if (empty($user_array)) { // good to go
            $user = new User();
            $user->nom = $request->getBody()['nom'];
            $user->prenom = $request->getBody()['prenom'];
            $user->email = $request->getBody()['email'];
            $user->password = md5($request->getBody()['password']);
            $user->numero = $request->getBody()['numero'];
            $user->fax = $request->getBody()['fax'];
            $user->wilaya = $request->getBody()['wilaya'];
            $user->commune = $request->getBody()['commune'];
            $user->adresse = $request->getBody()['adresse'];
            $user->save();

            $saved_user =  User::where([
                'email' => $user->email
            ])[0];

            $type = $request->getBody()['type'];


            $notification = new Notification();
            $notification->id_user = $saved_user->id_user;
            $notification->vu = 0;
            $notification->title = "Félicitations, Inscription terminée!";
            $notification->description = "Félicitations, vous êtes un nouveau membre avec nous.";
            $notification->save();


            if ($type == 'Client') { // create new Client
                $client = new Client();
                $client->id_client = $saved_user->id_user;
                $client->save();

                // connect to this account.
                Session::put(['user' => $saved_user]);
                // redirect to client home page.
                redirect("/", ["new-user-info" => "Bienvenue sur notre site Web, profitez de nos services maintenant!"]);
            } else { // create new Traducteur
                $traducteur = new Traducteur();
                $traducteur->id_traducteur = $saved_user->id_user;
                $traducteur->est_assermente = 0;
                $traducteur->est_approuve = 0;
                $traducteur->save();


                // connect to this account.
                Session::put(['user' => $saved_user]);
                // redirect to traducteur home page.
                redirect("/", ["new-user-info" => "Bienvenue sur notre site Web, profitez de nos services maintenant!",
                    "new-traducteur-info" => "Vous pouvez envoyer une demande de recrutement pour commencer à travailler avec nous en tant que traducteur."]);
            }

        } else { // another user has the same email, redirect to sign-up page.
            redirect("/sign-up", array_merge(["error-sign-up" => "Cet e-mail existe déjà, veuillez le modifier."],
                $request->getBody()));
        }
    }
}
