<?php

class PostController {

    private $template;
    private $post;
    private $imgpost;
    private $com;
    private $like;

    public function __construct() {
        $this->template = new Template();
        $this->valid = new Validation();
        $this->post = new PostModel();
        $this->imgpost = new ImgPostModel();
        $this->com = new ComModel();
        $this->like = new LikeModel();
        if (!isset($_SESSION['u_id'])) {
            header('location:login.php');
        }
    }

    function indexAction() {
        $this->template->render("home");
    }

    function AddPostAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->post->p_text = $_POST['p_text'];
            $this->post->p_datetime = date(DateTime::ATOM);
            $this->post->u_id = $_SESSION['u_id'];
            $p_id = $this->post->insert();
            if ($p_id >= 1) {
                if (!empty($_FILES['imgPost']["tmp_name"][0])) {
                    $check = TRUE;
                    foreach ($_FILES["imgPost"]["tmp_name"] as $key => $tmp_name) {
                        $file_name = $_FILES["imgPost"]["name"][$key];
                        $file_tmp = $_FILES["imgPost"]["tmp_name"][$key];
                        $imge = time() . rand(0, 100000) . $file_name;
                        move_uploaded_file($file_tmp, Upload_FOLDER . DS . $imge);
                        $this->imgpost->imgpost = $imge;
                        $this->imgpost->p_id = $p_id;
                        if ($this->imgpost->insert() < 0) {
                            $this->imgpost->delete_special('p_id', $p_id);
                            $this->post->delete($p_id);
                            $check = FALSE;
                            break;
                        }
                    }
                    if ($check == TRUE) {
                        echo '11111';
                        $_SESSION['lastpostid'] = $p_id;
                    } else {
                        echo '00000';
                    }
                } else {
                    echo '11111';
                    $_SESSION['lastpostid'] = $p_id;
                }
                die();
            } else {
                echo '00000';
                die();
            }
            $this->template->render("home");
        }
    }

    function GetPostDataAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $postdata = PostModel::get_Data_by_id($_SESSION['lastpostid'])[0];
            $imgforlastpost = ImgPostModel::getAllDataby_key_and_value('p_id', $_SESSION['lastpostid']);
            if (!empty($imgforlastpost)) {
                $output = array_merge($postdata, $imgforlastpost[0]);
            } else {
                $output = $postdata;
            }
            echo implode("|", $output);
            unset($_SESSION['lastpostid']);
        }
    }

    function addCommentAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->com->com_datetime = date(DateTime::ATOM);
            $this->com->com_text = $_POST['com_text'];
            $this->com->p_id = $_SESSION['last_p_id'];
            $this->com->u_id = $_SESSION['u_id'];
            $this->com->comment = FALSE;
            if ($this->com->insert() >= 1) {
                echo '11111';
            } else {
                echo '00000';
            }
        }
    }

    function getCommentAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_SESSION['last_p_id'] = $_POST['p_id']; //foe comment modal
            $comments = ComModel::getAllDataby_key_and_value('p_id', $_POST['p_id']);
            foreach ($comments as $com) {
                $user = userModel::get_Data_by_id($com['u_id'])[0];
                echo' <p class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="width: 100%" >
                                        <a href="index.php?rt=HomePage/search&id= ' . $user['u_id'] . '" class="name">
                                            <img  src="' . HostName . DS . 'assets/img/' . $user['u_img_profile'] . '" style="width: 50px;height: 50px;margin: 6px" class="img-responsive img-circle img-sm pull-left" >
                                            <small class="text-muted pull-right" style="color:black"><i class="fa fa-clock-o"></i>' . date('h:i A', strtotime($com['com_datetime'])) . '</small>
                                           ' . $user['u_f_name'] . " " . $user['u_s_name'] . '
                                        </a>
                                        ' . $com['com_text'] . '</p>';
            }
        }
    }

    function deletePostAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $d = $this->post->delete($_POST['p_id']);
            if ($d > 0) {
                $dataimg = ImgPostModel::getAllDataby_key_and_value('p_id', $_POST['p_id']);
                if (!empty($dataimg)) {
                    if ($this->imgpost->delete_special('p_id', $_POST['p_id']) > 0) {
                        foreach ($dataimg as $i) {
                            unlink(Upload_FOLDER . DS . $i['imgpost']);
                        }
                    }
                }
                // unlink(Upload_FOLDER . DS . $dataimg[0]['imgpost']);
                $this->com->delete_special('p_id', $_POST['p_id']);
                $this->like->delete_special('p_id', $_POST['p_id']);
                echo '11111';
            } else {
                echo '00000';
            }
        }
    }

    function getNewPostsAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $friends[] = array("user" => $_SESSION['u_id']);
            $friends1 = FriendsModel::getFriend1($_SESSION['u_id']);
            $friends2 = FriendsModel::getFriend2($_SESSION['u_id']);
            $allFriend = array_merge($friends, $friends1, $friends2);
//            print_r($allFriend);
            $allpost = PostModel::getAllData_By_reverse();
            $i = 0;
            foreach ($allpost as $p) {
                foreach ($allFriend as $af) {
                    if ($af['user'] == $p['u_id']) {
                        if ((date('H:i:s', strtotime($p['p_datetime'])) > ($_POST['time'])) && (date('d-m-Y', strtotime($p['p_datetime'])) == date('d-m-Y') )) {
                            if ($p['u_id'] != $_SESSION['u_id']) {
                                $i+=1;
                            }
                        }
                    }
                }
            }
            echo $i;
            //    echo date('H:i:s', strtotime($p['p_datetime'])) . " | " . $_POST['time'];
        }
    }

    function addlikeAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->like->u_id = $_SESSION['u_id'];
            $this->like->p_id = $_POST['p_id'];
            $this->like->like_datetime = date(DateTime::ATOM);
            $this->like->like_role = FALSE;
            if ($this->like->insert() >= 1) {
                echo '11111';
            } else {
                echo '00000';
            }
        }
    }

    function unlikeAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if ($this->like->delete(LikeModel::get_data_by_two_value('u_id', $_SESSION['u_id'], 'p_id', $_POST['p_id'])[0]['l_id']) >= 1) {
                echo '11111';
            } else {
                echo '00000';
            }
        }
    }

    function like_last_postAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->like->u_id = $_SESSION['u_id'];
            $this->like->p_id = $_POST['p_last_id'];
            $this->like->like_datetime = date(DateTime::ATOM);
            $this->like->like_role = FALSE;
            $this->like->insert();
            header("location:" . $_SERVER['HTTP_REFERER']);
        }
    }

    function editpostAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $dataimg = ImgPostModel::getAllDataby_key_and_value('p_id', $_POST['p_id']);
            if (!empty($dataimg)) {
                $data = PostModel::get_Data_from_post_and_img($_POST['p_id']);
            } else {
                $data = PostModel::get_Data_by_id($_POST['p_id']);
            }
            $_SESSION['p_last_id_edit'] = $_POST['p_id'];
            echo implode('|', $data[0]);
        }
    }

    function updatePostAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $data = PostModel::get_Data_by_id($_SESSION['p_last_id_edit']);
            $this->post->p_id = $_SESSION['p_last_id_edit']; //$_POST['p_id_edit'];
            $this->post->p_text = $_POST['p_text_edit'];
            $this->post->p_datetime = $data[0]['p_datetime']; //date(DateTime::ATOM);
            $this->post->u_id = $_SESSION['u_id'];
            if (!empty($_POST['p_text_edit'])) {
                $this->post->update($_POST['p_id_edit']);
            }
            if (!empty($_FILES["imgPost_edit"]["tmp_name"])) {
                $data_img = ImgPostModel::getAllDataby_key_and_value('p_id', $_POST['p_id_edit']);
                if (!empty($data_img)) {
                    unlink(Upload_FOLDER . DS . $data_img[0]['imgpost']);
                    $this->imgpost->imgpost_id = $data_img[0]['imgpost_id'];
                    $img = time() . rand(0, 1000) . $_FILES['imgPost_edit']['name'];
                    move_uploaded_file($_FILES["imgPost_edit"]["tmp_name"], Upload_FOLDER . DS . $img);
                    $this->imgpost->imgpost = $img;
                    $this->imgpost->p_id = $_SESSION['p_last_id_edit'];
                    $this->imgpost->update($data_img[0]['imgpost_id']);
                } else {
                    $img = time() . rand(0, 1000) . $_FILES['imgPost_edit']['name'];
                    move_uploaded_file($_FILES["imgPost_edit"]["tmp_name"], Upload_FOLDER . DS . $img);
                    $this->imgpost->imgpost = $img;
                    $this->imgpost->p_id = $_SESSION['p_last_id_edit'];
                    $this->imgpost->insert();
                }
            }
            unset($_SESSION['p_last_id_edit']);
            // $this->template->render("home");
            header("location:" . $_SERVER['HTTP_REFERER']);
        }
    }

    function shownotificationAction() {
        $this->template->render('notification');
    }

    function getNotifyAction() {
        $likenoti = LikeModel::get_notify_like($_SESSION['u_id']);
        $comnoti = ComModel::get_notify_comment($_SESSION['u_id']);
        $allnoty = array_merge($likenoti, $comnoti);
        echo count($allnoty);
    }

    function showPostForNotificationAction() {
        if (!empty($_GET['id']) && intval($_GET['id']) && isset($_GET['type'])) {
            if ($_GET['type'] == 'like') {
                $datalike = LikeModel::get_data_by_two_value('l_id', intval($_GET['id']), 'like_role', 0);
                $this->like->l_id = $datalike[0]['l_id'];
                $this->like->like_datetime = $datalike[0]['like_datetime'];
                $this->like->p_id = $datalike[0]['p_id'];
                $this->like->u_id = $datalike[0]['u_id'];
                $this->like->like_role = TRUE;
                $this->like->update($_GET['id']);
                $this->template->post_id = $datalike[0]['p_id'];
            } elseif ($_GET['type'] == 'comment') {
                $datacomment = ComModel::get_data_by_two_value('com_id', intval($_GET['id']), 'comment', 0);
                $this->com->com_id = $datacomment[0]['com_id'];
                $this->com->com_text = $datacomment[0]['com_text'];
                $this->com->com_datetime = $datacomment[0]['com_datetime'];
                $this->com->comment = TRUE;
                $this->com->p_id = $datacomment[0]['p_id'];
                $this->com->u_id = $datacomment[0]['u_id'];
                $this->com->update($_GET['id']);
                $this->template->post_id = $datacomment[0]['p_id'];
            } else {
                die();
            }
            $this->template->type = $_GET['type'];
            $this->template->render('showpost');
        } else {
            die();
        }
    }

    function showpostAction() {
        if (isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id'])) {
            $this->template->post_id = $_GET['id'];
            $this->template->type = 'like';
            $this->template->render('showpost');
        } else {
            die();
        }
    }

}
