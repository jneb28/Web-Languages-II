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
  <h1>Sign Up</h1>
  
    <form action="sign-up.php" method="POST" enctype="multipart/form-data">
      <label for="u-name">Username:</label>
      <input type="text" name="u-name" id="u-name" value="<?php if(!empty($username)) echo $username; ?>" required>
      <label for="pw">Password:</label>
      <input type="password" name="pw1" id="pw" required>
      <label for="pw">Repeat Password:</label>
      <input type="password" name="pw2" id="pw" required>

      <input type="submit" name="submit" value="Submit" id="submit">

      <?php 
        if(isset($_POST['submit'])) {
          $username = mysqli_real_escape_string($con, trim($_POST['u-name']));
          $password = mysqli_real_escape_string($con, trim($_POST['pw1']));
          $passwordRepeat = mysqli_real_escape_string($con, trim($_POST['pw2']));

          if(($password === $passwordRepeat) && !empty($username) && !empty($password) && !empty($passwordRepeat)) {
            $query = "SELECT * FROM user WHERE username = '$username'";
            $duplicate = mysqli_query($con, $query);

            if(mysqli_num_rows($duplicate) == 0) {
              $query = "INSERT INTO user (username, password) values ('$username', sha1('$password'))";

              if($result = mysqli_query($con, $query)) {
                echo '<p>Account created</p>';
              } else {
                echo '<p>Error: Could not create account.</p>';
              }
            } else {
              echo '<p>Error: Username taken.</p>';
            }
          } else {
            echo '<p>Error: Passwords do not match.</p>';
          }
        }
        mysqli_close($con);
      ?>
    </form>
      
  </main>
</body>
</html>