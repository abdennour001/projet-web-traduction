<?php


class ClientsController {

    /**
     * Render the client profile page.
     */
    public static function profile() {
        $c_profile_page = new View('profile/profile-client.php');
        $c_profile_page->render();
    }

    /**
     *  Render the edit profile page.
     */
    public static function editProfile() {
        $c_edit_profile_page = new View('profile/edit-profile-client.php');
        $c_edit_profile_page->render();
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

}
