<?php namespace Config;
$routes = Services::routes();

$routes->group('hakim', function($routes)
{
    $routes->get('/', 'Hakim::index'); 
    $routes->get('dataHakim', 'Hakim::getDataHakim'); 
    $routes->post('checkEmail', 'Hakim::checkEmail');
    $routes->post('saveData', 'Hakim::saveData');
    $routes->post('edit', 'Hakim::edit');
    $routes->post('updateData', 'Hakim::updateData');
    $routes->post('delet', 'Hakim::delet');

});