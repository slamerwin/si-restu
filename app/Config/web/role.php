<?php namespace Config;
$routes = Services::routes();

$routes->group('role', function($routes)
{
    $routes->get('/', 'Role::index'); 
    $routes->get('dataRole', 'Role::getDataRole'); 
    $routes->post('editLevel', 'Role::editLevel');  

});