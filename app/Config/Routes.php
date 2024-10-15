<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/pegawai', 'Home::pegawai', ['filter' => 'role:admin']);
$routes->get('/pegawai/delete/(:any)', 'User::hapus_pegawai/$1', ['filter' => 'role:admin']);
$routes->get('/pegawai/update-ketuatim/(:any)', 'User::update_to_ketuatim/$1', ['filter' => 'role:admin']);
$routes->get('/pegawai/update-pegawai/(:any)', 'User::update_to_pegawai/$1', ['filter' => 'role:admin']);

$routes->get('/sop', 'Home::sop');
$routes->get('/daftar-rapat', 'Home::daftar_rapat');
$routes->get('/beranda/tabel', 'Home::daftar_rapat_tabel');

$routes->get('/rapat/edit/(:any)', 'Rapat::edit_rapat/$1', ['filter' => 'role:admin, ketuatim']);
$routes->get('/rapat/delete/(:any)', 'Rapat::hapus_rapat/$1', ['filter' => 'role:admin, ketuatim']);

$routes->get('/daftar-rapat/detail/(:any)', 'Home::detail_rapat');
$routes->post('/detail-rapat/upload/(:any)', 'Rapat::upload_file/$1');
$routes->post('/detail-rapat/delete/daftar/(:any)', 'Rapat::hapus_daftar/$1', ['filter' => 'role:admin, ketuatim']);
$routes->post('/detail-rapat/delete/atk/(:any)', 'Rapat::hapus_atk/$1', ['filter' => 'role:admin, ketuatim']);
$routes->post('/detail-rapat/delete/link/(:any)', 'Rapat::hapus_link/$1', ['filter' => 'role:admin, ketuatim']);
$routes->post('/detail-rapat/delete/notula/(:any)', 'Rapat::hapus_notula/$1', ['filter' => 'role:admin, ketuatim']);
$routes->post('/detail-rapat/delete/surat_undangan/(:any)', 'Rapat::hapus_surat_undangan/$1', ['filter' => 'role:admin, ketuatim']);
$routes->post('/detail-rapat/delete/kak/(:any)', 'Rapat::hapus_kak/$1', ['filter' => 'role:admin, ketuatim']);
$routes->post('/detail-rapat/delete/transport/(:any)', 'Rapat::hapus_transport/$1', ['filter' => 'role:admin, ketuatim']);
$routes->get('/monitoring-rapat', 'Home::monitoring_rapat', ['filter' => 'role:admin, ketuatim']);
$routes->get('/buat-undangan-rapat', 'Home::buat_undangan_rapat', ['filter' => 'role:admin, ketuatim']);
$routes->post('/buat-rapat', 'Rapat::buat_rapat', ['filter' => 'role:admin, ketuatim']);

$routes->get('/401', 'Home::unauth');
$routes->get('/403', 'Home::unpermis');
$routes->get('/404', 'Home::notfound');

$routes->get('/register', 'Home::register', ['filter' => 'role:admin']);

// $routes->get('/login', 'Home::login');
// $routes->post('/login', 'User::login');
