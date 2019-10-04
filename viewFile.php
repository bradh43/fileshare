<?php
    include("file.php");

    //check if the view path is not set
    if(!isset($_POST['viewPath'])){
        //redirect user back to login page
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/fileshare.php?");
        die("invalid view");
    }  
    //get the index of the file to be viewed
    $viewPath = (int) $_POST['viewPath'];
    session_start();
    $user_files = (array) $_SESSION["user_files"];
    //get the file path to view the file selected at the given index
    $filePath = $user_files[$viewPath*2]->getFilePath();

    //set up MIME type info of the file to be viewed
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    //get the mime type of the file
    $mimeType = $finfo->file($filePath);
    //set the header to correct MIME type
    header("Content-Type: ".$mimeType);
    //read the file
    readfile($filePath);
    
?>