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
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="create.php">Add</a></li>
      <li><a href="read.php">Search</a></li>
    </ul>
  </nav>
  <main>
  <h1>Add a Band</h1>
    <form action="create.php" method="post">
      <label for="name">Name</label>
      <input type="text" name="name" id="name">

      <label for="genre">Genre</label>
      <select name="genre" id="genre">
        <option value="Rock">Rock</option>
        <option value="Jazz">Jazz</option>
        <option value="Pop">Pop</option>
        <option value="Indie">Indie</option>
        <option value="Electronic">Electronic</option>
        <option value="Other">Other</option>
      </select>

      <label for="date">Date</label>
      <input type="text" name="date" id="date" placeholder="01/01/1234">

      <input type="submit" name="submit" value="Submit" id="submit">
      <?php 
                if(isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $genre = $_POST['genre'];
                    $date = $_POST['date'];

                    $query = "INSERT INTO band (Name, Genre, Date) values ('$name', '$genre', '$date')";
                    if(mysqli_query($con, $query)) {
                      echo "<p>Band Added</p>";
                    } else {
                      echo "<p>Query Failed</p>";
                    }

                    mysqli_close($con);           
                }
            ?>
    </form>
  </main>
</body>
</html>