<?php
require_once '/partials/header-admin.php';

require_once '/DAL/UnitsRepository.php';

$unitsRepository = new UnitsRepository();
$unit = new Unit();

if (isset($_GET['id'])) {
    $unit = $unitsRepository->getById($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = htmlspecialchars(trim($_POST["name"]));

    if (empty($name)) {
        $_SESSION['error'] = "All fields required!";
        $unit->getId() > 0 ? header('Location: edit_unit.php?id=' . $unit->getId()) : header('Location: edit_unit.php');
        exit();
    }

    $unit->setName($name);

    $unitsRepository->save($unit);

    header('Location: units.php');
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
                            <input type="text" name="name" id="name" value="<?= $unit->getName() ?>" required />
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