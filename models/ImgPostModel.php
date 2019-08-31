<?php

class ImgPostModel extends Basictable {

    static protected $table_name = "imgpost";
    static protected $primary = "imgpost_id";
    public $primary_key = "imgpost_id";
    public $fields = array('imgpost_id', 'imgpost', 'p_id');
    public $imgpost_id;
    public $imgpost;
    public $p_id;

}
