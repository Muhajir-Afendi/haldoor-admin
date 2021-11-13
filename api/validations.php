<?php

    namespace inputValidations;

    /* ========== Essentials ========== */

    // Page No
    function validate_page_no($input) {

        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);

        if (empty($input)) { 
            return false; 
        }
        else if(preg_match("/^[0-9]{1,3}$/",$input)) {
            return $input;
        }
        else {
            return false;
        }

    }

    // Search Text
    function validate_search_text($input) {

        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);

        if (empty($input)) { 
            return false; 
        }  
        else {
            return $input;
        }

    }

    // ID
    function validate_number_id($input) {

        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);

        if (empty($input)) { 
            return false; 
        }
        else {
            return $input;
        }

    }

    // Title
    function validate_title($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if(preg_match("/^.{5,500}$/",$input)) {
            return $input;
        }
        else {
            return false;
        }

    }
    
    // Body
    function validate_body($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else {
            return $input;
        }

    }
    
    // Filename
    function validate_file_name($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else {
            return $input;
        }

    }



    /* ========== USERS ========== */

    // Name
    function validate_name($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if(preg_match("/^.{5,191}$/",$input)) {
            return $input;
        }
        else {
            return false;
        }

    }

    // Password
    function validate_password($pwd, $cpwd) {
        $pwd = trim($pwd);
        $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);

        $cpwd = trim($cpwd);
        $cpwd = filter_var($cpwd, FILTER_SANITIZE_STRING);

        if (empty($pwd) || empty($cpwd)) { 
            return false; 
        }
        else if(preg_match("/^.{7,16}$/",$pwd) && preg_match("/^.{7,16}$/",$cpwd) && $pwd === $cpwd ) {
            return $pwd;
        }
        else {
            return false;
        }

    }

    // Editing Password
    function validate_editing_password($pwd, $cpwd) {
        $pwd = trim($pwd);
        $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);

        $cpwd = trim($cpwd);
        $cpwd = filter_var($cpwd, FILTER_SANITIZE_STRING);

        if (empty($pwd)) { 
            return "empty"; 
        }
        else if(preg_match("/^.{7,16}$/",$pwd) && preg_match("/^.{7,16}$/",$cpwd) && $pwd === $cpwd ) {
            return $pwd;
        }
        else {
            return $pwd;
        }

    }

    // Editing
    function validate_signin_password($pwd) {
        $pwd = trim($pwd);
        $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);

        if (empty($pwd)) { 
            return false; 
        }
        else if(preg_match("/^.{7,16}$/",$pwd)) {
            return $pwd;
        }
        else {
            return false;
        }

    }

?>