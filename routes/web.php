<?php
// web.php
include('./controllers/controllers.php');
include('./controllers/authController.php');
include('./controllers/adminController.php');
include('./controllers/userController.php');


route('GET', '/', 'homeController');
route('GET', '/login', 'loginController');
route('GET', '/register', 'registerController');
route('GET', '/dashboard', 'dashboardController');
route('GET', '/users', 'userController');
route('GET', '/quotes', 'quotesController');
route('GET', '/berita', 'beritaController');
route('GET', '/tambah-user', 'tambahUserController');
route('GET', '/edit-user/{id}', 'editUserController');
route('GET', '/tambah-quote', 'tambahQuoteController');
route('GET', '/edit-quote/{id}', 'editQuoteController');
route('GET', '/tambah-berita', 'tambahBeritaController');
route('GET', '/edit-berita/{id}', 'editBeritaController');
route('GET', '/permission', 'permissionController');
route('GET', '/wait_permission', 'waitPermissionController');


route('POST', '/register', 'registerProses');
route('POST', '/login', 'loginProses');
// route('POST', '/logout', 'logoutProses');

// Admin Proses Controller
route('POST', '/tambah-user', 'tambahUserProses');
route('POST', '/edit-user/{id}', 'editUserProses');
route('GET', '/hapus-user/{id}', 'hapusUserProses');
route('POST', '/tambah-quote', 'tambahQuoteProses');
route('POST', '/edit-quote/{id}', 'editQuoteProses');
route('GET', '/hapus-quote/{id}', 'hapusQuoteProses');
route('POST', '/tambah-berita', 'tambahBeritaProses');
route('POST', '/edit-berita/{id}', 'editBeritaProses');
route('GET', '/hapus-berita/{id}', 'hapusBeritaProses');
route('POST', '/permission/{id}', 'editPermissionProses');

// user Controller
route('GET', '/kegiatan/{id}', 'kegiatanController');
route('GET', '/alumni', 'alumniController');
