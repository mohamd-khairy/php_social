<?php

class LikeModel extends Basictable {

    static protected $table_name = "likes";
    static protected $primary = "l_id";
    public $primary_key = "l_id";
    public $fields = array('u_id', 'p_id','like_datetime','like_role');
    public $l_id;
    public $u_id;
    public $p_id;
    public $like_role;
    public $like_datetime;

    static public function get_notify_like($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from likes,posts,user where   likes.like_role=0 and likes.p_id=posts.p_id and posts.u_id='{$id}' and user.u_id=likes.u_id ORDER BY likes.l_id desc")->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getAllData_like_user($value) {
        return DatabaseManager::getInstance()->dbh->query("select * from likes,user where likes.p_id=$value and likes.u_id=user.u_id")->fetchAll(PDO::FETCH_ASSOC);
    }

}
