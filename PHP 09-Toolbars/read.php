<?php 
    require_once('config.php');
    $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP 09 Toolbars</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="create.php">Add</a></li>
      <li><a href="read.php">Search</a></li>
    </ul>
  </nav>
  <main>
  <h1>Search Bands</h1>
    <form action="read.php" method="post">
      <label for="search">Search</label>
      <input type="text" name="search" id="search">
      <input type="submit" name="submit" value="Submit" id="submit">
    </form>
    
    <table>
      <tr>
        <th>Name</th>
        <th>Genre</th>
        <th>Date</th>
      </tr>
    <?php

      if(isset($_POST['submit'])) {
        //$search = strtolower($_POST['search']);
        $search = strFunctions(1, $_POST['search']);

        //STRING FUNCTION #1
        //$searchReplace = str_replace(",", " ", $search);
        $searchReplace = strFunctions(2, $search);

        //STRING FUNCTION #2
        //$searchExplode = explode(" ", $searchReplace);
        $searchExplode = strFunctions(3, $searchReplace);

        foreach ($searchExplode as $term) {
          if(!empty($term)) {
            $searchTerms[] = $term;
          }
        }

        $likeTerms = array();
        foreach($searchTerms as $term) {
          $likeTerms[] = "Name LIKE '%$term%' OR Genre LIKE '%$term%' or Date LIKE '%$term%'";
        }
        
        //STRING FUNCTION #3
        $likeQueries = implode(" OR ", $likeTerms);

      }


      //CUSTOM FUNCTION
      function strFunctions($num, $str) {
        switch($num) {
          case 1:
          $result = strtolower($str);
          break;
          case 2: 
          $result = str_replace(",", " ", $str);
          break;
          case 3:
          $result = explode(" ", $str);
          break;
          default:
          $result = "strFunctions Failed";
        }
        return $result;
      }



        $query = "SELECT * FROM band"; //select date from tbemp order by convert(datetime, date, 101) ASC
        if(!empty($likeQueries)) {
          $query .= " WHERE $likeQueries";
        }

        $result = mysqli_query($con, $query) or die("Query Failed");

        while($row = mysqli_fetch_assoc($result)) {

          //STRING FUNCTION #4
          $intMonth = substr($row["Date"], 0, 2);
          $day = substr($row["Date"], 3, 2);
          $year = substr($row["Date"], 6, 4);
          $strMonth = getMonthName($intMonth);
          $strDate = "$strMonth $day, $year";

          echo "<tr>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Genre"] . "</td>";
            echo "<td>" . $strDate . "</td>"; //$row["Date"]
          echo "</tr>";
        }
      
      
      //SWITCH STATEMENT
      function getMonthName($data) {
        switch($data) {
          case 01:
          $result = "Jan.";
          break;
          case 02:
          $result = "Feb.";
          break;
          case 03:
          $result = "Mar.";
          break;
          case 04:
          $result = "Apr.";
          break;
          case 05:
          $result = "May";
          break;
          case 06:
          $result = "Jun.";
          break;
          case 07:
          $result = "Jul.";
          break;
          case "08":
          $result = "Aug.";
          break;
          case "09":
          $result = "Sep.";
          break;
          case 10:
          $result = "Oct.";
          break;
          case 11:
          $result = "Nov.";
          break;
          case 12:
          $result = "Dec.";
          break;
          default:
          $result = "Error";
        }
        return $result;
      }

      mysqli_close($con);
    ?>
    </table>
  </main>
</body>
</html>