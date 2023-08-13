<nav>
    <?php
    session_start();
    if (!isset($_SESSION['userEmail'])) {
    ?>
        <ul>
            <li>Home</li>

            <li><a href="form.php"> login</a></li>
        </ul>

    <?php } else { ?>
        <ul>
            <li>Home</li>
            <li><a href="profile.php"> Profile</a></li>
            <li><a href="logout.php"> Logout</a></li>
        </ul>
    <?php } ?>
</nav>