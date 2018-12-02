<?php 
  require_once('config.php');
  $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP 09 Toolbars</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
    </ul>
  </nav>
  
  <main>
  <h1>Edit</h1>

    <div class="movies">
    <?php 
      $query = "SELECT * FROM movie ORDER BY title";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        echo "<div>"; 
        echo "<h2>" . $row["title"] . "</h2>";
        echo '<img src="img/'.$row['image'].'" alt="Movie Image">';
        echo "<p>" . $row["rating"] . "</p>";
        echo "<p>" . $row["description"] . "</p>";
        echo '<a href="update.php?id=' . $row["id"] . '">Edit</a>';
        echo "</div>";
      }

      mysqli_close($con);
    ?>
    </div>
  </main>
</body>
</html>