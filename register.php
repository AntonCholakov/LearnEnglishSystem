<?php
require_once '/partials/header.php';

require_once '/DAL/UsersRepository.php';

$usersRepository = new UsersRepository();
$user = new User();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $repassword = htmlspecialchars(trim($_POST["repassword"]));
    $email = htmlspecialchars(trim($_POST["email"]));

    if (empty($username) || empty($password) || empty($repassword) || empty($email)) {
        $_SESSION['error'] = "All fields required!";
        header('Location: register.php');
        exit();
    }

    if ($password !== $repassword) {
        $_SESSION['error'] = "Passwords do not match";
        header('Location: register.php');
        exit();
    }

    $user->setUsername($username);
    $user->setPassword($password);
    $user->setEmail($email);
    $user->setRoleId(3); // TODO make it smart

    $usersRepository->save($user);

    header('Location: users.php');
    exit();
}
?>

<?php require_once '/partials/error-message.php' ?>
    <div class="row">
        <form class="form-horizontal" action="" method="POST">
            <fieldset>

                <div class="row">
                    <?php require_once '/partials/error-message.php' ?>
                </div>

                <div class="row">

                    <div class="col s6">

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                        </div>

                    </div>

                    <div class="col s6">

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="repassword">Repeat Password</label>
                                <input type="password" name="repassword" id="repassword" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col right">
                                <input type="submit" class="btn" value="Register" />
                            </div>
                        </div>

                    </div>

                </div>

            </fieldset>
        </form>
    </div>

<?php
require_once '/partials/footer.php';
?>