<?php
require_once '/partials/header-admin.php';

require_once '/DAL/UsersRepository.php';
require_once '/DAL/RolesRepository.php';

$usersRepository = new UsersRepository();
$user = new User();

if (isset($_GET['id'])) {
    $user = $usersRepository->getById($_GET['id']);
}

$rolesRepository = new RolesRepository();
$roles = $rolesRepository->getAll();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $roleId = htmlspecialchars(trim($_POST["role"]));

    if (empty($username) || empty($password) || empty($email) || empty($roleId)) {
        $_SESSION['error'] = "All fields required!";
        $user->getId() > 0 ? header('Location: edit_user.php?id=' . $user->getId()) : header('Location: edit_user.php');
        exit();
    }

    $user->setUsername($username);
    $user->setPassword($password);
    $user->setEmail($email);
    $user->setRoleId($roleId);

    $usersRepository->save($user);

    header('Location: users.php');
    exit();
}
?>

    <div class="row">
        <form class="form-horizontal" action="" method="POST">
            <fieldset>

                <div class="row">
                    <div class="col s12">
                        <?php require_once '/partials/error-message.php' ?>
                    </div>
                </div>

                <div class="row">

                    <div class="col s6">

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" value="<?= $user->getUsername() ?>" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" value="<?= $user->getPassword() ?>" required />
                            </div>
                        </div>

                    </div>

                    <div class="col s6">

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?= $user->getEmail() ?>" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <select name="role" id="role">
                                    <?php
                                    foreach ($roles as $r) :
                                        ?>
                                        <option value="<?= $r->getId() ?>" <?= $r->getId() == $user->getRoleId() ? 'selected' : '' ?>><?= $r->getName() ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col right">
                                <input type="submit" class="btn" value="Save" />
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