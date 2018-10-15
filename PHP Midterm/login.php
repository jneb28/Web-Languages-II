<?php
  $username = "jnebula";
  $password = "admin";

  if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER'] != $username || $_SERVER['PHP_AUTH_PW'] != $password) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic relam="moderate"');
    exit("<h1>Invalid login</h1>");
  } else {
    header('Location: dashboard.php');
  }
?>
