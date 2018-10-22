<?php 
    if(!isset($_COOKIE['u-name'])) {
        exit('<h1>Please <a href="login.php">login</a> to access this page</h1>');
    }
?>