<?php


class NotificationsController {

    /**
     * Render the notifications view.
     */
    public static function index() {
        if (Auth::hasUser()) {
            $notifications_page = new View('notifications.php');
            $notifications_page->render();
        } else {
            redirect("/");
        }
    }

}
