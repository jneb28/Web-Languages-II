<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>04-Deleting Records</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>
    <form action="<?php $SERVER['PHP_SELF']; ?>" method="POST">
      <fieldset>
      <legend>Remove Newsletter Subscriber</legend>
      <?php
      $db = "joshuane_jnebulaDB";
      $server = "localhost";
      $user = "joshuane_beker";
      $pass = "pottop77";
      $con = mysqli_connect($server, $user, $pass, $db);
      if($con->connect_errno) {
        echo $con->connect_error;
      }
      //deletes selected input values from DB
      if(isset($_POST['submit'])) {
        foreach ($_POST['toDelete'] as $value) {
          $query = "DELETE FROM News WHERE ID=$value";
          $result = mysqli_query($con, $query);
        }
      }
      $query = "SELECT * FROM News WHERE Newsletter = 'true'";
      $result = mysqli_query($con, $query);
      //list DB results
      while($row = mysqli_fetch_assoc($result)) {
        echo '<input type="checkbox" value="'.$row['ID'].'" name="toDelete[]">';
        echo $row['FirstName'] . " " . $row['LastName'] . ": " . $row['Email'];
        echo '<br>';
      }
      $con->close();
      ?>
      </fieldset>
      <a class="add" href="../sandbox/index.html" target="_blank">Add</a>
      <input class="remove" type="submit" name="submit" value="Remove">
    </form>
  </body>
</html>
