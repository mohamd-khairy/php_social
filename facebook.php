<?php

session_start();
require_once './config.php';
include_once("libs/src_facebook/facebook.php");
$facebook = new Facebook(array(
    'appId' => $appId,
    'secret' => $appSecret
        ));
$fbuser = $facebook->getUser();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:index.php");
}

if (!$fbuser) {
    $fbuser = null;
    $loginUrl = $facebook->getLoginUrl(array('redirect_uri' => $homeurl, 'scope' => $fbPermissions));
    header('location: ' . $loginUrl);
//$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
} else {
    $user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
//    $check = userModel::getAllDataby_key_and_value('email', $user_profile['email']);
//    //print_r($check);
//    if (!empty($check)) {
//        $_SESSION['user'] = $check[0];
//    } else {
//        $user = new userModel();
//        $user->name = $userProfile['name'];
//        $user->email = $userProfile['email'];
//        $user->type="facebook";
//        $user->address = NULL;
//        $user->mobile = NULL;
//        $user->password = NULL;
//        if ($user->insert() >= 1) {
//            $_SESSION['user'] = $userProfile;
//        }
//    }
    print_r($user_profile);
}
?>