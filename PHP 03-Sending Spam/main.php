<?php
$db = "jnebulaDB";
$server = "localhost";
$user = "jnebula";
$pass = "Gr00vym0ve7!";
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
  $result = mysqli_query($con, $query);
} else {
  echo mysqli_error($con);
}

mysqli_close($result);

mysqli_close($con);
?>
