<?php
    include("file.php");

    //check if the delete path is not set
    if(!isset($_POST['deletePath'])){
        //redirect user back to login page
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/fileshare.php?");
        die("invalid");
    }  
    //get the index of the file to delete from the list of files
    $deletePath = (int) $_POST['deletePath'];
    //delete the file
    session_start();
    $user_files = $_SESSION["user_files"];
    deleteFile($user_files[$deletePath*2]->getFilePath());

    function deleteFile($filename){
        unlink($filename);
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/fileshare.php?");
        die("Succesfully deleted file");
    }
?>