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
  <h1>Log In</h1>
  
    <form action="login.php" method="POST" enctype="multipart/form-data">
      <label for="u-name">Username:</label>
      <input type="text" name="u-name" id="u-name" value="<?php if(!empty($username)) echo $username; ?>" required>

      <label for="pw">Password:</label>
      <input type="password" name="pw1" id="pw" required>

      <input type="submit" name="submit" value="Log in" id="submit">

      <?php 
        if(isset($_POST['submit'])) {
          $username = mysqli_real_escape_string($con, trim($_POST['u-name']));
          $password = mysqli_real_escape_string($con, trim($_POST['pw1']));
          
          $query = "SELECT * FROM user WHERE username = '$username' AND password = sha1('$password')";
          $result = mysqli_query($con, $query);

          if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            setcookie('u-name', $username, time() + (60*60*24*30));

            header('Location: index.php');
          } else {
            echo '<p class="info">Error: Invalid username/password.</p>';
          }
        }
        mysqli_close($con);
      ?>
    </form>
      
  </main>
</body>
</html>