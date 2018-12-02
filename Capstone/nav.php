<nav>
    <ul>
        <?php
            if(isset($_COOKIE['u-name'])) {
              echo '<li class="active">Welcome ' . $_COOKIE['u-name'] . '</li>';
              echo '<li><a href="index.php">Home</a></li>';
              echo '<li><a href="logout.php">Log out</a></li>';
            } else {
              echo '<li><a href="index.php">Home</a></li>';
              echo '<li><a href="sign-up.php">Sign Up</a></li>';
              echo '<li><a href="login.php">Login</a></li>';
              echo '<li><a href="dashboard.php">Admin</a></li>';
            }
        ?>
    </ul>
</nav>