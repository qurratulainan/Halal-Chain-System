<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::landingLogin');

$routes->get('login', 'LoginController::login'); // shows login form
$routes->post('loginSubmit', 'LoginController::loginSubmit'); // handles login POST

$routes->get('logout', 'LoginController::logout');


// $routes->get('ajaxLogin', 'RegisterPageController::ajaxLogin');
// $routes->post('ajaxLogin', 'RegisterPageController::ajaxLogin');

$routes->get('logout', 'LoginController::logout');

$routes->get('dashboard', 'DashboardController::dashboard');
$routes->post('dashboard', 'DashboardController::dashboard');

$routes->get('RegisterPage', 'RegisterPageController::register'); // shows registration form

$routes->get('register', 'RegisterPageController::register');
$routes->post('register/store', 'RegisterPageController::store');

$routes->get('/product', 'ProductController::product');
$routes->post('product/store', 'ProductController::store');

$routes->get('product/history', 'ProductController::history');
$routes->post('product/history', 'ProductController::history');

// $routes->get('orders', 'OrdersController::orders');
$routes->get('orders/create', 'OrdersController::create');   // handle post
$routes->post('orders/store', 'OrdersController::store');   // handle post

// $routes->get('orders/history', 'OrdersController::history');


