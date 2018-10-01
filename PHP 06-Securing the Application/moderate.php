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
        <li><a href="view.php">View</a></li>
        <li><a href="add.php">Add</a></li>
        <li><a href="moderate.php" class="active">Moderate</a></li>
      </ul>
    </nav>
    <h2>New Comments</h2>
    <div class="approve">
      <?php
        require_once('authentication.php');
        require_once('variables.php');
        
        $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");

        $query = "SELECT * FROM blog WHERE Approved=0";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) === 0) {
          echo "<p class='no-results'>There are no comments to moderate!</p>";
        } else {
          while($row = mysqli_fetch_array($result)) {
            echo "<div class='border'>";

            echo "<h3 class='user'>" . $row['User'] . "</h3>";

            echo "<p class='comment'>\"" . $row['Comment'] . "\"</p>";

            echo "<p class='date'>" . $row['Date'] . "</p>";

            echo "<a href='approve.php?ID=".$row['ID']."' class='approve-link'>Approve</a>";
            echo "<a href='decline.php?ID=".$row['ID']."' class='decline-link'>Decline</a>";

            echo "</div>";
          }
        }

        $con->close();
      ?>
    </div>

  </body>
</html>
