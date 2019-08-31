<?php
// Setting information
define("SERVER_IP", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "paper");
define("HostName", "http://localhost/social/");
define("PER_PAGE_COUNT", 20);

//Google
define("clientId", "687609519414-1m0kl0nianu21hsat2gt4h7qdtf0irmj.apps.googleusercontent.com"); //Google CLIENT ID
define("clientSecret", "f_oyCp_f1xUNmIcKDudvLBf6"); //Google CLIENT SECRET
define("redirectUrl", "http://localhost/social/google.php");  //return url (url to script)
//facebook
$appId = '2141764182713799'; //Facebook App ID
$appSecret = '5e616bfd10908cdb8e33c05814196c00'; // Facebook App Secret
$homeurl = 'http://localhost/social/facebook.php';  //return to home
$fbPermissions = 'email';  //Required facebook permissions
//twitter
define('CONSUMER_KEY', 'ZjA3853EF4ozlUBBx3pIW6ehp');
define('CONSUMER_SECRET', 'VV8NIejsnFi6vShpxk0u4l94t0IA80ryJWIZ94ub5xxBqb6S8X');
define('OAUTH_CALLBACK', 'http://localhost/social/twitter.php');



define("DS", DIRECTORY_SEPARATOR);
define("PS", PATH_SEPARATOR);
define("Controller_FOLDER", __DIR__ . DS . 'controller');
define("Upload_FOLDER", __DIR__ . DS . '/assets/img');
define("MODELS_FOLDER", __DIR__ . DS . 'models');
define("Views_FOLDER", __DIR__ . DS . 'views');
define("LIBS_FOLDER", __DIR__ . DS . 'libs');
define("Template_FOLDER", __DIR__ . DS . 'template');
define("Mail_FOLDER", __DIR__ . DS . 'libs/mailerClass');

define("ADMIN_FOLDER", __DIR__ . DS . 'admin');
define("ADMIN_Template", ADMIN_FOLDER . DS . 'Templates');
define("ADMIN_Views", ADMIN_FOLDER . DS . 'Views');
define("ADMIN_Models", ADMIN_FOLDER . DS . 'Models');
define("ADMIN_Controllers", ADMIN_FOLDER . DS . 'Controllers');


set_include_path(get_include_path() . PS . Mail_FOLDER . PS . ADMIN_Controllers . PS . ADMIN_Models . PS . Controller_FOLDER . PS . Views_FOLDER . PS . LIBS_FOLDER . PS . MODELS_FOLDER);

// autoload ..
function autoload($className) {
    require_once $className . '.php';
}

spl_autoload_register('autoload');



