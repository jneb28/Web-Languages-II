<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Midterm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
  </head>
  <body>

    <div class="container">

      <nav style="margin-bottom: 60px">
        <div class="row h-100 align-items-center">
          <div class="col-sm-6">
            <h1 class="justify-content-start title">Research Plus</h1>
          </div>
          <div class="col-sm-6">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
          </div>
        </div>
      </nav>

      <div class="row h-100 justify-content-center" style="margin: 0 10px">
        <div class="col-sm-6">
          <h1 class="form-heading">Confirm Deletion</h1>
          <form method="POST" action="confirm-delete.php" enctype="multipart/form-data"
          style="margin-bottom: 80px">
            <?php
                require_once('variables.php');
                $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");

                if(isset($_POST['confirm'])) {
                    $ID = $_POST['id'];
                    $query = "DELETE FROM researchemployee WHERE ID = $ID";
                    if(mysqli_query($con, $query)) {
                        @unlink($_POST['file']);
                        $_SESSION['message'] = '<p>Employee deleted</p>';
                        header('Location: dashboard.php');
                    } else {
                        echo "<p>Deletion failed</p>";
                    }
                }

                $id = $_GET['id'];
                $query = "SELECT * FROM researchemployee WHERE ID = $id";
                $result = mysqli_query($con, $query) or die ("Select failed");
                $employee = mysqli_fetch_array($result);

                
                echo "<ul class='list-group'>";

                echo "<li class='list-group-item'>";
                echo "Name: " . $employee['FirstName'] . " " . $employee['LastName'];
                echo "</li>";
                
                echo "<li class='list-group-item'>";
                echo "Age: " . $employee['Phone'];
                echo "</li>";

                echo "<li class='list-group-item'>";
                echo "Email: " . $employee['Email'];
                echo "</li>";

                echo "<li class='list-group-item'>";
                echo "Field: " . $employee['Field'];
                echo "</li>";

                echo "<li class='list-group-item'>";
                echo "Description: " . $employee['Description'];
                echo "</li>";

                echo "<li class='list-group-item photo-item'>";
                echo "Photo: ";
                echo '<img src="img/'.$employee['Photo'].'" alt="Employee Photograph">';
                echo "</li>";
                echo "</ul>";
                
                
                $con->close();
            ?>
            <input type="hidden" name="id" value="<?php echo $employee['ID']; ?>">
            <input type="hidden" name="file" value="<?php echo $employee['Photo']; ?>">

            <button type="submit" class="btn btn-danger" name="confirm">Confirm</button>
            <button type="submit" class="btn btn-secondary"><a href="read-more.php?id=<?php echo $id ?>">Back</a></button>
          </form>
        </div>
      </div>

      <footer>
        <div class="row h-100 align-items-center">
          <div class="col-sm-6">
            <h1 class="justify-content-start align-middle font-weight-normal title">&copy; 2018 Research Plus</h1>
          </div>
          <div class="col-sm-6">
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link" href="read2.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>