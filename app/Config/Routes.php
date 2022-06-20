<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Main');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Main::index');
$routes->post('/login', 'Main::login');
$routes->get('/forgot', 'Main::forgot');
$routes->post('/username', 'Main::checkUsername');
$routes->post('/password', 'Main::checkPassword');
$routes->post('/email', 'Main::checkEmail');
$routes->get('/logout', 'Main::logout');
$routes->post('/update', 'Main::update');

$routes->get('/transaksi', 'Transaksi::index');
$routes->get('/transaksi/create', 'Transaksi::createForm');
$routes->add('/transaksi/add', 'Transaksi::create');
$routes->get('/transaksi/detail/(:any)', 'Transaksi::detail/$1');
$routes->get('/transaksi/approve/(:any)', 'Transaksi::approve/$1');
$routes->get('/transaksi/pending/(:any)', 'Transaksi::pending/$1');
$routes->get('/transaksi/cancel/(:any)', 'Transaksi::cancel/$1');
$routes->get('/transaksi/edit/barang/(:segment)', 'Transaksi::editBarangForm/$1');
$routes->get('/transaksi/edit/layanan/(:segment)', 'Transaksi::editLayananForm/$1');
$routes->add('/transaksi/edit-barang', 'Transaksi::editBarang');
$routes->add('/transaksi/edit-layanan', 'Transaksi::editLayanan');
$routes->get('/transaksi/delete/barang/(:any)', 'Transaksi::deleteBarang/$1');
$routes->get('/transaksi/delete/layanan/(:any)', 'Transaksi::deleteLayanan/$1');
$routes->get('/transaksi/delete/(:any)', 'Transaksi::deleteTransaksi/$1');


$routes->get('pelanggan', 'PelangganController::index');
$routes->get('pelanggan/create', 'PelangganController::create');
$routes->post('pelanggan/store', 'PelangganController::store');
$routes->get('pelanggan/(:segment)/edit', 'PelangganController::edit/$1');
$routes->get('pelanggan/(:segment)/delete', 'PelangganController::delete/$1');
$routes->post('pelanggan/update/(:segment)', 'PelangganController::update/$1');

$routes->get('user', 'User::index');
$routes->get('user/(:segment)/edit', 'user::edit/$1');
$routes->get('user/(:segment)/delete', 'user::delete/$1');
$routes->post('user/update/(:segment)', 'user::update/$1');

// Route for Barang
$routes->get('barang', 'BarangController::index');
$routes->get('barang/create', 'BarangController::create');
$routes->post('barang/store', 'BarangController::store');
$routes->get('barang/(:segment)/edit', 'BarangController::edit/$1');
$routes->get('barang/(:segment)/delete', 'BarangController::delete/$1');
$routes->post('barang/update/(:segment)', 'BarangController::update/$1');

// Route for Layanan
$routes->get('layanan', 'LayananController::index');
$routes->get('layanan/create', 'LayananController::create');
$routes->post('layanan/store', 'LayananController::store');
$routes->get('layanan/(:segment)/edit', 'LayananController::edit/$1');
$routes->get('layanan/(:segment)/delete', 'LayananController::delete/$1');
$routes->post('layanan/update/(:segment)', 'LayananController::update/$1');

// Route for PKS
$routes->get('pks', 'PksController::index');
$routes->get('pks/create', 'PksController::create');
$routes->post('pks/store', 'PksController::store');
$routes->get('pks/(:segment)/edit', 'PksController::edit/$1');
$routes->get('pks/(:any)/delete', 'PksController::delete/$1');
$routes->post('pks/update/(:any)', 'PksController::update/$1');

$routes->get('registration', 'RegistrationController::index');
$routes->post('registration/store', 'RegistrationController::store');

$routes->get('/transaksi/nota/(:any)', 'NotaController::index/$1');
$routes->get('/transaksi/nota-download/(:any)', 'NotaController::download/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reloadit.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
