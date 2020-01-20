<?php


class ArticlesController {

    /**
     *  Render the blog view.
     *
     * @param $request
     * @throws Exception
     */
    public static function index() {
        $blog_page = new View('blog.php');
        $blog_page->render();
    }

    public static function article($request) {
        $body = $request->getBody();
        $article_title = $body['title'];
        $article_date = $body['date'];
        $article_body = $body['body'];

        $blog_page = new View('blog.php', ["title" => $article_title, "body" => $article_body, "date" => $article_date]);
        $blog_page->render();
    }
}
