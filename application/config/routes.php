<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'login';

// route login
$route['login'] = 'login';

// route dashboard
$route['dashboard'] = 'dashboard';

// // route untuk halaman blog
$route['blog'] = 'welcome/blog';
$route['blog/(:num)'] = 'welcome/blog/$1';

// // route untuk halaman Tracking
$route['driver'] = 'driver/mobil';
$route['driver/mobil_odo/(:num)'] = 'driver/mobil_odo/$1';

// route untuk halaman kategori artikel
$route['kategori/(:any)'] = 'welcome/kategori/$1';
$route['kategori/(:any)/(:num)'] = 'welcome/kategori/$1/$s2';

// route untuk halaman cari artikel
$route['search'] = 'welcome/search';
$route['search/(:any)'] = 'welcome/search/$1';
$route['search/(:any)/(:num)'] = 'welcome/search/$1/$2';

// route untuk halaman page
$route['page/(:any)'] = 'welcome/page/$1';

// route URL SEO untuk artikel
$route['(:any)'] = 'welcome/single/$1';

$route['404_override'] = 'login/notfound';
$route['translate_uri_dashes'] = FALSE;
