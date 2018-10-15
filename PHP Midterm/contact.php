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

      <?php
        require_once('variables.php');
        $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");

        $id = $_GET['id'];
        $query = "SELECT * FROM researchemployee WHERE ID = $id";
        $result = mysqli_query($con, $query) or die ("Select query failed");
        $employee = mysqli_fetch_array($result);
      ?>
        

      <div class="row h-100 justify-content-center" style="margin: 0 10px">
        <div class="col-sm-6">
          <h1 class="form-heading">Contact Employee</h1>

          <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label for="to">To:</label>
              <input type="text" class="form-control" name="to" id="to" 
              value="<?php echo $employee['Email']; ?>">
            </div>

            <div class="form-group">
              <label for="from">From:</label>
              <input type="email" class="form-control" name="from" id="from">
            </div>

            <div class="form-group">
              <label for="last-name">Subject:</label>
              <input type="text" class="form-control" name="subject" id="subject">
            </div>

            <div class="form-group">
              <label for="message">Message:</label>
              <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-success" name="send">Send</button>
            <button type="button" class="btn btn-secondary"><a href="read.php">Back</a></button>
          </form>

          <?php
            if(isset($_POST['send'])) {
              $to = $_POST['to'];
              $from = 'From: ' . $_POST['from'];
              $subject = $_POST['subject'];
              $message = $_POST['message'];
              
              if(mail($to, $subject, $message, $from)) {
                echo "<p>Message sent!</p>";
              } else {
                echo "<p>Message failed</p>";
              }
            }
            $con->close();
          ?>
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
