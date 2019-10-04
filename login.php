<!doctype html>
<!--
Brad Hodkinson
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
    <link rel="stylesheet" href="login.css">
    <!-- <script src="fileshare.js"></script> -->
    <title>Fileshare</title>

</head>

<body class="background">
    <div class="title">
        <h1>Fileshare</h1>
    </div>
    <div class="login-container">
        <div class="logo">
            <a href="http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/fileshare.php?"><img src="./assets/images/fileSharing.png" alt="fileshare"/></a>
        </div>
        <p class="error-message">
            <?php
                //load the error message if any
                session_start();
                if(!empty($_SESSION["error-message"])){
                    echo($_SESSION["error-message"]);
                }
            ?>
        </p>
        <form action="validateUser.php" method="POST">
            <div class="login-field">
                <input type="text" class="username" id="username" name="username" placeholder="username">

            </div>
            <div class="login-button">
                <input type="submit" class="login" id="login" value="Login">
            </div>
        </form>
        <p class="switch">New User? <a href="http://ec2-18-219-118-115.us-east-2.compute.amazonaws.com/~bradh43/module2/fileShare/createAccount.php?">Create Account</a></p>
    </div>
    
    <div class="bottom-message">
        <p>This Filesharing website was built by Brad Hodkinson/Pratyay Bishnupuri for the WUSTL CSE 330 course.</p>
    </div>
</body>

</html>