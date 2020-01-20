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
            $devis->commentaires = $body['comments'];
            $devis->etat = 'pas-encore-demarre';
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
            $last_id = Devis::all($order_by = 'DESC')[0]->id_devis;
            $last_id_d = Document::all($order_by = 'DESC')[0]->id_document;
            $file = $body['document'];

            $path = "documents-sources/document-source-devis-" . ($last_id+1) . "-" . $file['name'];

            $document = new Document();
            $document->path = upload_file($file, $path);
            $document->date = $timestamp;
            $document->id_devis = ($last_id+1);
            $devis->id_document = ($last_id_d+1);

            $devis->save();
            $document->save();

        } catch (Exception $e) {
            var_dump($e->getMessage());
            die();
        }
    }
}
