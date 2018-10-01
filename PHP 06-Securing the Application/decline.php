<?php
  require_once('authentication.php');
  require_once('variables.php');
  
  $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");

  $id = $_GET['ID'];

  $query = "DELETE FROM blog WHERE id=$id";
  mysqli_query($con, $query) or die ("Error: DELETE query failed.");

  header("Location: moderate.php");

  $con->close();
?>
