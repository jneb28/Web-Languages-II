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
  <h1>Create</h1>

  <form method="POST" action="create.php" enctype="multipart/form-data">   
    <label for="title">Title</label>
    <input type="text" name="title" id="title" required>

    <label for="rating">Rating</label>
    <select name="rating" id="rating">
      <option value="G">G</option>
      <option value="PG">PG</option>
      <option value="PG-13">PG-13</option>
      <option value="R">R</option>
    </select>

    <label for="description">Description</label>
    <input type="text" name="description" id="description" required>

    <label for="file">Upload picture</label>
    <input type="file" name="file" id="file" required>
    
    <input type="submit" name="submit" value="Submit">
  </form>

  <?php 
    if(isset($_POST['submit'])) {
      $title = $_POST['title'];
      $rating = $_POST['rating'];
      $description = $_POST['description'];

      $file = $_FILES['file'];
      $fileName = $_FILES['file']['name'];
      $fileTmp = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg', 'jpeg', 'png', 'gif');

      if(in_array($fileActualExt, $allowed)) {
      if($fileError === 0) {
        if($fileSize < 500000) {
          $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
          $fileDestination = 'img/' . $fileNameNew;
          move_uploaded_file($fileTmp, $fileDestination);
          echo "<br>";
          echo "<br>";
          echo "<p>Movie Added</p>";
        } else {
          echo "<p>Error: File too large.</p>";
        }
      } else {
        echo "<p>Error: There was an error uploading the file.</p>";
      }
      } else {
        echo "<p>Error: Invalid file type.</p>";
      }

      $query = "INSERT INTO movie (title, rating, description, image) VALUES ('$title', '$rating', '$description', '$fileNameNew')";
      mysqli_query($con, $query) or die ("Error: Insert query failed.");
    }

    mysqli_close($con);
  ?>
  </main>
</body>
</html>