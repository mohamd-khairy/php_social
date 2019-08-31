<?php

class PostModel extends Basictable {

    static protected $table_name = "posts";
    static protected $primary = "p_id";
    public $primary_key = "p_id";
    public $fields = array('p_id', 'p_text', 'p_datetime', 'u_id');
    public $p_id;
    public $p_text;
    public $p_datetime;
    public $u_id;

    static public function get_Data_from_post_and_img($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from posts,imgpost where (posts.p_id = '{$id}' and posts.p_id=imgpost.p_id )")->fetchAll(PDO::FETCH_ASSOC);
    }
}
