<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>06-Securing the Application</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>

    <nav>
      <ul>
        <li><a href="view.php" class="active">View</a></li>
        <li><a href="add.php">Add</a></li>
        <li><a href="moderate.php">Moderate</a></li>
      </ul>
    </nav>

    <div class="comments">
      <?php
        require_once('variables.php');
        $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");

        $query = "SELECT * FROM blog WHERE Approved=1";
        $result = mysqli_query($con, $query) or die ("Error: Select query failed.");

        while($row = mysqli_fetch_array($result)) {
          echo "<div class='border'>";

          echo "<h3 class='user'>" . $row['User'] . "</h3>";

          echo "<p class='comment'>\"" . $row['Comment'] . "\"</p>";

          echo "<p class='date'>" . $row['Date'] . "</p>";

          echo "</div>";
        }

        $con->close();
      ?>
    </div>

  </body>
</html>
