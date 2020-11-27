<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*
|--------------------------------------------------------------------------
| Database table name
|--------------------------------------------------------------------------
|
| These database table name is for standardize all table name and easier for mangement 
|
*/

define('TABLE_USERS', 'users');
define('TABLE_USER_INFO', 'user_info');
define('TABLE_NOTIFY', 'notify');
define('TABLE_SERVICES', 'services');
define('TABLE_SERVICE_LINES', 'service_lines');
define('TABLE_PAYPAL', 'transaction_paypal');
define("TABLE_RULES", 'card_rules');
define("TABLE_PRODUCTS", 'products');
define("TABLE_VENDORS", 'vendors');
define("TABLE_PRODUCT_VENDOR", 'product_vendor');
define("TABLE_POINTS", 'points');
define("TABLE_SUBSCRIPTIONS", 'subscriptions');
define("TABLE_CUSTOMERS", 'customers');
define("TABLE_MESSAGES", 'messages');
define("TABLE_ORDERS", 'orders');
define("TABLE_PRODUCT_LINES", 'product_lines');


/* End of file constants.php */
/* Location: ./application/config/constants.php */