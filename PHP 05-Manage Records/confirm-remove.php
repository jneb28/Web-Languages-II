<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>05-Manage Records</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <form action="confirm-remove.php" method="POST">
      <fieldset>
       <legend>Confirm Employee Removal</legend>
        <?php
        $db = "joshuane_jnebulaDB";
        $user = "joshuane_beker";
        $pw = "pottop77";
        $server = "localhost";
          $con = mysqli_connect($server, $user, $pw, $db) or die ("Error: Could not connect to database.");

          if(isset($_POST['submit'])) {
            $query = "DELETE FROM employee WHERE ID=$_POST[id]";
            $result = mysqli_query($con, $query) or die ("Error: Could not execute query.");
            @unlink($_POST['photo']);
            header('Location: remove.php');
            exit;
          }

          $id = $_GET['id'];
          $query = "SELECT * FROM employee WHERE ID = $id";

          $result = mysqli_query($con, $query) or die ("Error: Could not execute query.");
          $employee = mysqli_fetch_array($result);

          echo "<p>";
          echo "Name: " . $employee['FirstName'] . " " . $employee['LastName'];
          echo "</p>";
          echo "<p>";
          echo "Age: " . $employee['Age'];
          echo "</p>";
          echo "<p>";
          echo "Email: " . $employee['Email'];
          echo "</p>";
          echo "<p>";
          echo "Photo: ";
          echo "</p>";
          echo '<img src="img/'.$employee['Photo'].'" alt="Employee Photograph">';

          $con->close();
        ?>
    </fieldset>
      <input type="hidden" name="photo" value="img/<?php echo $employee['Photo']; ?>">
      <input type="hidden" name="id" value="<?php echo $employee['ID']; ?>">
      <input class="remove" type="submit" name="submit" value="Remove">
      <a href="remove.php">Cancel</a>
    </form>
  </body>
</html>
