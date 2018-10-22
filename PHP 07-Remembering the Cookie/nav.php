<nav>
    <ul>
        <?php
            if(isset($_COOKIE['u-name'])) {
                echo '<li class="active">Welcome ' . $_COOKIE['u-name'] . '</li>';
                echo '<li><a href="directory.php">Directory</a></li>';
                echo '<li><a href="logout.php">Log out</a></li>';
            } else {
                echo '<li><a href="create.php">Create Account</a></li>';
                echo '<li><a href="login.php">Login</a></li>';
            }
        ?>
    </ul>
</nav>