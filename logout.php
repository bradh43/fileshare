<?php
    //clear the session
    session_start();
    session_destroy();
    //redirect the user to the login page
    header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/login.php?");
    die();
?>