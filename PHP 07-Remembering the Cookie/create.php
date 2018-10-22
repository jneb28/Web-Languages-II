<?php 
    require_once('variables.php');
    $con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ("Error: Could not connect to database.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400" rel="stylesheet">
</head>
<body>
    
    <header>
        <h1><a href="index.php">The Cookie Sheet</a></h1>
        <?php 
            include_once('nav.php');
        ?>
    </header>
    
    <main>
        
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <h1>Create Account</h1>
            <label for="f-name">First Name:</label>
            <input type="text" name="f-name" id="f-name" value="<?php if(!empty($firstName)) echo $firstName; ?>" required>
            <label for="l-name">Last Name:</label>
            <input type="text" name="l-name" id="l-name" value="<?php if(!empty($lastName)) echo $lastName; ?>" required>
            <label for="u-name">Username:</label>
            <input type="text" name="u-name" id="u-name" value="<?php if(!empty($username)) echo $username; ?>" required>
            <label for="pw">Password:</label>
            <input type="password" name="pw1" id="pw" required>
            <label for="pw">Repeat Password:</label>
            <input type="password" name="pw2" id="pw" required>

            <input type="submit" name="submit" value="Submit" id="submit">

            <?php 
                if(isset($_POST['submit'])) {
                    $firstName = mysqli_real_escape_string($con, trim($_POST['f-name']));
                    $lastName = mysqli_real_escape_string($con, trim($_POST['l-name']));
                    $username = mysqli_real_escape_string($con, trim($_POST['u-name']));
                    $password = mysqli_real_escape_string($con, trim($_POST['pw1']));
                    $passwordRepeat = mysqli_real_escape_string($con, trim($_POST['pw2']));

                    if(($password === $passwordRepeat) && !empty($username) && !empty($password) && !empty($passwordRepeat)) {
                        $query = "SELECT * FROM user WHERE Username = '$username'";
                        $duplicate = mysqli_query($con, $query);
                        if(mysqli_num_rows($duplicate) == 0) {
                            $query = "INSERT INTO user (FirstName, LastName, Username, Password, Date) values ('$firstName', '$lastName', '$username', sha1('$password'), NOW())";
                            if($result = mysqli_query($con, $query)) {
                                echo '<p class="success">Account created</p>';
                                echo '<a href="login.php">Log in to your account</a>';
                                //setcookie('u-name', $username, time() + (60*60*24*30));
                                //setcookie('f-name', $firstName, time() + (60*60*24*30));
                                //setcookie('l-name', $lastName, time() + (60*60*24*30));
                                mysqli_close($con);
                            } else {
                                echo '<p class="info">Could not create account, please try again</p>';
                            }
                        } else {
                            echo '<p class="info">* Username taken, please try again</p>';
                        }
                    } else {
                        echo '<p class="info">* Passwords do not match, please try again</p>';
                    }
                }
            ?>
        </form>
        
    </main>

    <footer>
        <p>&copy; 2018 The Cookie Sheet</p>
    </footer>
</body>
</html>