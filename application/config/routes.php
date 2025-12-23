<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['reservation/(:any)'] = 'reservation/index';

// Controller: Reservation.php
// $route['reservation/reservationCreate'] = 'Reservation/create';
// $route['reservation/createReservation'] = 'Reservation/create';

// $route['reservation/edit']   = 'reservation/edit';
$route['reservation/create'] = 'reservation/create';

$route['reservation/editReservation'] = 'reservation/editReservation';



// $route['discount/(:any)'] = 'Discount/index/$1';
// $route['discount/create'] = 'Discount/createDiscount';
// $route['discount/store'] = 'Discount/store';

$route['discount/edit/(:num)'] = 'Discount/editDiscount/$1';

// $route['discount/update'] = 'Discount/update';
// $route['discount']               = 'discount/index';
// $route['discount/create']        = 'discount/create';
// $route['discount/store']         = 'discount/store';
// $route['discount/edit/(:num)']   = 'discount/edit/$1';
// $route['discount/update']        = 'discount/update';

$route['hotel/edithotel'] = 'Hotel/edithotel';
$route['hotel/update'] = 'Hotel/update';

$route['room/create'] = 'Rooms/create';
$route['room/editRoom'] = 'Rooms/edit';


// $route['services'] = 'services/index';
$route['services/create'] = 'services/create';
$route['services/store']  = 'services/store';
$route['user/edit'] = 'user/editUser';
// $route['login'] = 'auth/login';

$route['staff'] = 'staff';

$route['login'] = 'auth/login';
$route['login/post']   = 'login/login_post';
$route['logout']       = 'login/logout';


$route['dashboard']            = 'dashboard/index';


$route['dashboard/users']      = 'dashboard/index';
$route['dashboard/user']       = 'dashboard/show';
$route['dashboard/user/(:num)']= 'dashboard/show/$1';

$route['dashboard/user/details'] = 'dashboard/userAllDetails';


$route['create'] = 'dashboard/create';
$route['edit'] = 'dashboard/edit';
$route['store']      = 'dashboard/store';
$route['update'] = 'dashboard/update';

$route['dashboard/edit']       = 'dashboard/edit';
$route['dashboard/edit/(:num)']= 'dashboard/edit/$1';

$route['dashboard/update']     = 'dashboard/update';


$route['dashboard/delete']     = 'dashboard/softDelete';
