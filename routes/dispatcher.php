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
require_once 'app/Controllers/TraductionController.php';
require_once 'app/Controllers/AdminController.php';
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

$router->post("/our-translators/search", function ($request) {
    TraducteursController::search($request);
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

$router->get("/demande-devis", function ($request) {
    DevisController::demandeDevisindex($request);
});

$router->get("/demande-traduction", function ($request) {
    TraductionController::demandeTraductionindex($request);
});

$router->get("/demande-traduction/send", function ($request) {
    TraductionController::send($request);
});


$router->get("/demande-traduction/delete", function ($request) {
    TraductionController::delete($request);
});

$router->get("/demande-traduction/respond", function ($request) {
    TraductionController::respond($request);
});

$router->get("/demande-traduction/refuser", function ($request) {
    TraductionController::refuser($request);
});

$router->post("/demande-traduction/rendre-travail", function ($request) {
    TraductionController::rendreTravail($request);
});

$router->get("/demande-traduction/rate", function ($request) {
    TraductionController::rating($request);
});

$router->get("/demande-traduction/signaler", function ($request) {
    TraductionController::signaler($request);
});

// routes of devis

$router->post("/devis/send", function ($request) {
    DevisController::sendDevis($request);
});

$router->get("/devis/delete", function ($request) {
    DevisController::delete($request);
});

$router->post("/devis/respond", function ($request) {
    DevisController::respond($request);
});

$router->get("/devis/refuser", function ($request) {
    DevisController::refuser($request);
});


$router->get("/devis-choose-translator", function () {
    DevisController::chooseTranslatorIndex();
});

$router->post("/devis-choose-translator/send", function ($request) {
    DevisController::chooseTranslator($request);
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


// admin routes

$router->get("/admin/login", function () {
    AdminController::indexLogin();
});

$router->get("/admin", function () {
    AdminController::index();
});

$router->post("/admin/login/auth", function ($request) {
    AdminController::login($request);
});

$router->get("/admin/logout", function() {
    AdminController::logout();
});

$router->get("/admin/gestion-traducteurs", function () {
    AdminController::translators();
});

$router->get("/admin/gestion-traducteurs/approve", function ($request) {
    AdminController::approve($request);
});

$router->get("/admin/gestion-traducteurs/disapprove", function ($request) {
    AdminController::disapprove($request);
});

$router->get("/admin/block", function ($request) {
    AdminController::block($request);
});

$router->get("/admin/unblock", function ($request) {
    AdminController::unblock($request);
});

$router->get("/admin/gestion-devis", function () {
    AdminController::devis();
});

$router->get("/admin/gestion-traductions", function () {
    AdminController::traductions();
});

$router->get("/admin/gestion-clients", function () {
    AdminController::clients();
});

$router->get("/admin/gestion-documents", function () {
    AdminController::documents();
});

$router->get("/admin/gestion-documents/delete", function ($request) {
    AdminController::deleteDocument($request);
});

$router->get("/admin/statistiques", function () {
    AdminController::statistics();
});
