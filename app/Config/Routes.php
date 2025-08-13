<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::login');

$routes->get('login', 'LoginController::login'); // shows login form
$routes->post('register/store', 'RegisterController::store');
$routes->post('loginsubmit', 'LoginController::loginSubmit'); // handles login POST

$routes->get('logout', 'LoginController::logout');

$routes->get('dashboard', 'DashboardController::dashboard');
$routes->post('dashboard', 'DashboardController::dashboard');

$routes->get('RegisterPage', 'RegisterController::register'); // shows registration form

$routes->get('register', 'RegisterController::register');
$routes->post('register/store', 'RegisterController::store');

$routes->get('/product', 'ProductController::product');
$routes->post('product/store', 'ProductController::store');

$routes->get('product/history', 'ProductController::history');
$routes->post('product/history', 'ProductController::history');

// add org_id in the tbl_product but not using it to add the organisation name, instead, it will detect the organisation based on the account that they've logged in 