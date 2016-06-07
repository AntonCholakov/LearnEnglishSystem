<?php
require_once '/partials/header-admin.php';

require_once '/DAL/RolesRepository.php';
$rolesRepository = new RolesRepository();
$role = $rolesRepository->getAll();

require_once '/DAL/UsersRepository.php';
$usersRepository = new UsersRepository();
?>

    <h2>Roles</h2>

    <div>
        <a href="edit_role.php">Add new role</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($role as $role) :
            ?>

            <tr>
                <td><?= $role->getName() ?></td>
                <td>
                    <a href="edit_role.php?id=<?= $role->getId() ?>">Edit</a> |
                    <a class="modal-trigger" href="#modal<?= $role->getId() ?>">Show all users</a> |
                    <a href="delete_role.php?id=<?= $role->getId() ?>">Delete</a>
                </td>

                <!-- Modal Users for Role -->
                <div id="modal<?= $role->getId() ?>" class="modal bottom-sheet">
                    <div class="modal-content">
                        <h4><?= $role->getName() ?>s</h4>
                        <ul class="collection">
                            <?php
                                // Get all users for role
                                $users = $usersRepository->getAllByRoleId($role->getId());

                                foreach ($users as $user) :
                            ?>

                                <li class="collection-item">
                                    <span class="title"><?= $user->getUsername() ?></span>
                                    <p><?= $user->getEmail() ?></p>
                                    <a href="edit_user.php?id=<?= $user->getId() ?>" class="secondary-content" target="_blank">Edit</a>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                    </div>
                </div>

            </tr>

            <?php
        endforeach;
        ?>
        </tbody>
    </table>

<?php
require_once '/partials/footer.php';
?>

<script>
    $(document).ready(function() {
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
    })
</script>

