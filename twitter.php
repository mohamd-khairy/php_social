<?php

session_start();
require_once './config.php';
require_once('libs/src_twitter/OAuth.php');
require_once('libs/src_twitter/twitteroauth.php');
/*
 * PART 2 - PROCESS
 * 1. check for logout
 * 2. check for user session  
 * 3. check for callback
 */

// 1. to handle logout request
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    session_destroy();
    header("location:index.php");
    die();
} else {
// 2. if user session not enabled get the login url
    if (!isset($_SESSION['data']) && !isset($_GET['oauth_token'])) {
        // create a new twitter connection object
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        // get the token from connection object
        $request_token = $connection->getRequestToken(OAUTH_CALLBACK);
        // if request_token exists then get the token and secret and store in the session
        if ($request_token) {
            $token = $request_token['oauth_token'];
            $_SESSION['request_token'] = $token;
            $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
            // get the login url from getauthorizeurl method
            $login_url = $connection->getAuthorizeURL($token);
        }
    }

// 3. if its a callback url
    if (isset($_GET['oauth_token'])) {
        // create a new twitter connection object with request token
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
        // get the access token from getAccesToken method
        $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
        if ($access_token) {
            // create another connection object with access token
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
            // set the parameters array with attributes include_entities false
            $params = array('include_entities' => 'false');
            // get the data
            $data = $connection->get('account/verify_credentials', $params);
            if ($data) {
                // store the data in the session
                $_SESSION['data'] = $data;
                // redirect to same page to remove url parameters
                $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
                header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
            }
        }
    }

    /*
     * PART 3 - FRONT END 
     *  - if userdata available then print data
     *  - else display the login url
     */

    if (isset($login_url) && !isset($_SESSION['data'])) {
        // echo the login url
        //echo "<a href='$login_url'><button>Login with twitter </button></a>";
        header('location: ' . $login_url);
    } else {
        // print_r($_SESSION['data']);
        $check = userModel::getAllDataby_key_and_value('u_f_name', $_SESSION['data']->screen_name);
        //print_r($check);
        if (!empty($check)) {
            $_SESSION['u_id'] = $check[0]['u_id'];
        } else {
            if(!empty($_SESSION['data'])){
            $user = new userModel();
            $user->u_username = '@' . $_SESSION['data']->screen_name;
            $user->u_f_name = $_SESSION['data']->screen_name;
            $user->u_s_name = "";
            $user->u_email = "";
            $user->u_city = $_SESSION['data']->location;
            $user->u_country = "";
            $user->u_gender = "";
            $user->u_password = md5("twitter");
            $user->u_img_cover = "background.jpg";
            $user->u_img_profile = "face.jpg";
            $user->u_bio = "";
            $id = $user->insert();
            if ($id > 0) {
                $_SESSION['u_id'] = $id;
            }
        }else{
        header("location:index.php");
            
        }}
        header("location:index.php");
    }
}