<?php

require_once 'Request.php';
require_once 'Router.php';
require_once 'app/Controllers/MainController.php';


$router = new Router(new Request);

$router->get('/test', function () {
    MainController::index();
});

$router->get("/", function() {
    $p = new View(env('ROOT_PATH').'resources/views/forms/send-devis.php');
    $p->set('data', 'this is data');
    $p->render();
});

$router->get("/signin", function() {
    $p = new View(env('ROOT_PATH').'resources/views/forms/signin.php');
    $p->set('data', 'this is data');
    $p->render();
});

$router->get("/signup", function() {
    $p = new View(env('ROOT_PATH').'resources/views/forms/signup.php');
    $p->set('data', 'this is data');
    $p->render();
});




