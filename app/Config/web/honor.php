<?php namespace Config;
$routes = Services::routes();

$routes->group('honor', function($routes)
{
    $routes->get('/', 'Honor::index'); 
    $routes->get('dataHonor', 'Honor::getDataHonor'); 
    $routes->post('checkEmail', 'Honor::checkEmail');
    $routes->post('saveData', 'Honor::saveData');
    $routes->post('edit', 'Honor::edit');
    $routes->post('updateData', 'Honor::updateData');
    $routes->post('delet', 'Honor::delet');

});