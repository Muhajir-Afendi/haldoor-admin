<?php

    function check_admin() {
        if (!isset($_SESSION['name'], $_SESSION['email']) || $_SESSION['device'] !== $_SERVER['HTTP_USER_AGENT']) {
            exit(header('location: /haldoor-admin/signin.php'));
        }
    }

    function check_admin_api() {
        if (!isset($_SESSION['name'], $_SESSION['email']) || $_SESSION['device'] !== $_SERVER['HTTP_USER_AGENT']) {
            return false;
        }
        else {
            return true;
        }
    }

?>
