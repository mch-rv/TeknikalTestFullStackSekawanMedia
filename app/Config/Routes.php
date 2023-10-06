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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/home', 'Home::index');
$routes->get('/', 'Auth::login');

$routes->group('Auth', function($routes){
	$routes->get('login', 'Auth::login');
	$routes->post('logprocess', 'Auth::loginprocess');
	$routes->get('logout', 'Auth::logout');
	
});
$routes->group('cars', function($routes){
	$routes->get('/', 'Cars::index');
	$routes->post('/', 'Cars::index');
	$routes->get('preview/(:segment)', 'Cars::preview/$1');
	$routes->get('create', 'Cars::create');
	$routes->post('store', 'Cars::store');
	$routes->get('edit/(:segment)', 'Cars::edit/$1');
	$routes->post('update/(:segment)', 'Cars::update/$1');
	$routes->get('delete/(:num)', 'Cars::delete/$1');
    $routes->post('request/(:segment)', 'Cars::request/$1');
});
$routes->group('report', function($routes){
	$routes->get('/', 'Report::index');
	$routes->post('/', 'Report::index');
	$routes->post('export', 'Report::exportExcel');
	$routes->get('create/(:segment)', 'Report::create/$1');
	$routes->post('store/(:segment)', 'Report::store/$1');
	$routes->get('edit/(:segment)/(:segment)', 'Report::edit/$1/$2');
	$routes->post('update/(:segment)/(:segment)', 'Report::update/$1/$2');
    $routes->post('accept/(:segment)', 'Report::accept/$1');
    $routes->post('reject/(:segment)/(:segment)', 'Report::reject/$1/$2');
	$routes->get('delete/(:segment)/(:segment)', 'Report::delete/$1/$2');
});
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
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
