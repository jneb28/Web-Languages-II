<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Request Confirmation</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <?php
      $name = $_POST['name'];
      $age = $_POST['age'];
      $sex = $_POST['sex'];
      $email = $_POST['email'];
      $to = 'jnebeker91@gmail.com';
      $subject = 'Contact Request';
      $message = "Hello Josh, I'm " . $name . ", a " . $age . " year old " . $sex . ", and my email is " . $email;
      mail($to, $subject, $message, 'From:' . $email);
      echo '<h1 style="font-size: 36px; color: rgba(111, 111, 111, .70); text-align: center;">Contact request sent!</h1>';
    ?>
  </body>
</html>
