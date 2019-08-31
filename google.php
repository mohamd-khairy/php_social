<?php

session_start();
require_once './config.php';
require_once("libs/src_google/Google_Client.php");
require_once("libs/src_google/contrib/Google_Oauth2Service.php");


$gClient = new Google_Client();
$gClient->setApplicationName('Login');
$gClient->setClientId(clientId);
$gClient->setClientSecret(clientSecret);
$gClient->setRedirectUri(redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
//1
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:index.php");
}

if (isset($_REQUEST['code'])) {
    $gClient->authenticate();
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var(redirectUrl, FILTER_SANITIZE_URL));
}
//2
if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}
//3
if ($gClient->getAccessToken()) {
    $userProfile = $google_oauthV2->userinfo->get();
    $check = userModel::getAllDataby_key_and_value('u_email', $userProfile['email']);
    //print_r($check);
    if (!empty($check)) {
        $_SESSION['u_id'] = $check[0]['u_id'];
         header("location:index.php");
    } else {
        $user = new userModel();
        $user->u_username = '@' . $userProfile['name'];;
        $user->u_f_name = $userProfile['name'];;
        $user->u_s_name = "";
        $user->u_email =  $userProfile['email'];
        $user->u_city = "";
        $user->u_country ="";
        $user->u_gender ="";
        $user->u_password = md5("google");
        $user->u_img_cover = "background.jpg";
        $user->u_img_profile = "face.jpg";
        $user->u_bio = "";
        $id = $user->insert();
        if ($id > 0) {
            $_SESSION['u_id'] = $id;
            header("location:index.php");
        }
    }
} else {
    $authUrl = $gClient->createAuthUrl();
}
//4
if (isset($authUrl)) {
    header('location: ' . $authUrl);
} else {
    header('location:index.php');
}
?>