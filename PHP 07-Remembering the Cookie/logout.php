<?php 
    setcookie('f-name', '', time() - 3600);
    setcookie('l-name', '', time() - 3600);
    setcookie('u-name', '', time() - 3600);
    
    header('Location: index.php');
?>