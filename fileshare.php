<?php
    session_start();
    // make sure the user is logged in
    if(empty($_SESSION["username"])){
        //redirect user back to login page
        header("Location: http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/login.php?");
        die();
    } else {
        // read the username passed in
        $username = $_SESSION['username'];
        if(empty($_POST['sort']) && empty($_SESSION['sortFilesMethod'])){
            $_SESSION['sortFilesMethod'] = "name";
        } else if(!empty($_POST['sort'])){
            $sortMethod = (String) $_POST['sort'];
            $_SESSION['sortFilesMethod'] = $sortMethod;
        }
       
    }
?>
<!doctype html>
<!--
Brad Hodkinson/Pratyay Bishnupuri
01/24/19
CSE 330
Module 2 Fileshare
-->

<html lang="en">
<head>
    <!-- Set up settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simple Filesharing website">
    <meta name="keywords" content="Filesharing">
    <meta name="author" content="Brad Hodkinson">
    <!-- Link the icon, javascript and css -->
    <link rel="shortcut icon" type="image/png" href="./assets/icons/database.png">
    <link rel="stylesheet" href="fileshare.css">
    <title>Fileshare</title>

</head>

<body class="background">
<div class="navBar">
    <ul>
        <li class="home"><a href="http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/login.php?">Fileshare</a></li>
        <li id="logout"><a href="http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/logout.php?">Logout</a></li>
    </ul>
</div>
<div class="welcomne-message">
    <?php
    //display the user name
    printf("<h2>Welcome %s!</h2>",
		htmlentities($username)
    );
    ?>
    <p>Fileshare lets you store all your files in one place</p>
</div>
<div class="dashboard">
    <div class="file-storage-body">
        <div class="header">
            <img src="./assets/icons/database.png" alt="database">
            <h3>Stored Files</h3>
        </div>
        <div class="file-list">
            <p class="hidden" id="file-list-message">No files have been uploaded.</p>
            <table class="hidden" id="file-table">
                <tr class="table-header">
                    <th id="name-header">Name</th>
                    <th id="kind-header" class="kind-header info">Kind</th>
                    <th id="size-header" class="size-header info">Size</th>
                </tr>
                <form id="view-file" action="viewFile.php" method="post">
                    <input type="hidden" name="viewPath" id="view-file-path">
                </form>
                <form id="delete-file" action="deleteFile.php" method="post">
                    <input type="hidden" name="deletePath" id="delete-file-path">
                </form>
                <form id="sort-method-form" action="fileshare.php" method="post">
                    <input type="hidden" name="sort" id="sort-method" value=<?php echo($sortMethod);?>>
                </form>
                <?php include 'loadFiles.php';
                    //get the users files
                    $user_folder = "/srv/module2/uploads/" . $username;
                    $user_files = array();
                    $idCount = 0;
                    //load and render the user files
                    $user_files = loadFiles($user_folder, $user_files, $idCount);
                    renderFiles($user_files);
                    $_SESSION["user_files"] = $user_files;

                ?>
            </table>
        </div>
    </div>
    <div class="file-upload-body">
        <div class="header">
            <img src="./assets/icons/storage.png" alt="storage">
            <h3>Upload Files</h3>
        </div>
        <form action="upload.php" method="post" enctype="multipart/form-data" id="upload-form">
            <div class="upload" id="upload">
                <h4 id="choose-file">Choose File</h4>
                <img src="./assets/icons/upload.png" alt="upload" id="file-type-image">
                <input type="file" name="uploadedFile" id="upload-file" onChange="updateFile();">
                <h5 id="upload-file-name">No File Uploaded.</h5>
            </div>
            <div class="confirm-upload hidden" id="confirm-upload">
                <p>Confirm Upload</p><img src="./assets/icons/save.png" alt="save">
            </div>
        </form>
    </div>
</div>

<div class="bottom-message">
        <p>This Filesharing website was built by Brad Hodkinson/Pratyay Bishnupuri for the WUSTL CSE 330 course.</p>
    </div>
</body>
<script src="fileshare.js"></script>

</html>