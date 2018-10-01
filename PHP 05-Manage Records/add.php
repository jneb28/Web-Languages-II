<?php
$db = "joshuane_jnebulaDB";
$user = "joshuane_beker";
$pw = "pottop77";
$server = "localhost";

  $con = mysqli_connect($server, $user, $pw, $db) or die ("Error: Could not connect to database.");

  $firstName = $_POST['first-name'];
  $lastName = $_POST['last-name'];
  $age = $_POST['age'];
  $email = $_POST['email'];

  if(isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
  }

  //splits file name and extension
  $fileExt = explode('.', $fileName);
  //converts file extension to lowercase
  $fileActualExt = strtolower(end($fileExt));
  //stores valid file extensions
  $allowed = array('jpg', 'jpeg', 'png', 'gif');

  //checks if file has allowed extension
  if(in_array($fileActualExt, $allowed)) {
  //checks if file has error
  if($fileError === 0) {
    //less than 500kb
    if($fileSize < 500000) {
      //creates unique file name (insert time in microseconds)
      $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
      //sets file destination
      $fileDestination = 'img/' . $fileNameNew;
      move_uploaded_file($fileTmp, $fileDestination);
      echo "<p>Employee Added</p>";
      //header('Location: index.html');
    } else {
      echo "<p>Error: File too large.</p>";
    }
  } else {
    echo "<p>Error: There was an error uploading the file</p>";
  }
  } else {
    echo "<p>Error: Invalid file type.</p>";
  }

  $query = "INSERT INTO employee (FirstName, LastName, Age, Email, Photo) VALUES ('$firstName', '$lastName', '$age', '$email', '$fileNameNew')";
  mysqli_query($con, $query) or die ("Error: Could not complete query.");
  $con->connect_errno;

  $con->close();
?>
