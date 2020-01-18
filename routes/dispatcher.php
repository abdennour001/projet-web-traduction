<?php

require_once 'Request.php';
require_once 'Router.php';
require_once 'app/Controllers/HomeController.php';
require_once 'app/Controllers/LoginController.php';
require_once 'app/Controllers/TraducteursController.php';
require_once 'app/Controllers/ArticlesController.php';
require_once 'app/Middleware/Register.php';


$router = new Router(new Request);

$router->get("/", function() {
    HomeController::index();
});

$router->get("/login", function() {
    LoginController::index();
});

$router->post("/login/auth", function($request) {
    LoginController::login($request);
});

$router->get("/logout", function() {
    LoginController::logout();
});

$router->get("/sign-up", function () {
    Register::index();
});

$router->post("/sign-up/signing", function ($request) {
    Register::sign_up($request);
});

$router->get("/recruitment", function () {
    TraducteursController::index();
});

$router->get("/our-translations", function () {
    TraducteursController::index_our_translations();
});

$router->get("/our-translators", function () {
    TraducteursController::index_our_translators();
});

$router->get("/blog", function () {
    ArticlesController::index();
});

$router->get("/recruitment", function () {
    TraducteursController::index();
});

$router->get("/about", function () {
    HomeController::about();
});
