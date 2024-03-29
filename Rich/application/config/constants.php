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


/* End of file constants.php */
/* Location: ./application/config/constants.php */

/* 環境  */
define('IS_DEVELOPED', ($_SERVER['SERVER_NAME']=='localhost')?TRUE:FALSE );

// DB SETUP
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rich');

/* Parameters */
define('DATA_PER_PAGE', 10);
define('ABS_STR_LENGTH', 50);

/* DIR */
define('DIR_UPLOAD', 'upload/');
define('DIR_IMAGE', 'image/');

define('UPLOAD_PATH', FCPATH.DIR_UPLOAD);

/* Function */
define('M_G_POST', '文章');
define('M_POST', '文章');
define('M_POST_E', 'Posts');

/* System */
define('SPLASH', (strtoupper(substr(PHP_OS,0,3)=='WIN')) ? '\\' : '/');
define('ERR_MSG_PREFIX', '<span class="err_msg">');
define('ERR_MSG_SUFFIX', '</span>');

// define('DIR_CONFIG_ADDITION', 'config/addition/');
// include APPPATH.DIR_CONFIG_ADDITION."file.php";