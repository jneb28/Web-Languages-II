<?php 
    setcookie('u-name', '', time() - 3600);
    
    header('Location: index.php');
?>