<?php
$db = "joshuane_jnebulaDB";
$server = "localhost";
$user = "joshuane_beker";
$pass = "pottop77";
$con = mysqli_connect($server, $user, $pass, $db);
if($con->connect_errno) {
  echo $con->connect_error;
}

$query = "SELECT Email FROM News WHERE Newsletter = 'true'";
if(!mysqli_error($con)) {
  $result = $con->query($query);
} else {
  echo mysqli_error($con);
}

$message = $_POST['message'];
$subject = $_POST['subject'];
$header = "From: jnebeker91@gmail.com";

while($row = mysqli_fetch_assoc($result)) {
  $email = $row['Email'];
  echo $email ."\n". $subject ."\n". $message ."\n". $header;
  if(mail($email, $subject, $message, $header)) {
    echo "Newsletter sent to $email <br>";
  } else {
    echo "Newsletter failed to send to $email <br>";
  }
}

$result->close();

$con->close();
?>
