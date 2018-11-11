<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once("config.php");
// Datebase: subscriber, Table: account
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, "subscriber") or die("Connection failed: " . mysqli_connect_error()); 
// Datebase: realm, Table: population
$con2 = mysqli_connect(DB_HOST, DB_USER, DB_PASS, "realm") or die("Connection failed: " . mysqli_connect_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="create.php">Create</a></li>
    </ul>
  </nav>

  <h1>Filter by Account Status</h1>
  <ul>
    <li><a href="index.php?filter=1">Active</a></li>
    <li><a href="index.php?filter=2">Inactive</a></li>
    <li><a href="index.php?filter=3">Suspended</a></li>
    <li><a href="index.php?filter=4">Banned</a></li>
    <li><a href="index.php?filter=5">Terminated</a></li>
  </ul>
</body>
</html>