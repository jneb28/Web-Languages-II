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
      <?php 
        include_once('nav.php');
      ?>
    </ul>
  </nav>
  <main>
  <h1>Details</h1>

    <div class="movies">
    <?php 
      $id = $_GET['id'];
      
      $query = "SELECT * FROM movie WHERE id = $id";
      $result = mysqli_query($con, $query);

      while($row = mysqli_fetch_array($result)) {
        echo "<div>"; 
        echo "<h2>" . $row["title"] . "</h2>";
        echo '<img src="img/'.$row['image'].'" alt="Movie Image">';
        echo "<p>" . $row["rating"] . "</p>";
        echo "<p>" . $row["description"] . "</p>";
        echo "</div>";
      }

      
    ?>
    </div>
    <form action="read.php?id=<?php echo $id ?>" method="post">
      <label for="rating">Your Rating</label>
      1<input type="radio" name="rating" value="1" required>
      2<input type="radio" name="rating" value="2">
      3<input type="radio" name="rating" value="3">
      4<input type="radio" name="rating" value="4">
      5<input type="radio" name="rating" value="5">

      <label for="comment">Leave a Comment</label>
      <input type="text" name="comment" id="comment" required>
      
      <input type="hidden" name="movie-id" value="<?php echo $id ?>">
      <input type="submit" name="submit" value="Post">
    </form>
    
    <?php 
      if(isset($_POST['submit'])) {
        if(isset($_COOKIE['u-name'])) {
          $user = $_COOKIE['u-name'];
          $rating = $_POST['rating'];
          $comment = mysqli_real_escape_string($con, $_POST['comment']);
          $movie_id = $_POST['movie-id'];
          $query = "INSERT INTO blog (user, rating, comment, movie_id) VALUES ('$user', '$rating', '$comment', '$movie_id')";
          if(mysqli_query($con, $query)) {
            echo "<p>Comment posted.</p>";
          } else {
            echo "<p>Error: Comment did not post.</p>";
          }
        } else {
          echo "<p>Log in to comment.</p>";
        } 
      }
    ?>
    <table>

    <?php
      $query = "SELECT * FROM movie AS m
      INNER JOIN blog as b
      ON m.id = b.movie_id WHERE m.id = $id";
      $result = mysqli_query($con, $query) or die("error");
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["user"] . "</td>";
        echo "<td>" . $row["rating"] . "</td>";
        echo "<td>" . $row["comment"] . "</td>";
        echo "</tr>";
      }
      
      mysqli_close($con);
    ?>
    </table>
  </main>
</body>
</html>