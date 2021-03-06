<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['aboutus'] = 'Home/aboutus';
$route['merchant_account'] = 'Home/merchant_account';
$route['merchant_add_offer'] = 'Home/merchant_add_offer';
$route['merchant_add_coupon'] = 'Home/merchant_add_coupon';
$route['merchant_register'] = 'Home/merchant_register';
$route['user_change_password'] = 'Home/user_change_password';
$route['user_profile'] = 'Home/user_profile';
$route['contact_us'] = 'Home/contact_us';
$route['privacy_policy'] = 'Home/privacy_policy';
$route['disclaimer'] = 'Home/disclaimer';
$route['user_coupons'] = 'Home/user_coupons';
$route['category/(:any)'] = 'Home/category/$1';
$route['subcategory/(:any)'] = 'Home/subcategory/$1';
$route['advertise'] = 'Home/advertise';
$route['listoffers'] = 'Home/listoffers';
$route['search'] = 'Home/search';
$route['media'] = 'Home/media';
$route['merchant_settings'] = 'Home/merchant_settings';
$route['faq'] = 'Home/faq';
$route['deal/(:any)'] = "Home/deal/$1";
$route['testimonials'] = 'Home/testimonials';
$route['merchant_offers_added'] = 'Home/merchant_offers_added';
$route['users_with_coupons'] = 'Home/users_with_coupons';
$route['merchant_coupons_issued'] = 'Home/merchant_coupons_issued';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
