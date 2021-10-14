<?php namespace Config;
$routes = Services::routes();

$routes->group('profile', function($routes)
{
    $routes->get('/', 'Profile::index');
    $routes->get('updateProfile', 'Profile::updateProfile');

    

});