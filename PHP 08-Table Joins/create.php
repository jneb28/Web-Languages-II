<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once("config.php");
// Datebase: subscriber, Table: account
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, "subscriber") or die("Connection failed: " . mysqli_connect_error()); 
// Datebase: realm, Table: population
$con2 = mysqli_connect(DB_HOST, DB_USER, DB_PASS, "realm") or die("Connection failed: " . mysqli_connect_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="filter.php">Filter</a></li>
    </ul>
  </nav>

  <h1>Create</h1>

  <form action="create.php" method="post">
    <label>Name:</label>
    <input type="text" name="name">

    <label>Status:</label>
    <select name="status">
      <option value="A">Active</option>
      <option value="I">Inactive</option>
      <option value="S">Suspended</option>
      <option value="B">Banned</option>
      <option value="T">Terminated</option>
    </select>

    <label>Region:</label>
    <select name="region">
      <option value="NA">North America</option>
      <option value="SA">South America</option>
      <option value="OC">Oceanic</option>
      <option value="AS">Asia</option>
      <option value="EU">Europe</option>
    </select>

    <label>Level:</label>
    <input type="text" name="level">

    <input type="submit" name="submit">
    <?php
    if(isset($_POST["submit"])) {
      $name = $_POST["name"];
      $status = $_POST["status"];
      $region = $_POST["region"];
      $level = $_POST["level"];
      
      $query = "INSERT INTO account (name, status, region) VALUES ('$name', '$status', '$region')";
      mysqli_query($con, $query) or die ("error");
      $query = "SELECT id FROM account WHERE name = '$name'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $id = $row["id"];
      $query = "INSERT INTO population (account_id, level) VALUES ($id, '$level')";
      mysqli_query($con2, $query) or die ("error");
    }
    
    mysqli_close($con);
    mysqli_close($con2);
    ?>
  </form>
</body>
</html>

