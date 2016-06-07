<?php
	require_once '/partials/header-admin.php';

	require_once '/DAL/UsersRepository.php';
	$usersRepository = new UsersRepository();
	$users = $usersRepository->getAll();

	require_once '/DAL/RolesRepository.php';
	$rolesRepository = new RolesRepository();
?>

<h2>Users</h2>

<div>
	<a href="edit_user.php">Add new user</a>
</div>

<table>
	<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Role</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($users as $user) :
		?>

		<tr>
			<td><?= $user->getUsername() ?></td>
			<td><?= $user->getEmail() ?></td>
			<td><?= $rolesRepository->getById($user->getRoleId())->getName()  ?></td>
			<td>
				<a href="edit_user.php?id=<?= $user->getId() ?>">Edit</a> |
				<a href="delete_user.php?id=<?= $user->getId() ?>">Delete</a>
			</td>
		</tr>

		<?php
			endforeach;
		?>
	</tbody>
</table>

<?php
require_once '/partials/footer.php';
?>