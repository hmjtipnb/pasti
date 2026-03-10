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





$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {

    // Halaman ubah password (GET)
    $routes->get('password', 'Auth::changePassword', ['as' => 'admin.password']);

    // Proses ubah password (POST)
    $routes->post('password/update', 'Auth::updatePassword', ['as' => 'admin.password.update']);
});


$routes->group('pendaftaran', function ($routes) {
    $routes->get('anggota', 'Anggota::index');
    $routes->post('anggota/store', 'Anggota::store');
    $routes->get('anggota/success', 'Anggota::success');
});

$routes->group('admin', function($routes) {
    $routes->get('peserta', 'Admin\Users::index');
    $routes->get('peserta/absensi', 'Admin\Users::absensi');
    $routes->get('users/toggleSesi/(:num)', 'Admin\Users::toggleSesi/$1');
    $routes->get('users/delete/(:any)', 'Admin\Users::delete/$1');
    $routes->post('users/updateSesi', 'Admin\Users::updateSesi');
    $routes->post('peserta/toggleSesi/(:num)', 'Admin\Users::toggleSesi/$1');
});



$routes->get('uploads/(:any)', 'FileController::show/$1');





$routes->group('divisi', function ($routes) {
    $routes->get('visual', 'Divisi::visual');
    $routes->get('web', 'Divisi::web');
    $routes->get('kti', 'Divisi::kti');
});



$routes->group('seminar', function($routes) {
    $routes->get('absensi', 'Seminar\Absensi::index'); // untuk menampilkan halaman absensi
    $routes->post('absensi/store', 'Seminar\Absensi::store'); // untuk submit absensi
});

// SESI SEMINAR SETTING
$routes->group('admin', function ($routes) {
    $routes->get('sesi-setting', 'Admin\SesiSetting::index');
    $routes->post('sesi-setting/toggle/(:segment)', 'Admin\SesiSetting::toggle/$1');
});



// RIVEW ADMIN Show
$routes->group('admin', function ($routes) {
    $routes->get('review', 'Admin\ReviewController::index');
    $routes->post('review/delete/(:num)', 'Admin\ReviewController::delete/$1');
});

