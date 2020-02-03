<?php

// require ReCaptcha class
use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod\CurlPost;
use ReCaptcha\RequestMethod\Post;

require('config/recaptcha-master/src/autoload.php');

class DevisController {

    /**
     * Render the devis view.
     */
    public static function index() {
        if (Auth::hasUser() && Auth::type() == Client::class) {
            $devis_page = new View('forms/send-devis.php');
            $devis_page->render();
        } else {
            redirect("/");
        }
    }

    /**
     *  Handle the send devis post request.
     * @param $request
     * @throws Exception
     */
    public static function sendDevis($request) {

        error_reporting(E_ALL & ~E_NOTICE);

        try {

            if (!isset($request->getBody()['g-recaptcha-response'])) {
                redirect("/devis", ["error-send-devis" => 'Veuillez vérifier votre recaptcha.']);
            }

            $recaptchaSecret = '6LcmZs0UAAAAANw-0pkBFVIn990QhnVusstdIhGW';
            $recaptcha = new ReCaptcha($recaptchaSecret, new Post());
            $response = $recaptcha->verify($request->getBody()['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

            if (!$response->isSuccess()) {
                redirect("/devis", ["error-send-devis" => 'Veuillez vérifier votre recaptcha.']);
            }

            // reCaptcha is good
            $body = $request->getBody();
            $devis = new Devis();
            $devis->type_traduction = $body['type'];
            $devis->etat = "pas-encore-repondu";
            $devis->commentaires = $body['comments'];
            if (isset($body['assermente'])) {
                $devis->traducteur_assermente = 1;
            } else {
                $devis->traducteur_assermente = 0;
            }
            $timestamp = date('Y-m-d H:i:s');
            $devis->date = $timestamp;
            $devis->id_langue_source = $body['langue_source'];
            $devis->id_langue_destination = $body['langue_destination'];
            $devis->id_client = Auth::id();
            $devis->prix = "0 D.A";

            //----
            $devis->id_document = 0;
            $last_id_devis = $devis->save();
            $devis = Devis::find($last_id_devis);
            //----

            $file = $body['document'];

            $path = "documents-sources/document-source-devis-" . ($last_id_devis+1) . "-" . $file['name'];

            $document = new Document();
            $document->path = upload_file($file, $path);
            $document->date = $timestamp;
            $document->id_devis = ($last_id_devis);
            $last_id_d = $document->save();
            $devis->id_document = $last_id_d;
            $devis->update();


            $translators = Traducteur::all();
            $result_array = array();
            $langueSource = $body['langue_source'];
            $langueDest = $body['langue_destination'];

            foreach ($translators as $translator) {
                $langues = $translator->langues();
                $ids = array_map(function ($l) { return $l->id_langue; }, $langues);

                if (in_array($langueSource, $ids) && in_array($langueDest, $ids)) {
                    if ($devis->traducteur_assermente) {
                        if ($translator->est_assermente == 1) {
                            array_push($result_array, $translator);
                        }
                    } else {
                        array_push($result_array, $translator);
                    }
                };
            }

            if (!empty($result_array)) {
                redirect('/devis-choose-translator', ["devis" => $devis, "document" => $document, 'list_traducteur' => $result_array]);
            } else {
                redirect('/devis-choose-translator');
            }

        } catch (Exception $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    public static function chooseTranslatorIndex() {
        $choose_view = new View("forms/choose-translator.php");
        $choose_view->render();
    }

    public static function chooseTranslator($request) {
        $body = $request->getBody();


        $devis = Session::get('devis');


        Session::forget('devis');
        Session::forget('document');

        $translator = Traducteur::find($body['selectedTranslator']);

        $translator->attach($devis);

        // create a notification for the translator.
        $notification = new Notification();
        $notification->id_user = $translator->id_traducteur;
        $notification->vu = 0;
        $notification->type = "devis";
        $notification->title = "Demande devis #" . $devis->id_devis;
        $notification->description = "Vous avez une nouvelle demande de devis de ". Auth::user()->nom . " " . Auth::user()->prenom .".";
        $notification->save();

        redirect('/devis', ["devis-sent" => "Vous avez envoyé le devis avec succès."]);

    }

    /**
     * @param $request
     * @throws Exception
     */
    public static function demandeDevisindex($request) {

        $body = $request->getBody();
        $devis = Devis::find($body['id_devis']);

        $tra = new View("devis.php", ['devis' => $devis]);
        $tra->render();
    }

    /**
     * @param $request
     */
    public static function respond($request) {
        $body = $request->getBody();

        $devis = Devis::find($body['devis']);
        $prix = $body['prix'];

        $devis->prix = $prix;
        $devis->etat = "repondu";

        $devis->update();

        // create a notification for the client.
        $notification = new Notification();
        $notification->id_user = $devis->client()->id_client;
        $notification->vu = 0;
        $notification->type = "devis";
        $notification->title = "Réponse du devis #" . $devis->id_devis;
        $notification->description = "Vous avez une nouvelle réponse concernant le devis de ". Auth::user()->nom . " " . Auth::user()->prenom .".";
        $notification->save();


        redirect('/demande-devis?id_devis='.$devis->id_devis, ["respond-devis" => "Vous avez envoyé le prix au " . $devis->client()->user()->nom . " " . $devis->client()->user()->nom . " avec success."]);
    }

    /**
     * @param $request
     */
    public static function delete($request) {
        $devis = Devis::find($request->getBody()['id_devis']);
        $document = $devis->document();
        $path = $document->path;
        unlink_file($path);

        $devis->delete();
        $document->delete();

        redirect("/", ["demande-envoye" => "Vous avez supprimé le devis #{$devis->id_devis} avec success."]);
    }

    public static function refuser($request) {
        $devis = Devis::find($request->getBody()['id_devis']);
        $devis->etat = "refuse";

        $devis->update();

        // create a notification for the client.
        $notification = new Notification();
        $notification->id_user = $devis->client()->id_client;
        $notification->vu = 0;
        $notification->type = "devis";
        $notification->title = "Réponse du devis #" . $devis->id_devis;
        $notification->description = "Le traducteur ". Auth::user()->nom . " " . Auth::user()->prenom ." a refusé ton devis de traduction.";
        $notification->save();


        redirect('/demande-devis?id_devis='.$devis->id_devis, ["respond-devis" => "Vous avez envoyé le refus au " . $devis->client()->user()->nom . " " . $devis->client()->user()->nom . "."]);
    }
}
