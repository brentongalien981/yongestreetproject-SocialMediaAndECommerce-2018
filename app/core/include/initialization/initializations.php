<?php
// ob_end_flush();
// ob_implicit_flush();

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
//defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);


/* Constants */
//// For XAMPP
//defined('SITE_ROOT') ? null : define('SITE_ROOT', '/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/CuteNinjar/');

// For MAMP
defined('SITE_ROOT') ? null : define('SITE_ROOT', '/Applications/MAMP/htdocs/myPersonalProjects/yongestreetproject/');

define('APP_PATH', SITE_ROOT . 'app/');
define('CONTROLLER_PATH', SITE_ROOT . 'app/controller/');
define('MODEL_PATH', SITE_ROOT . 'app/model/');
define('CORE_PATH', SITE_ROOT . 'app/core/');
define('INCLUDE_PATH', SITE_ROOT . 'app/core/include/');
define('PUBLIC_PATH', SITE_ROOT . 'app/public/');
define('CSS_PATH', PUBLIC_PATH . 'css/');
define('IMG_PATH', PUBLIC_PATH . 'img/');
define('JS_PATH', PUBLIC_PATH . 'js/');
define('LAYOUT_PATH', PUBLIC_PATH . 'layout/');



defined('LOCAL') ? null : define('LOCAL', 'http://localhost/myPersonalProjects/yongestreetproject/');
defined('PUBLIC_LOCAL') ? null : define('PUBLIC_LOCAL', LOCAL . 'app/public/');


define('IN_DEVELOPMENT', true);


// 
//session_start();
// TODO: SECTION: My Global Vars.
//use App\Controller\UserController;
//new UserController();
//global $user_controller;
//$user_controller = new UserController();
// use App\Model\Session;
// global $session;
// $session = new Session();





// Required Files
// require_once(INCLUDE_PATH . 'initialization/config.php');

require_once(INCLUDE_PATH . 'helper-functions/functions_general.php');
require_once(INCLUDE_PATH . 'helper-functions/functions_sqli_escape.php');
require_once(INCLUDE_PATH . 'helper-functions/functions_validation.php');
require_once(INCLUDE_PATH . 'helper-functions/functions_validation2.php');
require_once(INCLUDE_PATH . 'helper-functions/functions_xss_sanitize.php');

require_once(INCLUDE_PATH . 'helper-functions/functions_csrf_request_type.php');
require_once(INCLUDE_PATH . 'helper-functions/functions_csrf_token.php');
require_once(INCLUDE_PATH . 'helper-functions/icon_manager.php');


// require_once(INCLUDE_PATH . 'swiftmailer/config.php');








//require_once(MODEL_PATH . 'my_debug_messenger.php');
//require_once(MODEL_PATH . 'my_validation_error_logger.php');
//require_once(MODEL_PATH . 'my_database.php');
//require_once(MODEL_PATH . 'my_user.php');



// require_once(CORE_PATH . 'validation/Validator.php');
// require_once(CONTROLLER_PATH . 'SearchController.php');



// TODO: SECTION: My Global Vars.
// use App\Core\Middleware\MainMiddleware;
// global $middleware;
// $middleware = new MainMiddleware();

// use App\Model\MySQLDatabase;
// global $database;
// $database = new MySQLDatabase();
?>