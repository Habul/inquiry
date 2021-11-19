<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'login';
// route 404 Error
$route['404_override'] = 'login/notfound';
$route['translate_uri_dashes'] = FALSE;
