<?php


class TraducteursController {

    /**
     *  Render the recruitment view.
     *
     */
    public static function index() {
        if (Auth::hasUser() && Auth::type() == Traducteur::class) {
            $recruitment_page = new View('forms/recruitment.php');
            $recruitment_page->render();
        } else {
            redirect('/');
        }
    }

    /**
     *
     */
    public static function index_our_translations() {
        $translations_page = new View('our-translations.php');
        $translations_page->render();
    }

    /**
     *
     */
    public static function index_our_translators() {
        $translators_page = new View('our-translators.php');
        $translators_page->render();
    }

    /**
     * Render the traducteur profile page.
     */
    public static function profile() {
        $t_profile_page = new View('profile/profile-traducteur.php');
        $t_profile_page->render();
    }

    /**
     *  Render the edit profile page.
     */
    public static function editProfile() {
        $t_edit_profile_page = new View('profile/edit-profile-traducteur.php');
        $t_edit_profile_page->render();
    }

    /**
     * Handle the edit post request.
     *
     * @param $request
     */
    public static function editingProfile($request) {
        $user = Auth::user();

        $user->nom = $request->getBody()['nom'];
        $user->prenom = $request->getBody()['prenom'];
        $user->email = $request->getBody()['email'];
        $user->numero = $request->getBody()['numero'];
        $user->fax = $request->getBody()['fax'];
        $user->wilaya = $request->getBody()['wilaya'];
        $user->commune = $request->getBody()['commune'];
        $user->adresse = $request->getBody()['adresse'];
        $user->update();

        redirect("/", ["new-user-info" => "Votre profile a été modifier avec succès!"]);

    }

    /**
     * Handle the recruitment post request.
     *
     * @param $request
     */
    public static function recruitment($request) {
        $body = $request->getBody();

        $cv = $body['cv'];

        // cv piece
        $cv_piece = new PieceJointe();
        $cv_piece->type = "cv";

        if (PieceJointe::all($order_by = 'DESC') != null) {
            $last_id_cv = PieceJointe::all($order_by = 'DESC')[0]->id_piece_jointe;
        } else {
            $last_id_cv = 0;
        }

        $path = "CVs/document-cv-" . ($last_id_cv+1) . "-" . $cv['name'];
        $cv_piece->path = upload_file($cv, $path);
        $cv_piece->id_traducteur = Auth::id();
        $cv_piece->save();

        if (isset($body['ass'])) {
            $ass = $body['ass'];
            // ass piece
            $ass_piece = new PieceJointe();
            $ass_piece->type = "assermentation";
            $last_id = PieceJointe::all($order_by = 'DESC')[0]->id_piece_jointe;

            $path = "assermentations/document-assermentation-" . ($last_id+1) . "-" . $ass['name'];
            $ass_piece->path = upload_file($ass, $path);
            $ass_piece->id_traducteur = Auth::id();
            $ass_piece->save();
        }


        $ref_array = $body['ref']['name'];

        if (sizeof($ref_array) != 0) {
            // ref piece
            for ($i=0; $i<sizeof($ref_array); $i++) {
                $ref['name'] = $body['ref']['name'][$i];
                $ref['tmp_name'] = $body['ref']['tmp_name'][$i];
                $ref_piece = new PieceJointe();
                $ref_piece->type = "reference";

                $last_id_ref = PieceJointe::all($order_by = 'DESC')[0]->id_piece_jointe;

                $path = "refs/document-ref-" . ($last_id_ref+1) . "-" . $ref['name'];
                $ref_piece->path = upload_file($ref, $path);
                $ref_piece->id_traducteur = Auth::id();
                $ref_piece->save();
            }
        }

        $demande = new Demande();
        $timestamp = date('Y-m-d H:i:s');
        $demande->date = $timestamp;
        $demande->etat = 0;
        $demande->id_traducteur = Auth::id();
        $demande->save();

        $traducteur = Auth::user()->traducteur();

        foreach ($body['langues'] as $id) {
            $traducteur->attach(Langue::find($id));
        };

        redirect("/", ["demande-envoye" => "Vous avez envoyé une demande de recrutement avec succès, vous devez attendre que l'administrateur l'approuve."]);
    }

    /**
     * @param $request
     */
    public static function search($request) {
        $body = $request->getBody();

        $langueSource = $body['langueSource'];
        $langueDest = $body['langueDest'];

        $translators = Traducteur::all();
        $result_array = array();

        foreach ($translators as $translator) {
            $langues = $translator->langues();
            $ids = array_map(function ($l) { return $l->id_langue; }, $langues);

            if (in_array($langueSource, $ids) && in_array($langueDest, $ids)) {
                array_push($result_array, $translator);
            };
        }


        if (!empty($result_array)) {
            redirect("/our-translators", ['list_traducteur' => $result_array, 'langueSource' => $langueSource, 'langueDest' => $langueDest]);
        } else {
            redirect("/our-translators", ['langueSource' => $langueSource, 'langueDest' => $langueDest]);
        }
    }

}
