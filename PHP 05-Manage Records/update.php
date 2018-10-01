<?php
$db = "joshuane_jnebulaDB";
$user = "joshuane_beker";
$pw = "pottop77";
$server = "localhost";
  $con = mysqli_connect($server, $user, $pw, $db) or die ("Error: Could not connect to database.");

  $id = $_POST['id'];
  $firstName = $_POST['first-name'];
  $lastName = $_POST['last-name'];
  $age = $_POST['age'];
  $email = $_POST['email'];


  $query = "UPDATE employee SET FirstName='$firstName', LastName='$lastName', Age='$age', Email='$email' WHERE id=$id";
  if(mysqli_query($con, $query)) {
    echo "<p>Employee updated.</p>";
  } else {
    echo "<p>Error: Could not complete query.</p>";
  }



  $con->connect_errno;

  $con->close();
?>
