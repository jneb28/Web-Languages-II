<?php
$db = "joshuane_jnebulaDB";
$server = "localhost";
$user = "joshuane_beker";
$pass = "pottop77";
$con = mysqli_connect($server, $user, $pass, $db);
if($con->connect_errno) {
  echo $con->connect_error;
}
$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$email = $_POST['email'];
if(isset($_POST['newsletter']) && $_POST['newsletter'] == 'true') {
  $newsletter = $_POST['newsletter'];
} else {
  $newsletter = 'false';
}

$query = "INSERT INTO News (FirstName, LastName, Email, Newsletter) VALUES ('$firstName', '$lastName', '$email', '$newsletter')";

if(!mysqli_error($con)) {
  $result = $con->query($query);
} else {
  echo mysqli_error($con);
}

$con->close();
?>
