<?php


class LoginController {

    /**
     * Render tha login page.
     *
     * @throws Exception
     */
    public static function index() {
        if (Auth::hasUser()) {
            redirect('/');
        } else {
            $login_page = new View('forms/signin.php');
            $login_page->render();
        }
    }

    /**
     * Handle the login attempt by th user.
     *
     * @param $request
     */
    public static function login($request) {
        $email = $request->getBody()['email'];

        $user_array = User::where([
            'email' => $email
        ]);
        if (empty($user_array)) { // no user email with this email.
            redirect("/login", ["error-sign-in" => 'Veuillez vérifier votre adresse email.']);
        } else {
            $user = $user_array[0];
            $password = $request->getBody()['password'];
            $isBlocked = Blocked::where([
                    'id_user' => $user->id_user
                ]);
            if (md5($password) == $user->password) {
                if ($isBlocked == null) {
                    Session::put(['user' => $user]);
                    redirect("/");
                } else {
                    redirect("/login", ["error-sign-in" => "Votre compte a été bloqué, veuillez contacter l'administrateur."]);
                }
            } else { // wrong password
                redirect("/login", ["error-sign-in" => 'Votre mot de passe est incorrect.']);
            }
        }
    }

    /**
     * Handle the logout attempt by the user.
     *
     */
    public static function logout() {
        Session::forget('user');
        redirect('/login');
    }

}
