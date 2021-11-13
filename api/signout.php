<?php

    session_start();

    session_destroy();

    exit(header('location: /haldoor-admin/signin.php'));
?>