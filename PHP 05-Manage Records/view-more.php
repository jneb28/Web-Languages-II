<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>05-Manage Records</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
    $db = "joshuane_jnebulaDB";
    $user = "joshuane_beker";
    $pw = "pottop77";
    $server = "localhost";
      $con = mysqli_connect($server, $user, $pw, $db) or die ("Error: Could not connect to database.");

      $id = $_GET['id'];
      $query = "SELECT * FROM employee WHERE ID = $id";

      $result = mysqli_query($con, $query) or die ("Error: Could not execute query.");
      $employee = mysqli_fetch_array($result);

      $con->close();
    ?>
    <form action="update.php" method="POST" enctype="multipart/form-data">
      <fieldset>
      <legend>Update Employee</legend>
      <label for="first-name">First Name:</label>
      <input type="text" name="first-name" value="<?php echo $employee['FirstName']; ?>" id="first-name">

      <label for="last-name">Last Name:</label>
      <input type="text" name="last-name" value="<?php echo $employee['LastName']; ?>" id="last-name">

      <label for="age">Age:</label>
      <input type="number" name="age" value="<?php echo $employee['Age']; ?>" id="age">

      <label for="email">Email:</label>
      <input type="email" name="email" value="<?php echo $employee['Email']; ?>" id="email">
      </fieldset>
      <input type="hidden" name="id" value="<?php echo $employee['ID']; ?>">
      <input class="add" type="submit" name="submit" value="Update">
      <a href="view.php">Back</a>
    </form>
  </body>
</html>
