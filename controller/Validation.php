<?php

/* very important
 * 
 * 
 *  *Validation ->checkitem($value,$key)
 * 
 *  *satization ->SantizeItem($value,$key)
 */

class Validation {

    function validate($data, $rules) {
        $valid = TRUE;
        foreach ($rules as $key => $rule) {
            $callbacks = explode('|', $rule);
            foreach ($callbacks as $callback) {
                $value = isset($data[$key]) ? $data[$key] : NULL;
                if (is_array($value)) {
                    foreach ($value as $val) {
                        if ($this->$callback($val, $key) == FALSE)
                            $valid = FALSE;
                    }
                } else {
                    if ($this->$callback($value, $key) == FALSE)
                        $valid = FALSE;
                }
            }
        }
        return $valid;
    }

    function checkstring($value, $key) {
        $pattern = "^[A-Za-z][أ-ي][0-9]'\"{},().:-$^";
        $validate = preg_match($pattern, $value);
        if ($validate == TRUE)
            throw new Exception("ERROR: The $key Must be Valid String..");

        return $validate;
    }
      function checktext($value, $key) {
        $pattern = "^[A-Za-z][أ-ي]^";
        $validate = preg_match($pattern, $value);
        if ($validate == TRUE)
            throw new Exception("ERROR: The $key Must be Valid text ..");

        return $validate;
    }

    function checkint($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_INT);
        if ($validate == FALSE)
            throw new Exception("ERROR: The $key Must be Valid Integer..");

        return $validate;
    }

    function checkdate($value, $key) {
        if ($value < date('d-m-Y', time()))
            throw new Exception("ERROR: The $key  Must be Valid date..");

        return $value;
    }

    function checkphone($value, $key) {
        if (count($value) != 11)
            throw new Exception("ERROR: The $key Must be Valid phone..");

        return $value;
    }

    function checkemail($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_EMAIL);
        if ($validate == FALSE)
            throw new Exception("ERROR: The $key Must be Valid Email..");

        return $validate;
    }

    function checkurl($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_URL);
        if ($validate == FALSE)
            throw new Exception("ERROR: The $key Must be Valid Url..");

        return $validate;
    }

    function checkip($value, $key) {
        $validate = filter_var($value, FILTER_VALIDATE_IP);
        if ($validate == FALSE)
            throw new Exception("ERROR: The $key Must be Valid ip..");

        return $validate;
    }

    function checkempty($value, $key) {
        $validate = empty($value);
        if ($validate == TRUE)
            throw new Exception("ERROR: The $key Must be Not Empty..");

        return $validate;
    }

    function SantizeItem($value, $key) {
        $flag = NULL;
        switch ($key) {
            case email:
                $value = substr($value, 0, 250);
                $filter = FILTER_SANITIZE_EMAIL;
                break;
            case url:
                $filter = FILTER_SANITIZE_URL;
                break;
            case int:
                $filter = FILTER_SANITIZE_NUMBER_INT;
                break;

            default :
                $filter = FILTER_SANITIZE_STRING;
                $flag = FILTER_FLAG_NO_ENCODE_QUOTES;
                break;
        }
        $validate = filter_var($value, $filter, $flag);
        if ($validate == FALSE)
            throw new Exception("ERROR: The $key is invalid..");

        return $validate;
    }

}
