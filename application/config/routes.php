<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['reservation/create'] = 'reservation/create';

$route['reservation/editReservation'] = 'reservation/editReservation';




$route['discount/edit/(:num)'] = 'Discount/editDiscount/$1';


$route['hotel/edithotel'] = 'Hotel/edithotel';
$route['hotel/update'] = 'Hotel/update';

$route['room/create'] = 'Rooms/create';
$route['room/editRoom'] = 'Rooms/edit';


$route['services/create'] = 'services/create';
$route['services/store']  = 'services/store';
$route['user/edit'] = 'user/editUser';


$route['staff'] = 'staff';

$route['login'] = 'auth/login';
$route['login/post']   = 'login/login_post';
$route['logout']       = 'login/logout';




$route['user'] = 'dashboard/index';
$route['dashboard/users']      = 'dashboard/index';
$route['dashboard/user']       = 'dashboard/show';
$route['dashboard/user/(:num)']= 'dashboard/show/$1';

$route['dashboard/user/details'] = 'dashboard/userAllDetails';

$route['permission/create'] = 'permission/create';
$route['permission/update'] = 'permission/update';
$route['permission/assignPermissionStore'] = 'permission/assignPermissionStore';
$route['permission/edit'] = 'permission/edit';

$route['create'] = 'dashboard/create';
$route['edit'] = 'dashboard/edit';
$route['show'] = 'dashboard/user';
$route['store']      = 'dashboard/store';
$route['update'] = 'dashboard/update';
$route['user/softDelete/(:num)'] = 'User/softDelete/$1';

$route['softDelete'] = 'dashboard/softDelete';

$route['dashboard/edit']       = 'dashboard/edit';
$route['dashboard/edit/(:num)']= 'dashboard/edit/$1';

$route['dashboard/update']     = 'dashboard/update';


$route['dashboard/delete']     = 'dashboard/softDelete';

$route['room/delete'] = 'Rooms/delete';


$route['reservation/delete/(:num)'] = 'reservation/delete/$1';

