<?php namespace Config;
$routes = Services::routes();

$routes->group('permintaan', function($routes)
{
    $routes->get('/', 'PermintaanSK::index'); 
    $routes->get('dataPermintaan', 'PermintaanSK::getDataPermintaan');
    $routes->post('saveData', 'PermintaanSK::saveData');
    $routes->post('delet', 'PermintaanSK::delet');
    $routes->post('edit', 'PermintaanSK::edit');
    $routes->post('updateData', 'PermintaanSK::updateData');
    $routes->post('buka', 'PermintaanSK::buka');
    $routes->post('buatSK', 'PermintaanSK::buatSK');
    $routes->post('notif', 'PermintaanSK::totalNotif');
    $routes->get('statusNotifPembuatan', 'PermintaanSK::statusNotifPembuatan');
    
    
});