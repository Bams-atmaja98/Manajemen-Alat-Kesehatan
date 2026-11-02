<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('test', 'Test::index');

// Auth (tanpa perlu login)
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// Group yang butuh login
$routes->group('', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('home', 'Home::index');

    $routes->get('produk', 'Produk::index');
    $routes->get('produk/create', 'Produk::create');
    $routes->post('produk/store', 'Produk::store');
    $routes->get('produk/edit/(:num)', 'Produk::edit/$1');
    $routes->post('produk/update/(:num)', 'Produk::update/$1');
    $routes->get('produk/delete/(:num)', 'Produk::delete/$1');

    $routes->get('transaksi', 'Transaksi::index');
    $routes->get('transaksi/create', 'Transaksi::create');
    $routes->post('transaksi/store', 'Transaksi::store');
    $routes->get('transaksi/show/(:num)', 'Transaksi::show/$1');

    $routes->get('stok-gudang', 'StokGudang::index');
    $routes->get('stok-gudang/create', 'StokGudang::create');
    $routes->post('stok-gudang/store', 'StokGudang::store');
});
