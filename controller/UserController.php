<?php

class UserController {

    private $template;
    private $friend;
    private $chat;
    private $msg;

    public function __construct() {
        $this->template = new Template();
        $this->friend = new FriendsModel();
        $this->chat = new ChatModel();
        $this->msg = new MsgModel();

        if (!isset($_SESSION['u_id'])) {
            header('location:login.php');
        }
    }

    function indexAction() {
        $this->template->render("home");
    }

    function addfriendAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->friend->user_id1 = $_POST['user_id1'];
            $this->friend->user_id2 = $_POST['user_id2'];
            $this->friend->role = FALSE;
            if ($this->friend->insert() >= 1) {
                echo '11111';
            } else {
                echo '00000';
            }
        }
    }

    function confirmfriendAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $getrequest = FriendsModel::get_to_confirm_friend($_POST['user_id1'], $_SESSION['u_id']);
            if (!empty($getrequest)) {
                $this->friend->f_id = $getrequest[0]['f_id'];
                $this->friend->user_id1 = $_POST['user_id1'];
                $this->friend->user_id2 = $_SESSION['u_id'];
                $this->friend->role = TRUE;
                if ($this->friend->update($getrequest[0]['f_id']) >= 1) {
                    echo '11111';
                } else {
                    echo '00000';
                }
            } else {
                header('location:index.php');
            }
        }
    }

    function unfriendAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->friend->delete_friend($_SESSION['u_id'], $_POST['user_id2']);
        }
    }

    function getFrienRequestAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            echo count(FriendsModel::get_all_friend_request());
        }
    }

    function showAllRequestAction() {
        $this->template->render("allrequest");
    }

    function addchatAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $case1 = ChatModel::get_data_by_two_value('u_id1', $_SESSION['u_id'], 'u_id2', $_POST['u_id']);
            $case2 = ChatModel::get_data_by_two_value('u_id2', $_SESSION['u_id'], 'u_id1', $_POST['u_id']);
            if (empty($case1) && empty($case2)) {
                $this->chat->u_id1 = $_SESSION['u_id'];
                $this->chat->u_id2 = $_POST['u_id'];
                $this->chat->chat_datetime = date(DateTime::ATOM);
                echo $_SESSION["chat_id"] = $this->chat->insert();
            } else {
                if (!empty($case1)) {
                    $chat = $case1;
                } else {
                    $chat = $case2;
                }
                echo $_SESSION["chat_id"] = $chat[0]['chat_id'];
            }
        }
    }

    function updateMsgAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $msgdata = MsgModel::getAllDataby_key_and_value('chat_id',$_POST['chat_id'] );
            if (!empty($msgdata)) {
                foreach ($msgdata as $m) {
                    $this->msg->msg_id = $m['msg_id'];
                    $this->msg->chat_id = $m['chat_id'];
                    $this->msg->u_id = $m['u_id'];
                    $this->msg->msg_datetime = $m['msg_datetime'];
                    $this->msg->msg_text = $m['msg_text'];
                    $this->msg->role = TRUE;
                    $this->msg->update($m['msg_id']);
                }
            }
        }
    }

    function addmsgAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->msg->chat_id = $_SESSION['chat_id'];
            $this->msg->u_id = $_SESSION['u_id'];
            $this->msg->msg_datetime = date(DateTime::ATOM);
            $this->msg->msg_text = $_POST['message'];
            $this->msg->role = FALSE;
            $this->msg->insert();

            $user = userModel::get_Data_by_id($_SESSION['u_id'])[0];
            echo $data = '<div class = "direct-chat-msg" >
                                    <div class = "direct-chat-info clearfix" >
                                    <span class = "direct-chat-name pull-left" >' . $user['u_f_name'] . " " . $user['u_s_name'] . '</span>
                                        <span class = "direct-chat-timestamp pull-right" >' . date("d M h:I A", strtotime(date(DateTime::ATOM))) . '</span>
                                    </div>
                                    <img class = "direct-chat-img" src = "' . HostName . DS . 'assets/img' . DS . $user["u_img_profile"] . '" >
                                    <div class = "direct-chat-text" >
                                    ' . $_POST['message'] . '
                                    </div>
                                </div>';
        }
    } 

    function get_msg_chatAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $case1 = ChatModel::get_data_by_two_value('u_id1', $_SESSION['u_id'], 'u_id2', $_POST['u_id']);
            $case2 = ChatModel::get_data_by_two_value('u_id2', $_SESSION['u_id'], 'u_id1', $_POST['u_id']);
            if (!empty($case1)) {
                $chat = $case1;
            } else {
                $chat = $case2;
            }
            $msgdata = MsgModel::getAllDataby_key_and_value('chat_id', $chat[0]['chat_id']);
            if (!empty($msgdata)) {
                $data = " ";
                foreach ($msgdata as $m) {
                    $user = userModel::get_Data_by_id($m['u_id'])[0];
                    if ($m['u_id'] == $_SESSION['u_id']) {
                        $data.='<div class = "direct-chat-msg" >
                                    <div class = "direct-chat-info clearfix" >
                                    <span class = "direct-chat-name pull-left" >' . $user['u_f_name'] . " " . $user['u_s_name'] . '</span>
                                        <span class = "direct-chat-timestamp pull-right" >' . date("d M h:I A", strtotime($m['msg_datetime'])) . '</span>
                                    </div>
                                    <img class = "direct-chat-img" src = "' . HostName . DS . 'assets/img' . DS . $user["u_img_profile"] . '" >
                                    <div class = "direct-chat-text" >
                                    ' . $m['msg_text'] . '
                                    </div>
                                </div>';
                    } else {
                        $data.='<div class = "direct-chat-msg right" >
                                    <div class = "direct-chat-info clearfix" >
                                        <span class = "direct-chat-name pull-right" >' . $user['u_f_name'] . " " . $user['u_s_name'] . '</span>
                                        <span class = "direct-chat-timestamp pull-left" >' . date("d M h:I A", strtotime($m['msg_datetime'])) . '</span>
                                    </div>
                                    <img class = "direct-chat-img" src = "' . HostName . DS . 'assets/img' . DS . $user["u_img_profile"] . '" >
                                    <div  style"background:#3c8dbc;border-color:#3c8dbc;" class = "direct-chat-text" >
                                       ' . $m['msg_text'] . '
                                    </div>
                                </div>';
                    }
                }
                echo $data;
            }
        }
    }

    function check_msg_chatAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $case1 = ChatModel::get_data_by_two_value('u_id1', $_SESSION['u_id'], 'u_id2', $_POST['u_id']);
            $case2 = ChatModel::get_data_by_two_value('u_id2', $_SESSION['u_id'], 'u_id1', $_POST['u_id']);
            if (!empty($case1)) {
                $chat = $case1;
            } else {
                $chat = $case2;
            }
            $msgdata = MsgModel::getAllDataby_key_and_value('chat_id', $chat[0]['chat_id']);
            $i = FALSE;
            foreach ($msgdata as $m) {
                if ($m['role'] == 0) {
                    $i = TRUE;
                }
            }
            if ($i == TRUE) {
// if (count($msgdata) > $_SESSION['countmsg']) {
                echo 11111;
            }
        }
    }

    function get_un_readmsgAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $i = 0;
            $case1 = ChatModel::getAllDataby_key_and_value('u_id1', $_SESSION['u_id']);
            $case2 = ChatModel::getAllDataby_key_and_value('u_id2', $_SESSION['u_id']);
            $chats = array_merge($case1, $case2);
            foreach ($chats as $c) {
                if (!empty(MsgModel::get_un_readmsg($c['chat_id']))) {
                    $i+=1;
                }
            }
            echo $i;
        }
    }

//    function get_user_emailAction() {
//        $case1 = ChatModel::getAllDataby_key_and_value('u_id1', $_SESSION['u_id']);
//        $case2 = ChatModel::getAllDataby_key_and_value('u_id2', $_SESSION['u_id']);
//        $chats = array_merge($case1, $case2);
//        foreach ($chats as $c) {
//            $msgdata = MsgModel::get_un_readmsg($c['chat_id']);
//            if (!empty($msgdata)) {
//                $u = userModel::get_Data_by_id($msgdata[0]['u_id'])[0];
//                echo '
//                <li><a href = "#" onclick=" addchat('. $u['u_id'] .',"'. $u['u_f_name'] . " " . $u['u_s_name'].'")">
//                ' . $u['u_f_name'] . " " . $u['u_s_name'] . '
//                <br />
//                <span class="text-muted"><small>' . $u['u_username'] . '</small></span>
//                </a> </li>';
//            }
//        }
//    }
}
