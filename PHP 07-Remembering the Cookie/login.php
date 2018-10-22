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
        
        <form action="login.php" method="POST" enctype="multipart/form-data">
            <h1>Login</h1>
            <label for="u-name">Username:</label>
            <input type="text" name="u-name" id="u-name" value="<?php if(!empty($username)) echo $username; ?>" required>
            <label for="pw">Password:</label>
            <input type="password" name="pw1" id="pw" required>

            <input type="submit" name="submit" value="Log in" id="submit">

            <?php 
                if(isset($_POST['submit'])) {
                    $username = mysqli_real_escape_string($con, trim($_POST['u-name']));
                    $password = mysqli_real_escape_string($con, trim($_POST['pw1']));
                    
                    $query = "SELECT * FROM user WHERE Username = '$username' AND Password = sha1('$password')";
                    $result = mysqli_query($con, $query);

                    if(mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_array($result);

                        setcookie('u-name', $username, time() + (60*60*24*30));
                        setcookie('f-name', $firstName, time() + (60*60*24*30));
                        setcookie('l-name', $lastName, time() + (60*60*24*30));

                        header('Location: index.php');
                    } else {
                        echo '<p class="info">Invalid login attempt, please try again</p>';
                        echo '<p>OR</p>';
                        echo '<a href="create.php" class="info">Create an account</a>';
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