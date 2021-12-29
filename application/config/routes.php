<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'login';

// route login
$route['login'] = 'login';

// route dashboard
$route['dashboard'] = 'dashboard';

//Error 404 
$route['404_override'] = 'login/notfound';
$route['translate_uri_dashes'] = FALSE;
