<?php


class TraducteursController {

    /**
     *  Render the recruitment view.
     *
     */
    public static function index() {
        $recruitment_page = new View('forms/recruitment.php');
        $recruitment_page->render();
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

}
