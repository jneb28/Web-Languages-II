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

      <nav style="margin-bottom: 106px">
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
          <h1 class="form-heading">Employee Details</h1>
          <?php
            require_once('variables.php');
            $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");

            $id = $_GET['id'];
            $query = "SELECT * FROM researchemployee WHERE ID = $id";
            $result = mysqli_query($con, $query);
            $employee = mysqli_fetch_array($result);

            if(isset($_POST['update'])) {
                $firstName = $_POST['first-name'];
                $lastName = $_POST['last-name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $field = $_POST['field'];
                $description = $_POST['description'];
                $ID = $_POST['id'];

                $query = "UPDATE researchemployee SET FirstName='$firstName', LastName='$lastName',
                Phone='$phone', Email='$email', Field='$field', Description='$description' WHERE
                ID='$ID'";
                if(mysqli_query($con, $query)) {
                    $_SESSION['message'] = '<p>Employee updated</p>';
                    header('Location: read.php');
                    
                } else {
                    echo "<p>Update failed</p>";
                  }
              } 

            
            $con->close();
          ?>
            <form method="POST" action="read-more.php" enctype="multipart/form-data">
                <div class="form-group">
                <label for="first-name">First Name:</label>
                <input type="text" class="form-control" name="first-name" id="first-name"
                value="<?php echo $employee['FirstName']; ?>">
                </div>

                <div class="form-group">
                <label for="last-name">Last Name:</label>
                <input type="text" class="form-control" name="last-name" id="last-name"
                value="<?php echo $employee['LastName']; ?>">
                </div>

                <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" id="phone"
                value="<?php echo $employee['Phone']; ?>">
                </div>

                <div class="form-group">
                <label for="phone">Email:</label>
                <input type="email" class="form-control" name="email" id="email"
                value="<?php echo $employee['Email']; ?>">
                </div>

                <div class="form-group">
                <label for="last-name">Field:</label>
                <select class="custom-select" name="field" id="field">
                    <option selected><?php echo $employee['Field']; ?> (current)</option>
                    <option value="Astrology">Astrology</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Biology">Biology</option>
                </select>
                </div>

                <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" rows="3"
                value=""><?php echo $employee['Description']; ?></textarea>
                </div>

                <input type="hidden" name="id" value="<?php echo $employee['ID']; ?>">

                <button type="submit" class="btn btn-primary" name="update">Update</button>
                <button type="submit" class="btn btn-danger"><a href="confirm-delete.php?id=<?php echo $employee['ID']; ?>">Delete</a></button>
                <button type="submit" class="btn btn-secondary"><a href="read.php">Back</a></button>
                
          </form>
          
        </div>
      </div>


      <footer style="margin-top: 106px">
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