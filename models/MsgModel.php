<?php

class MsgModel extends Basictable {

    static protected $table_name = "msg";
    static protected $primary = "msg_id";
    public $primary_key = "msg_id";
    public $fields = array('msg_id', 'u_id', 'chat_id', 'msg_text','msg_datetime','role');
    public $chat_id;
    public $u_id;
    public $msg_id;
    public $msg_text;
    public $msg_datetime;
    public $role;

    static public function get_un_readmsg($chat_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from msg where (chat_id={$chat_id} and role=0 and u_id !={$_SESSION['u_id']})")->fetchAll();
    }
}
