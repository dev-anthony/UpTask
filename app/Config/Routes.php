<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/auth/login', 'Auth::login');

$routes->group('api/rols', ['namespace' => 'App\Controllers\API', 'filter' => 'authFilter'], function ($routes) {
  // http://localhost:8080/api/rols --> GET
  $routes->get('', 'RolsController::index');
  // http://localhost:8080/api/rols/1 --> SHOW
  $routes->get('(:num)', 'RolsController::show/$1');
  // http://localhost:8080/api/rols/create --> POST
  $routes->post('create', 'RolsController::create');
  // http://localhost:8080/api/rols/edit/1 --> PUT
  $routes->put('edit/(:num)', 'RolsController::edit/$1');
  // http://localhost:8080/api/rols/1 --> DELETE
  $routes->delete('delete/(:num)', 'RolsController::delete/$1');
});

$routes->group('api/users', ['namespace' => 'App\Controllers\API', 'filter' => 'authFilter'], function ($routes) {
  // http://localhost:8080/api/users --> GET
  $routes->get('', 'UsersController::index');
  // http://localhost:8080/api/users/1 --> SHOW
  $routes->get('(:num)', 'UsersController::show/$1');
  // http://localhost:8080/api/users/create --> POST
  $routes->post('create', 'UsersController::create');
  // http://localhost:8080/api/users/edit/1 --> PUT
  $routes->put('edit/(:num)', 'UsersController::edit/$1');
  // http://localhost:8080/api/users/1 --> DELETE
  $routes->delete('delete/(:num)', 'UsersController::delete/$1');
});

$routes->group('api/categories', ['namespace' => 'App\Controllers\API', 'filter' => 'authFilter'], function ($routes) {
  // http://localhost:8080/api/categories --> GET
  $routes->get('', 'CategorysController::index');
  // http://localhost:8080/api/categories/1 --> SHOW
  $routes->get('(:num)', 'CategorysController::show/$1');
  // http://localhost:8080/api/categories/create --> POST
  $routes->post('create', 'CategorysController::create');
  // http://localhost:8080/api/categories/edit/1 --> PUT
  $routes->put('edit/(:num)', 'CategorysController::edit/$1');
  // http://localhost:8080/api/categories/delete/1 --> DELETE
  $routes->delete('delete/(:num)', 'CategorysController::delete/$1');
});

$routes->group('api/tasks', ['namespace' => 'App\Controllers\API', 'filter' => 'authFilter'], function ($routes) {
  // http://localhost:8080/api/tasks --> GET
  $routes->get('', 'TasksController::index');
  // http://localhost:8080/api/tasks/1 --> SHOW
  $routes->get('(:num)', 'TasksController::show/$1');
  // http://localhost:8080/api/tasks/create --> POST
  $routes->post('create', 'TasksController::create');
  // http://localhost:8080/api/tasks/edit/1 --> PUT
  $routes->put('edit/(:num)', 'TasksController::edit/$1');
  // http://localhost:8080/api/tasks/1 --> DELETE
  $routes->delete('delete/(:num)', 'TasksController::delete/$1');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
