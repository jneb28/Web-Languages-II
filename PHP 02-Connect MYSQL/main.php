<?php
$dbUsername = "jnebula";
$dbName = "jnebulaDB";
$dbPassword = "Gr00vym0ve7!";
$dbServer = "localhost";
$conn = new mysqli($dbServer, $dbUsername, $dbPassword, $dbName);

if($conn->connect_errno) {
  echo "connection failed... " . $conn->connect_error;
}

$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$age = $_POST['age'];
$email = $_POST['email'];
$address = $_POST['address'];

if(isset($_POST['newsletter']) && $_POST['newsletter'] == "true") {
  $newsletter = $_POST['newsletter'];
} else {
  $newsletter = "false";
}

$query = "INSERT INTO user (first_name, last_name, age, email, address, newsletter) VALUES ('$firstName', '$lastName', $age, '$email', '$address', '$newsletter')";
$conn->query($query);

$selectQuery = "SELECT id, first_name, last_name, age, email, address, newsletter FROM user";
$result = $conn->query($selectQuery);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "ID: " . $row['id'] . "<br>" .
      "Name: " . $row['first_name'] . " " . $row['last_name'] . "<br>" .
      "Age: " . $row['age'] . "<br>" .
      "Email: " . $row['email'] . "<br>" .
      "Address: " . $row['address'] . "<br>" .
      "Newsletter: " . $row['newsletter'] . "<hr><br>";
    }
}
$result->close();

$conn->close();
?>
