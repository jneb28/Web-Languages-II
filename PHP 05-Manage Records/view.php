<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>05-Manage Records</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>
    <nav>
      <ul>
        <li><a href="index.html">Add</a></li>
        <li><a href="view.php" class="active">View</a></li>
        <li><a href="remove.php">Remove</a></li>
      </ul>
    </nav>
    <div class="employee-list">
    <h3>Employee Profiles</h3>
      <?php
      $db = "joshuane_jnebulaDB";
      $user = "joshuane_beker";
      $pw = "pottop77";
      $server = "localhost";
      $con = mysqli_connect($server, $user, $pw, $db) or die ("Error: Could not connect to database.");

      $query = "SELECT * FROM employee";
      $result = mysqli_query($con, $query);

      while($row = mysqli_fetch_array($result)) {
        echo "<p>";
        echo $row['FirstName'] . " " . $row['LastName'] . ": " . $row['Email'];
        echo ' - <a href="view-more.php?id=' . $row['ID'] . '">Update</a>';
        echo "</p>";
      }

      $con->close();
      ?>
    </div>
  </body>
</html>
