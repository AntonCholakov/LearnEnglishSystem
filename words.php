<?php
	require_once '/partials/header-admin.php';

	require_once '/DAL/WordsRepository.php';
	$wordsRepository = new WordsRepository();
	$words = $wordsRepository->getAll();

	require_once '/DAL/ComplexitiesRepository.php';
	$complexitiesRepository = new ComplexitiesRepository();
	require_once '/DAL/UnitsRepository.php';
	$unitsRepository = new UnitsRepository();
?>

<h2>Words</h2>

<div>
	<a href="edit_word.php">Add new word</a>
</div>

<table>
	<thead>
		<tr>
			<th>BG</th>
			<th>EN</th>
			<th>Image</th>
			<th>Complexity</th>
			<th>Unit</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($words as $word) :
		?>

		<tr>
			<td><?= $word->getBgWord() ?></td>
			<td><?= $word->getEnWord() ?></td>
			<td>
				<?php if (!empty($word->getImagePath())) : ?>
				<img src="uploads/<?= $word->getImagePath() ?>" width="100" height="100" />
				<?php endif; ?>
			</td>
			<td><?= $complexitiesRepository->getById($word->getComplexityId())->getName() ?></td>
			<td><?= $unitsRepository->getById($word->getUnitId())->getName() ?></td>
			<td>
				<a href="edit_word.php?id=<?= $word->getId() ?>">Edit</a> |
				<a href="delete_word.php?id=<?= $word->getId() ?>">Delete</a>
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