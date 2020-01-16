<?php

require_once 'Request.php';
require_once 'Router.php';
require_once 'app/Controllers/HomeController.php';
require_once 'app/Controllers/LoginController.php';
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

$router->post("/signup/signing", function ($request) {
    Register::sign_up($request);
});
