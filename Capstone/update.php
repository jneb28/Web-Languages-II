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
  <h1>Update</h1>

  <?php
    $id = $_GET['id'];
    $query = "SELECT * FROM movie WHERE id = $id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
  ?>
  
  <form method="POST" action="update.php?id=<?php echo $id ?>" enctype="multipart/form-data">   
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php echo $row['title'] ?>" required>

    <label for="rating">Rating</label>
    <select name="rating" id="rating">
      <option value="<?php echo $row['rating'] ?>">(Current) <?php echo $row['rating'] ?></option>
      <option value="G">G</option>
      <option value="PG">PG</option>
      <option value="PG-13">PG-13</option>
      <option value="R">R</option>
    </select>

    <label for="description">Description</label>
    <input type="text" name="description" id="description" value="<?php echo $row['description'] ?>" required>
    
    <input type="hidden" name="movie-id" value="<?php echo $id ?>">
    <input type="submit" name="submit" value="Update">
  </form>

  <?php 
    if(isset($_POST['submit'])) {
      $title = $_POST['title'];
      $rating = $_POST['rating'];
      $description = $_POST['description'];
      $movie_id = $_POST['movie-id'];

      $query = "UPDATE movie SET title = '$title', rating = '$rating', description = '$description' WHERE id = $movie_id";
      if(mysqli_query($con, $query)) {
        echo "<p>Movie updated.</p>";
      } else {
        echo "<p>Update failed.</p>";
      }
    }

    mysqli_close($con);
  ?>
  </main>
</body>
</html>