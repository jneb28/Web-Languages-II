<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>06-Securing the Application</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>
  <body>

    <?php
      require_once('variables.php');
      $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");

      if(isset($_POST['submit'])) {
        $user = $_POST['user'];
        $comment = $_POST['comment'];
        $date = date("m/d/Y");
        $query = "INSERT INTO blog (User, Comment, Date) VALUES ('$user', '$comment', '$date')";
        mysqli_query($con, $query) or die ("Error: Insert query failed.");
      }

      $con->close();
    ?>

    <nav>
      <ul>
        <li><a href="view.php">View</a></li>
        <li><a href="add.php" class="active">Add</a></li>
        <li><a href="moderate.php">Moderate</a></li>
      </ul>
    </nav>

    <form class="" action="add.php" method="POST">
      <fieldset>
        <legend>Leave a comment</legend>

        <label for="user">Username:</label>
        <input type="text" name="user" value="" id="user">

        <label for="comment">Comment:</label>
        <textarea name="comment" rows="8" cols="80" id="comment"></textarea>

        <input type="submit" name="submit" value="Post" class="submit">

      </fieldset>
    </form>

  </body>
</html>
