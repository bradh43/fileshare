<?php
    session_start();
    
    // make sure the user passed in is valid
    if(empty($_POST['username'])){
        //redirect user back to login page
        session_destroy();
        session_start();
        $_SESSION["error-message"] = "User does not exist";
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/createAccount.php?");
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
                //close file and redirect user to create account
                fclose($users_file);
                session_destroy();
                session_start();
                $_SESSION["error-message"] = "User already exists";
                header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/createAccount.php?");
                die("invalid username");
            }
        }
        //add new user to the user file
        fwrite($users_file, $username . "\n");
        fclose($users_file);

        //new user, create new folder
        $new_user_folder = "/srv/module2/uploads/" . $username;
        if(!is_dir($new_user_folder)) {
            mkdir($new_user_folder, 0755, true) or die("404 error creating new user directory");
        }
        //log the user in
        login();
    }

    function login(){
        //log the user in
        $_SESSION["error-message"] = "";
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/fileshare.php?");
        die();
    }
?>
