<?php


class AdminController {

    /**
     * Render the admin home page.
     *
     */
    public static function index() {
        if (!Auth::hasAdmin()) {
            $admin_login = new View('forms/admin/signin-admin.php');
            $admin_login->render();
        } else {
            redirect("/admin/gestion-traducteurs");
        }
    }

    /*
     * Render the admin login view.
     */
    public static function indexLogin() {
        if (!Auth::hasAdmin()) {
            $admin_login = new View('forms/admin/signin-admin.php');
            $admin_login->render();
        } else {
            redirect("/admin");
        }
    }

    /**
     * Handle the login attempt by th admin.
     *
     * @param $request
     */
    public static function login($request) {
        $username = $request->getBody()['username'];

        $admin_array = Admin::where([
            'login' => $username
        ]);
        if (empty($admin_array)) { // no user with this email.
            redirect("/admin/login", ["error-sign-in-admin" => 'Veuillez vérifier votre login.']);
        } else {
            $admin = $admin_array[0];
            $password = $request->getBody()['password'];
            if (md5($password) == $admin->password) {
                Session::put(['admin' => $admin]);
                redirect("/admin/");
            } else { // wrong password
                redirect("/admin/login", array_merge(["error-sign-in-admin" => 'Votre mot de passe est incorrect.'],
                    $request->getBody()));
            }
        }
    }

    /**
     * Handle the logout attempt by the admin.
     *
     */
    public static function logout() {
        Session::forget('admin');
        redirect('/admin/login');
    }


    /**
     * Render the translators page.
     */
    public static function translators() {
        if (Auth::hasAdmin()) {
            $translators = Traducteur::all();
            $admin_gt = new View("admin/gestion-traducteurs.php", ["list_traducteurs" => $translators]);
            $admin_gt->render();
        } else {
            redirect("/admin/login");
        }
    }

    /**
     * Render the clients page.
     */
    public static function clients() {
        if (Auth::hasAdmin()) {
            $clients = Client::all();
            $admin_gc = new View("admin/gestion-clients.php", ["list_clients" => $clients]);
            $admin_gc->render();
        } else {
            redirect("/admin/login");
        }
    }

    /**
     * Render the documents page.
     */
    public static function documents() {
        if (Auth::hasAdmin()) {
            $list = Document::all();
            $admin_gd = new View("admin/gestion-documents.php", ['list_documents' => $list]);
            $admin_gd->render();
        } else {
            redirect("/admin/login");
        }
    }

    /**
     * Render the statistics page.
     */
    public static function statistics() {
        if (Auth::hasAdmin()) {
            $admin_st = new View("admin/statistics.php");
            $admin_st->render();
        } else {
            redirect("/admin/login");
        }
    }

    /**
     * Render the devis page.
     */
    public static function devis() {
        if (Auth::hasAdmin()) {
            $devis = Devis::all();
            $admin_st = new View("admin/devis.php", ['list_devis' => $devis]);
            $admin_st->render();
        } else {
            redirect("/admin/login");
        }
    }

    /**
     * @throws Exception
     */
    public static function traductions() {
        if (Auth::hasAdmin()) {
            $traductions = Traduction::all();
            $admin_st = new View("admin/gestion-traductions.php", ['list_traductions' => $traductions]);
            $admin_st->render();
        } else {
            redirect("/admin/login");
        }
    }

    /**
     * Approve a translator.
     *
     * @param $request
     */
    public static function approve($request) {
        $id = $request->getBody()['id_traducteur'];
        $translator = Traducteur::find($id);
        $translator->est_approuve = 1;
        $translator->update();

        $notification = new Notification();
        $notification->id_user = $id;
        $notification->vu = 0;
        $notification->title = "Félicitations!";
        $notification->description = "Félicitations, votre demande a été approuvée.";
        $notification->save();

        $demande = $translator->demande();
        $demande->delete();

        redirect("/admin/gestion-traducteurs", ["controller-msg" => "Vous avez approuvé {$translator->user()->nom} {$translator->user()->prenom}."]);
    }

    /**
     * Disapprove a translator.
     *
     * @param $request
     */
    public static function disapprove($request) {

    }


    /**
     * Block the user.
     *
     * @param $request
     */
    public static function block($request) {
        $body = $request->getBody();
        $user = User::find($body['id_user']);
        $url = $body['url'];

        if (Blocked::where([
            "id_user" => $user->id_user
        ]) == null) {
            $block = new Blocked();
            $block->id_user = $body['id_user'];
            $block->save();
        }

        redirect("/admin/" . $url, ["controller-msg" => "Vous avez bloqué {$user->nom} {$user->prenom}."]);
    }

    /**
     * Unblock the user.
     *
     * @param $request
     */
    public static function unblock($request) {
        $body = $request->getBody();
        $user = User::find($body['id_user']);
        $url = $body['url'];

        $block =  Blocked::where([
            'id_user' => $user->id_user,
        ]);

        if ($block != null) $block[0]->delete();

        redirect("/admin/" . $url, ["controller-msg" => "Vous avez débloqué {$user->nom} {$user->prenom}."]);
    }

    public static function deleteDocument($request) {

        $body = $request->getBody();

        $document = Document::find($body['id_document']);
        if ($document->id_devis == 0) { // document destination
            $traduction = $document->traduction();
            $devis = $traduction->devis();

            if ($traduction != null) $traduction->delete();
            if ($devis != null) {
                $devis->delete();
                unlink_file($devis->document()->path);
            }

        } else { // document source
            $devis = $document->devis();
            $traduction = $devis->traduction();
            $devis->delete();
            unlink_file($devis->document()->path);
            if ($traduction != null) $traduction->delete();
        }

        // delete the source file.
        unlink_file($document->path);

        $document->delete();

        redirect('/admin/gestion-documents', ["controller-msg" => "Vous avez supprimé le document #". $document->id_traduction ."."]);
    }
}
