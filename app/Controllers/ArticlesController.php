<?php


class ArticlesController {

    /**
     *  Render the blog view.
     */
    public static function index() {
        $blog_page = new View('blog.php');
        $blog_page->render();
    }
}
