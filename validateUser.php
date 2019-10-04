<?php
    session_start();
    
    // make sure the user passed in is valid
    if(empty($_POST['username'])){
        //redirect user back to login page
        session_destroy();
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/login.php?");
        //give invalid username error message
        session_start();
        $_SESSION["error-message"] = "Invalid Username";


        die("invalid username");
    } else {
        // read the username passed in
        $username = (string) $_POST["username"];
        $_SESSION["username"] = $username;

        //check if the user already exists
        $users_file = fopen("/srv/module2/users.txt", "a+") or die("404 error validating user with data base");

        while($user = (string) fgets($users_file)){
            //check if the user already exists
            if(strcmp(rtrim($user), $username) == 0){
                //close file and login
                fclose($users_file);
                login();
            }
        }
        session_destroy();
        fclose($users_file);
        session_start();
        $_SESSION["error-message"] = "User does not exist";
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/login.php?");
        die("User does not exist");
    }

    function login(){
        //log the user in
        $_SESSION["error-message"] = "";
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/fileshare.php?");
        die();
    }
?>
