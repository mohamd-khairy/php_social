<?php

class FriendsModel extends Basictable {

    static protected $table_name = "friends";
    static protected $primary = "f_id";
    public $primary_key = "f_id";
    public $fields = array('f_id', 'user_id1', 'user_id2', 'role');
    public $f_id;
    public $user_id1;
    public $user_id2;
    public $role;

    static public function checkFriend($u1, $u2) {
        return DatabaseManager::getInstance()->dbh->query("select * from friends where ((user_id1 = '{$u1}' and user_id2 = '{$u2}') or (user_id2 = '{$u1}' and user_id1 = '{$u2}'))")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getFriend1($u) {
        return DatabaseManager::getInstance()->dbh->query("select user_id1 as user from friends where user_id2 = '{$u}' and role=1")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getFriend2($u) {
        return DatabaseManager::getInstance()->dbh->query("select user_id2 as user from friends where user_id1 = '{$u}' and role=1")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_to_confirm_friend($u1, $u2) {
        return DatabaseManager::getInstance()->dbh->query("select * from friends where user_id1='{$u1}' and user_id2 = '{$u2}' and role=0")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_special_request($u1, $u2) {

        return $this->dbh->query("delete from friends where user_id1='{$u1}' and user_id2 = '{$u2}'");
    }

    public function delete_friend($u1, $u2) {

        return $this->dbh->query("delete from friends where ((user_id1 = '{$u1}' and user_id2 = '{$u2}') or (user_id2 = '{$u1}' and user_id1 = '{$u2}'))");
    }

    static public function get_all_friend_request() {
        return DatabaseManager::getInstance()->dbh->query("select * from friends,user where (friends.user_id1=user.u_id) and (user_id2={$_SESSION['u_id']} and role=0)")->fetchAll();
    }

    static public function get_my_friend() {
        return DatabaseManager::getInstance()->dbh->query("select * from friends,user where ((friends.user_id1=user.u_id)or(friends.user_id2=user.u_id)) and ((user_id2={$_SESSION['u_id']} and role=1)or(user_id1={$_SESSION['u_id']} and role=1))")->fetchAll();
    }

}
