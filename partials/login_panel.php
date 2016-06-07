<ul class="right">
    <?php
        if (isset($_SESSION["LoggedUserId"])) :
    ?>
        <li>
            Hello <?= $_SESSION["LoggedUserUsername"] ?>
        </li>
        <li><a href="#">Edit</a></li>
        <li><a href="logout.php">Logout</a></li>

    <?php else: ?>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
    <?php endif; ?>
</ul>