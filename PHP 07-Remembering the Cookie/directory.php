<?php 
    include_once('logged.php');
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
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            <tr>
                <td>Josh N.</td>
                <td>jnebeker91@gmail.com</td>
                <td>801-427-9851</td>
            </tr>
        </table>
    </main>

    <footer>
        <p>&copy; 2018 The Cookie Sheet</p>
    </footer>
</body>
</html>