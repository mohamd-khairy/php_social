<?php

class ChatModel extends Basictable {

    static protected $table_name = "chat";
    static protected $primary = "chat_id";
    public $primary_key = "chat_id";
    public $fields = array('chat_id', 'u_id1', 'u_id2', 'chat_datetime');
    public $chat_id;
    public $u_id1;
    public $u_id2;
    public $chat_datetime;


}
