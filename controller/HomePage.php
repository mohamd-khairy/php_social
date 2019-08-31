<?php

class HomePage {

    private $template;
    private $user;

    public function __construct() {
        $this->template = new Template();
        $this->user = new userModel();
        $this->valid = new Validation();
        // if (!isset($_POST['login'])) {
        //     if (!isset($_SESSION['u_id'])) {
        //       $this->template->render_ajax("login");
        //       //  header('location:login.php');
        //     }
        // }
    }

    function indexAction() {
        if (!isset($_SESSION['u_id'])) {
              $this->template->render_ajax("login");
              //  header('location:login.php');
            }else{
            $this->template->render("home");
    }}
      function loginAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if(isset($_SESSION['u_id'])){
                 header('location:index.php');
            }else{
            $user = $this->user->checkUser($_POST['user'], md5($_POST['password']));
            if (!empty($user)) {
                $_SESSION['u_id'] = $user[0]['u_id'];
                    //header('location:index.php');
                    $this->template->render("home");
                 
            } else {
                     //header('location:login.php');
                     $this->template->render_ajax("login");
            }
        }
        }
    }

    function logoutAction() {
        session_destroy();
       //header('location:index.php');
        $this->template->render_ajax("login");
    }

      function socialLoginAction() {
        switch ($_GET['social']) {
            case 'facebook':
                header('location:facebook.php');
                break;
            case 'twitter':
                header('location:twitter.php');
                break;
            case 'google':
                header('location:google.php');
                break;
            default:
                header('location:index.php');
                break;
        }
    }
    function searchAction() {
        $this->template->render("search");
    }

    function profileAction() {
        if (!isset($_GET['id'])) {
            $id = $_SESSION['u_id'];
        } else {
            $id = $_GET['id'];
        }
        $this->template->UserId = $id;
        $this->template->render('profile');
    }

    function updateProfileAction() {
        $this->template->render('update_profile');
    }

  

    function AddUserAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->user->u_username = '@' . $_POST['u_username'];
            $this->user->u_f_name = $_POST['u_f_name'];
            $this->user->u_s_name = $_POST['u_s_name'];
            $this->user->u_email = $_POST['u_email'];
            $this->user->u_city = $_POST['u_city'];
            $this->user->u_country = $_POST['u_country'];
            $this->user->u_gender = $_POST['u_gender'];
            $this->user->u_password = md5($_POST['u_password']);
            $this->user->u_img_cover = "background.jpg";
            $this->user->u_img_profile = "face.jpg";
            $this->user->u_bio = "";
            $id = $this->user->insert();
            if ($id > 0) {
                $_SESSION['u_id'] = $id;
                 header('location:index.php');
               // $this->template->render("home");
            }
        }
    }

    function UpdateProfileUserAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $id = $_POST['id_edit'];
            $UserData = userModel::get_Data_by_id($id);
            $this->user->u_id = $id;
            $this->user->u_username = $_POST['u_username'];
            $this->user->u_f_name = $_POST['u_f_name'];
            $this->user->u_s_name = $_POST['u_s_name'];
            $this->user->u_email = $_POST['u_email'];
            $this->user->u_city = $_POST['u_city'];
            $this->user->u_country = $_POST['u_country'];
            $this->user->u_gender = $UserData[0]['u_gender'];
            if ($_POST['u_password'] != $UserData[0]['u_password']) {
                $this->user->u_password = md5($_POST['u_password']);
            } else {
                $this->user->u_password = $_POST['u_password'];
            }
            $this->user->u_bio = $_POST['u_bio'];
            if (!empty($_FILES['img']['name'])) {
                $img = time() . rand(0, 1000) . $_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], Upload_FOLDER . DS . $img);
                $this->user->u_img_cover = $img;
                unlink(Upload_FOLDER . DS . $UserData[0]['u_img_cover']);
            } else {
                $this->user->u_img_cover = $UserData[0]['u_img_cover'];
            }
            if (!empty($_FILES['p_image']['name'])) {
                $img = time() . rand(0, 1000) . $_FILES['p_image']['name'];
                move_uploaded_file($_FILES['p_image']['tmp_name'], Upload_FOLDER . DS . $img);
                $this->user->u_img_profile = $img;
                unlink(Upload_FOLDER . DS . $UserData[0]['u_img_profile']);
            } else {
                $this->user->u_img_profile = $UserData[0]['u_img_profile'];
            }
            $this->user->update($id);
            $this->template->render('profile');
        }
    }

}
