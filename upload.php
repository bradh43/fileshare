<?php
//get the username
session_start();
$username = (string) $_SESSION["username"];
// Get the username and make sure it is valid
if(!preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedFile']['name']);
if(!preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}
//full path to the directory where the file should be uploaded to
$full_path = sprintf("/srv/module2/uploads/%s/%s", $username, $filename);
//move the uploaded file to the destination
move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $full_path)or die("Failed to upload file");

//redirect the user back to the home page
header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/fileshare.php?");
die("upload succesful");

?>
