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

date_default_timezone_set('Asia/Taipei');

/* 開發環境專用  */
define('IS_DEVELOPED', ($_SERVER['SERVER_NAME']=='localhost')?TRUE:FALSE );

// DB SETUP
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rich');

/* Parameters */
define('DATA_PER_PAGE', 10);

/* DIR */
define('DIR_CSS', 'css/');
define('DIR_JS', 'js/');
define('DIR_IMAGE', 'image/');

/* function define */
define('M_C_NORMAL', '一般');
define('M_INDEX', '首頁');
define('M_CONTENT', '文章區');

/* system define */
define('ERR_MSG_PREFIX', '<span class="err_msg">');
define('ERR_MSG_SUFFIX', '</span>');

/* System Parameters */
define('SPLASH', (strtoupper(substr(PHP_OS,0,3)=='WIN')) ? '\\' : '/');
$path = explode(SPLASH, realpath(__FILE__));
array_splice($path, count($path)-3);
define('CODE_BASE', join(SPLASH,$path).SPLASH);
