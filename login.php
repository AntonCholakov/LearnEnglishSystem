<?php
require_once '/partials/header.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '/DAL/UsersRepository.php';
    $usersRepository = new UsersRepository();

    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields required!";
        header('Location: login.php');
        exit();
    }

    $user = $usersRepository->getByUsernameAndPassword($username, $password);

    if ($user != null) {
        $_SESSION["LoggedUserId"] = $user->getId();
        $_SESSION["LoggedUserUsername"] = $user->getUsername();
        $_SESSION["LoggedUserIsAdmin"] = $user->getRoleId() == 1;

        header('Location: index.php');
        exit();
    }

    $_SESSION['error'] = "Incorrect username/password";
}
?>

<div class="card-panel hoverable">
    <header>
        <h4>Login</h4>
    </header>

    <div class="row">
        <?php require_once '/partials/error-message.php' ?>
    </div>

    <div class="row">
        <form class="col s12" action="login.php" method="POST">

            <div class="row">
                <div class="input-field col s12">
                    <label for="username">Username</label>
                    <input name="username" id="username" type="text" class="validate" required>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" class="validate" required>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <a href="register.php" class="left">Do not have an account? Register</a>
                    <button class="btn waves-effect waves-light right" type="submit" name="action">Login
                        <i class="small material-icons right">perm_identity</i>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<?php require_once '/partials/footer.php' ?>