
<?php

error_reporting(0);
define("HOME_PAGE", 'HomePage');
session_start();
require_once './config.php';
Router::loadcontroller();

?>
