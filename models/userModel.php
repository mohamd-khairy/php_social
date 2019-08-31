<?php

class userModel extends Basictable {

    static protected $table_name = "user";
    static protected $primary = "u_id";
    public $primary_key = "u_id";
    public $fields = array('u_id','u_img_profile','u_img_cover','u_bio', 'u_f_name', 'u_s_name', 'u_username', 'u_email', 'u_password', 'u_city', 'u_country', 'u_gender');
    public $u_f_name;
    public $u_s_name;
    public $u_email;
    public $u_password;
    public $u_city;
    public $u_country;
    public $u_gender;
    public $u_username;
    public $u_img_profile;
    public $u_img_cover;
    public $u_bio;
    public $u_id;

}
