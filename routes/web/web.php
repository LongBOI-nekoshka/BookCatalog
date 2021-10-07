<?php

use WebRouterClasses\Route;
use Models\Models;
use Controller\BooksController;
use Controller\AuthController;
//can be done in composer init
require_once __DIR__.'/../../fakeVendor/WebRouterClasses/Route.php';
require_once __DIR__.'/../../app/Controller/BooksController.php';
require_once __DIR__.'/../../app/Controller/AuthController.php';

$router = new Route;

$router->get('/',function () {
    $AuthController = new AuthController;
    return $AuthController->loginPage();
});

$router->get('/register',function () {
    $AuthController = new AuthController;
    return $AuthController->registerPage();
});

$router->get('/test',function () {
    echo 'no';
});

$router->get('/logout',function () {
    $AuthController = new AuthController;
    $AuthController->logout();
});

$router->post('/login',function () {
    $AuthController = new AuthController;
    $AuthController->login();
});

$router->post('/register',function () {
    $AuthController = new AuthController;
    echo json_encode($AuthController->register());
});

$router->post('/createBook',function () {
    $BooksController = new BooksController;
    echo json_encode($BooksController->createBooks());
});

$router->post('/updateBook',function () {
    $BooksController = new BooksController;
    echo json_encode($BooksController->editBooks());
});

$router->post('/deleteBook',function () {
    $BooksController = new BooksController;
    echo json_encode($BooksController->deleteBooks());
});


$router->run();