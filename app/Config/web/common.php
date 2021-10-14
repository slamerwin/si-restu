<?php namespace Config;
$routes = Services::routes();

$routes->group('login', function($routes)
{
    $routes->get('/', 'Auth::index');
    $routes->post('process', 'Auth::process');
    $routes->get('logout', 'Auth::logout');
    $routes->get('checkEmail', 'Auth::checkEmail');
    $routes->get('regis', 'Auth::regis');
    
});

$routes->group('registrasi', function($routes)
{
    $routes->get('/', 'Auth::registrasi');
    $routes->post('regis', 'Auth::regis');
    
});

$routes->group('forgotpassword', function($routes)
{
    $routes->get('/', 'Auth::forgotPassword');
    $routes->post('token', 'Auth::kirimToken');
    $routes->post('ceng', 'Auth::cengPassword'); 
    $routes->get('ceng', 'Auth::ganti');
    
});