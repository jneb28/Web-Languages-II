<?php

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Midterm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
  </head>
  <body>

    <div class="container">

      <nav style="margin-bottom: 106px">
        <div class="row h-100 align-items-center">
          <div class="col-sm-6">
            <h1 class="justify-content-start title">Research Plus</h1>
          </div>
          <div class="col-sm-6">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
          </div>
        </div>
      </nav>


      <div class="row h-100 justify-content-center" style="margin: 0 10px">
        <div class="col-sm-6">
          <h1 class="form-heading">Create New Employee</h1>
          <form method="POST" action="create.php" enctype="multipart/form-data">
            <div class="form-group">
              <label for="first-name">First Name:</label>
              <input type="text" class="form-control" name="first-name" id="first-name">
            </div>

            <div class="form-group">
              <label for="last-name">Last Name:</label>
              <input type="text" class="form-control" name="last-name" id="last-name">
            </div>

            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="text" class="form-control" name="phone" id="phone">
            </div>

            <div class="form-group">
              <label for="phone">Email:</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>

            <div class="form-group">
              <label for="last-name">Field:</label>
              <select class="custom-select" name="field" id="field">
                <option selected></option>
                <option value="Astrology">Astrology</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Biology">Biology</option>
              </select>
            </div>

            <div class="form-group">
              <label for="description">Description:</label>
              <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>

            <div class="custom-file">
              <input type="file" class="custom-file-input" name="file" id="file">
              <label class="custom-file-label" for="file">Choose a file to upload</label>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <button type="button" style="margin-top: 30px" class="btn btn-secondary"><a href="dashboard.php">Back</a></button>
          </form>
          <?php
            require_once('variables.php');
            $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");

            if(isset($_POST['submit'])) {
              $firstName = $_POST['first-name'];
              $lastName = $_POST['last-name'];
              $phone = $_POST['phone'];
              $email = $_POST['email'];
              $field = $_POST['field'];
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
                  echo "<p>Employee Created!</p>";
                } else {
                  echo "<p>Error: File too large</p>";
                }
              } else {
                echo "<p>Error: There was an error uploading the file</p>";
              }
              } else {
                echo "<p>Error: Invalid file type</p>";
              }

              $query = "INSERT INTO researchemployee (FirstName, LastName, Phone, Email, Field, Description, Photo) VALUES ('$firstName', '$lastName', '$phone', '$email', '$field', '$description', '$fileNameNew')";
              mysqli_query($con, $query) or die ("Error: Insert query failed.");
            }
            $con->close();
          ?>
        </div>
      </div>


      <footer style="margin-top: 106px">
        <div class="row h-100 align-items-center">
          <div class="col-sm-6">
            <h1 class="justify-content-start align-middle font-weight-normal title">&copy; 2018 Research Plus</h1>
          </div>
          <div class="col-sm-6">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link" href="read2.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
