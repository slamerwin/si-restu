<?php namespace Config;
$routes = Services::routes();

$routes->group('pegawai', function($routes)
{
    $routes->get('/', 'Pegawai::index'); 
    $routes->get('dataPegawai', 'Pegawai::getDataPegawai'); 
    $routes->post('checkEmail', 'Pegawai::checkEmail');
    $routes->post('saveData', 'Pegawai::saveData');
    $routes->post('edit', 'Pegawai::edit');
    $routes->post('updateData', 'Pegawai::updateData');
    $routes->post('delet', 'Pegawai::delet');

});