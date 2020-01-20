<?php

require_once 'Request.php';
require_once 'Router.php';
require_once 'app/Controllers/HomeController.php';
require_once 'app/Controllers/LoginController.php';
require_once 'app/Controllers/TraducteursController.php';
require_once 'app/Controllers/ArticlesController.php';
require_once 'app/Controllers/NotificationsController.php';
require_once 'app/Controllers/DevisController.php';
require_once 'app/Controllers/ClientsController.php';
require_once 'app/Controllers/TraducteursController.php';
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

$router->post("/recruitment/send", function ($request) {
    TraducteursController::recruitment($request);
});

$router->get("/about", function () {
    HomeController::about();
});

$router->get("/notifications", function () {
    NotificationsController::index();
});

$router->get("/devis", function () {
    DevisController::index();
});

$router->post("/devis/send", function ($request) {
    DevisController::sendDevis($request);
});

$router->get("/client", function () {
    ClientsController::profile();
});

$router->get("/traducteur", function () {
    TraducteursController::profile();
});

$router->get("/edit-client", function () {
    ClientsController::editProfile();
});

$router->get("/edit-traducteur", function () {
    TraducteursController::editProfile();
});

$router->post("/edit-client/editing", function ($request) {
    ClientsController::editingProfile($request);
});

$router->post("/edit-traducteur/editing", function ($request) {
    TraducteursController::editingProfile($request);
});

$router->get("/article", function ($request) {
    ArticlesController::article($request);
});
