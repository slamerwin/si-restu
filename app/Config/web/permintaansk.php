<?php namespace Config;
$routes = Services::routes();

$routes->group('permintaan', function($routes)
{
    $routes->get('/', 'PermintaanSK::index'); 
    $routes->get('aktif', 'PermintaanSK::aktifSK');
    $routes->get('tidakAktif', 'PermintaanSK::tidakAktifSK');
    $routes->get('dataPermintaan', 'PermintaanSK::getDataPermintaan');
    $routes->get('dataAktif', 'PermintaanSK::getDataAktif');
    $routes->get('dataTidakAktif', 'PermintaanSK::getDataTidakAktif');
    $routes->post('saveData', 'PermintaanSK::saveData');
    $routes->post('delet', 'PermintaanSK::delet');
    $routes->post('edit', 'PermintaanSK::edit');
    $routes->post('updateData', 'PermintaanSK::updateData');
    $routes->post('updateDataSk', 'PermintaanSK::updateDataSk');
    $routes->post('buka', 'PermintaanSK::buka');
    $routes->post('buatSK', 'PermintaanSK::buatSK');
    $routes->post('notif', 'PermintaanSK::totalNotif');
    $routes->get('statusNotifPembuatan', 'PermintaanSK::statusNotifPembuatan');
    $routes->get('statusNotifTidakAktif', 'PermintaanSK::statusNotifTidakAktif');
    
    
    
});