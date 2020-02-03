<?php


class TraductionController {

    /**
     * Render the demande traduction page.
     *
     * @param $request
     * @throws Exception
     */
    public static function demandeTraductionindex($request) {

        if (Auth::hasUser()) {
            $body = $request->getBody();
            $traduction = Traduction::find($body['id_traduction']);

            $tra = new View("traduction.php", ['traduction' => $traduction]);
            $tra->render();
        } else {
            redirect('/login');
        }
    }

    /**
     * Send a demande de traduction.
     *
     * @param $request
     */
    public static function send($request) {
        $body = $request->getBody();

        $traduction = new Traduction();
        $traduction->etat = "pas-encore-demarre";
        $timestamp = date('Y-m-d H:i:s');
        $traduction->date = $timestamp;
        $traduction->id_devis = $body['id_devis'];
        $traduction->id_document = 0;
        $id = $traduction->save();

        // create a notification for the client.
        $notification = new Notification();
        $notification->id_user = Devis::find($body['id_devis'])->traducteurs()[0]->id_traducteur;
        $notification->vu = 0;
        $notification->type = "demande-traduction";
        $notification->title = "Demande de traduction #" . $id;
        $notification->description = "Le Client ". Auth::user()->nom . " " . Auth::user()->prenom ." a demandé une traduction.";
        $notification->save();

        redirect("/demande-traduction?id_traduction=".$id, ["new-traduction" => "Vous avez demandé la traduction avec success."]);
    }

    /**
     * Delete a demande of traduction.
     *
     * @param $request
     */
    public static function delete($request) {

    }

    /**
     * Respond to a demande de traduction.
     *
     * @param $request
     */
    public static function respond($request) {
        $body = $request->getBody();
        $traduction = $body['id_traduction'];

        var_dump($traduction);
    }

    /**
     * Refuse the demande of traduction.
     *
     * @param $request
     */
    public static function refuser($request) {
        $body = $request->getBody();
        $traduction = Traduction::find($body['id_traduction']);
        $traduction->etat = "abandonne";
        $traduction->update();

        // create a notification for the client.
        $notification = new Notification();
        $notification->id_user = $traduction->devis()->client()->id_client;
        $notification->vu = 0;
        $notification->type = "demande-traduction";
        $notification->title = "Réponse de la demande de traduction #" . $traduction->id_traduction;
        $notification->description = "Le traducteur ". Auth::user()->nom . " " . Auth::user()->prenom ." a refusé ta demande de traduction.";
        $notification->save();

        redirect("/demande-traduction?id_traduction=".$traduction->id_traduction, ["respond-traduction" => "Vous avez envoyé le refus au " . $traduction->devis()->client()->user()->nom . " " . $traduction->devis()->client()->user()->nom . "."]);
    }


    /**
     * Handle the rendre travail request.
     *
     * @param $request
     */
    public static function rendreTravail($request) {
        $body = $request->getBody();
        $traduction = Traduction::find($body['traduction']);

        $file = $body['ass'];

        $path = "documents-traduits/document-traduit-traduction-" . ($traduction->id_traduction) . "-" . $file['name'];

        $document = new Document();
        $document->path = upload_file($file, $path);
        $timestamp = date('Y-m-d H:i:s');
        $document->date = $timestamp;
        $document->id_devis = 0;
        $last_id_d = $document->save();
        $traduction->id_document = $last_id_d;
        $traduction->etat = "finis";
        $traduction->update();

        // create a notification for the translator.
        $notification = new Notification();
        $notification->id_user = $traduction->devis()->client()->id_client;
        $notification->vu = 0;
        $notification->type = "demande-traduction";
        $notification->title = "Traduction #" . $traduction->id_traduction . " est finie";
        $notification->description = "La traduction de ". Auth::user()->nom . " " . Auth::user()->prenom ." est finie, vous pouvez la consulter.";
        $notification->save();

        redirect("/demande-traduction?id_traduction=".$traduction->id_traduction, ["respond-traduction" => "Vous avez envoyé la traduction au " . $traduction->devis()->client()->user()->nom . " " . $traduction->devis()->client()->user()->nom . "."]);

    }


    /**
     * Rate the translation.
     *
     * @param $request
     */
    public static function rating($request) {
        $body = $request->getBody();
        $rate = $body['rate'];
        $traduction = Traduction::find($body['traduction']);

        $traduction->note = $rate;
        $traduction->update();

        // create a notification for the translator.
        $notification = new Notification();
        $notification->id_user = $traduction->devis()->traducteurs()[0]->id_traducteur;
        $notification->vu = 0;
        $notification->type = "demande-traduction";
        $notification->title = "Note de la traduction #" . $traduction->id_traduction . ".";
        $notification->description = "Le client ". $traduction->devis()->client()->user()->nom . " " . $traduction->devis()->client()->user()->prenom  ." a noté votre traduction (". $rate ."/5) .";
        $notification->save();

        redirect("/demande-traduction?id_traduction=".$traduction->id_traduction, ["respond-traduction" => "Vous avez noté la traduction de " . $traduction->devis()->traducteurs()[0]->user()->nom . " " . $traduction->devis()->traducteurs()[0]->user()->nom . "."]);
    }

    /**
     * Signaler la demande de traduction.
     *
     * @param $request
     */
    public static function signaler($request) {
        $body = $request->getBody();
        $traduction = Traduction::find($body['traduction']);

        $traduction->note = -1;
        $traduction->update();

        // create a notification for the translator.
        $notification = new Notification();
        $notification->id_user = $traduction->devis()->traducteurs()[0]->id_traducteur;
        $notification->vu = 0;
        $notification->type = "demande-traduction";
        $notification->title = "La traduction #" . $traduction->id_traduction . " a été signaler.";
        $notification->description = "Le client ". $traduction->devis()->client()->user()->nom . " " . $traduction->devis()->client()->user()->prenom  ." a signalé votre traduction.";
        $notification->save();

        redirect("/demande-traduction?id_traduction=".$traduction->id_traduction, ["respond-traduction" => "Vous avez signaler la traduction de " . $traduction->devis()->traducteurs()[0]->user()->nom . " " . $traduction->devis()->traducteurs()[0]->user()->nom . "."]);

    }


}
