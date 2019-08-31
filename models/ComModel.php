<?php

class ComModel extends Basictable {

    static protected $table_name = "comment";
    static protected $primary = "com_id";
    public $primary_key = "com_id";
    public $fields = array('com_id', 'com_text', 'com_datetime', 'u_id', 'p_id', 'comment');
    public $com_id;
    public $com_text;
    public $com_datetime;
    public $u_id;
    public $p_id;
    public $comment;

    static public function get_notify_comment($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from comment,posts,user where comment.comment=0 and comment.p_id=posts.p_id and posts.u_id='{$id}' and user.u_id=comment.u_id ORDER BY comment.com_id desc")->fetchAll(PDO::FETCH_ASSOC);
    }

}
