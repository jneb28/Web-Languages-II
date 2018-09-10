<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

$db = "jnebulaDB";
$server = "localhost";
$user = "jnebula";
$pass = "Gr00vym0ve7!";
$con = mysqli_connect($server, $user, $pass, $db);
if($con->connect_errno) {
  echo $con->connect_error;
}

$query = "SELECT Email FROM News WHERE Newsletter = 'true'";
if(!mysqli_error($con)) {
  $result = mysqli_query($con, $query);
} else {
  echo mysqli_error($con);
}

$message = $_POST['message'];
$subject = $_POST['subject'];
$header = "From: jnebeker91@gmail.com";

while($row = mysqli_fetch_assoc($result)) {
  $email = $row['Email'];
  if(mail($email, $subject, $message, $header)) {
    echo "Newsletter sent to $email <br>";
  } else {
    echo "Newsletter failed to send to $email <br>";
  }
}

$result->close();

$con->close();
?>
