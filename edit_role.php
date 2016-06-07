<?php
require_once '/partials/header-admin.php';

require_once '/DAL/RolesRepository.php';

$rolesRepository = new RolesRepository();
$role = new Role();

if (isset($_GET['id'])) {
    $role = $rolesRepository->getById($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = htmlspecialchars(trim($_POST["name"]));

    if (empty($name)) {
        $_SESSION['error'] = "All fields required!";
        $role->getId() > 0 ? header('Location: edit_role.php?id=' . $role->getId()) : header('Location: edit_role.php');
        exit();
    }

    $role->setName($name);

    $rolesRepository->save($role);

    header('Location: roles.php');
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

                <div class="col s12">

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="<?= $role->getName() ?>" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col right">
                            <input type="submit" class="btn" value="Save" />
                        </div>
                    </div>

                </div>
            </fieldset>
        </form>
    </div>

<?php
require_once '/partials/footer.php';
?>