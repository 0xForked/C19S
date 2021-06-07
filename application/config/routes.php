<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['login'] = 'Auth/LoginController/index';
$route['logout']['POST'] = 'Auth/LogoutController/index';

$route['home'] = 'Dash/HomeController/index';

$route['references/explanations'] = 'Dash/ReferencesExplanationController/index';
$route['references/explanations/create']['POST'] = 'Dash/ReferencesExplanationController/create';

$route['references/checkups'] = 'Dash/ReferenceCheckupController/index';
$route['references/checkups/create'] = 'Dash/ReferenceCheckupController/create';

$route['patients'] = 'Dash/PatientController/index';
$route['patients/(:num)'] = 'Dash/PatientController/show/$1';
$route['patients/create']['POST'] = 'Dash/PatientController/create';
$route['patients/(:num)/delete'] = 'Dash/PatientController/destroy/$1';

$route['samples'] = 'Dash/SampleController/index';
$route['samples/(:num)'] = 'Dash/SampleController/show/$1';
$route['samples/create'] = 'Dash/SampleController/create';
$route['samples/(:num)/delete'] = 'Dash/SampleController/destroy/$1';
$route['samples/labeled'] = 'Dash/SampleController/labeled';
$route['samples/verified'] = 'Dash/SampleController/verified';
$route['samples/(:num)/print'] = 'Dash/SampleController/print/$1';

$route['users/accounts'] = 'Dash/UserAccountController/index';
$route['users/accounts/create']['POST'] = 'Dash/UserAccountController/create';
$route['users/accounts/(:num)'] = 'Dash/UserAccountController/show/$1';
$route['users/accounts/(:num)/delete'] = 'Dash/UserAccountController/destroy/$1';

$route['users/roles'] = 'Dash/UserRoleController/index';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
