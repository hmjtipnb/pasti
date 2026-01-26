<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('/submit-review', 'Home::submitReview');
$routes->post('review/store', 'ReviewController::store');

$routes->get('pendaftaran', 'Pendaftaran::index');
$routes->post('pendaftaran/store', 'Pendaftaran::store');

$routes->get('/', 'Pendaftaran::index');
$routes->post('pendaftaran/store', 'Pendaftaran::store');
$routes->get('success', 'Pendaftaran::success');

$routes->get('admin/dashboard', 'Admin\Dashboard::index');

// authenticate
$routes->group('admin', function($routes) {
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('authenticate', 'Admin\Auth::authenticate');
    $routes->post('logout', 'Admin\Auth::logout');
    $routes->get('dashboard', 'Admin\Dashboard::index');
});



$routes->group('admin', function($routes){
    $routes->get('peserta', 'Admin\Users::index'); 
});




