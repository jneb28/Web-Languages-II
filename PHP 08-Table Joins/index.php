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
      <li><a href="create.php">Create</a></li>
      <li><a href="filter.php">Filter</a></li>
    </ul>
  </nav>
  <h1>Join Tables</h1>
  <table>
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Status</th>
    <th>Region</th>
    <th>Level</th>
    <th>Pop_ID</th>
    <th>Account_ID</th>
    </tr>
    
  
  <?php
  $filter = isset($_GET["filter"]) ? $_GET["filter"] : "";
  
  switch ($filter) {
    case 1: 
      $query = "SELECT * FROM subscriber.account AS a
      INNER JOIN realm.population AS p 
      ON a.id = p.account_id
      WHERE status = 'A'
      ORDER BY name ASC";
      $filter = "";
      break;

    case 2:
      $query = "SELECT * FROM subscriber.account AS a
      INNER JOIN realm.population AS p 
      ON a.id = p.account_id
      WHERE status = 'I'
      ORDER BY name ASC";
      break;

    case 3:
      $query = "SELECT * FROM subscriber.account AS a
      INNER JOIN realm.population AS p 
      ON a.id = p.account_id
      WHERE status = 'S'
      ORDER BY name ASC";
      break;

    case 4:
      $query = "SELECT * FROM subscriber.account AS a
      INNER JOIN realm.population AS p 
      ON a.id = p.account_id
      WHERE status = 'B'
      ORDER BY name ASC";
      break;
      
    case 5:
      $query = "SELECT * FROM subscriber.account AS a
      INNER JOIN realm.population AS p 
      ON a.id = p.account_id
      WHERE status = 'T'
      ORDER BY name ASC";
      break;

    default:
      $query = "SELECT * FROM subscriber.account AS a
      INNER JOIN realm.population AS p 
      ON a.id = p.account_id";
  }

  
  
  
  
  $result = mysqli_query($con, $query) or die("error");
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["status"] . "</td>";
    echo "<td>" . $row["region"] . "</td>";
    echo "<td>" . $row["level"] . "</td>";
    echo "<td>" . $row["pop_id"] . "</td>";
    echo "<td>" . $row["account_id"] . "</td>";
    echo "</tr>";
  }


  mysqli_close($con);
  mysqli_close($con2);
  ?>
  </table>
</body>
</html>
