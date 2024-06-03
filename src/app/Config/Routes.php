<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/checkout', 'Checkout::index');
$routes->get('/payment/success', 'Payments::payment_success');

