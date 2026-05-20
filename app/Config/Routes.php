<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/login', 'User::login');
$routes->post('/login', 'User::login');
$routes->get('/home', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');
$routes->get('/faqs', 'Page::faqs'); 
$routes->get('/logout', 'User::logout');

// ADMIN
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});

// AJAX (BARU)
// AJAX
$routes->group('ajax', function($routes) {

    $routes->post('create', 'AjaxController::create');
    $routes->post('update/(:num)', 'AjaxController::update/$1');

    $routes->match(['post','delete'], 'delete/(:num)', 'AjaxController::delete/$1');

});

$routes->setAutoRoute(false);