<?php 
	require_once '/partials/header-admin.php';
	
	require_once '/DAL/WordsRepository.php';
	require_once '/DAL/ComplexitiesRepository.php';
	require_once '/DAL/UnitsRepository.php';

	$wordsRepository = new WordsRepository();
	$word = new Word();

	if (isset($_GET['id'])) {
		$word = $wordsRepository->getById($_GET['id']);
	}

	$complexitiesRepository = new ComplexitiesRepository();
	$complexities = $complexitiesRepository->getAll();

	$unitsRepository = new UnitsRepository();
	$units = $unitsRepository->getAll();

	if($_SERVER['REQUEST_METHOD'] === 'POST') {

		$bgWord = htmlspecialchars(trim($_POST["bgword"]));
		$enWord = htmlspecialchars(trim($_POST["enword"]));
		$complexityId = htmlspecialchars(trim($_POST["complexity"]));
		$unitId = htmlspecialchars(trim($_POST["unit"]));

		if (empty($bgWord) || empty($enWord) || empty($complexityId) || empty($unitId)) {
			$_SESSION['error'] = "All fields required!";
			$word->getId() > 0 ? header('Location: edit_word.php?id=' . $word->getId()) : header('Location: edit_word.php');
			exit();
		}

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = true;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
	    if(!getimagesize($_FILES["image"]["tmp_name"])) {
	        echo "File is not an image.";
	        $uploadOk = false;
	    }

		// Check if file already exists
	    if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = false;
		}

		// Check file size
		if ($_FILES["image"]["size"] > 1500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = false;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = false;
		}

		if ($uploadOk) {
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
			}
		}
		else {
			$_SESSION['error'] = "Error uploading image!";
			$word->getId() > 0 ? header('Location: edit_word.php?id=' . $word->getId()) : header('Location: edit_word.php');
			exit();
		}

		$word->setBgWord($bgWord);
		$word->setEnWord($enWord);
		$word->setImagePath(basename($_FILES["image"]["name"]));
		$word->setComplexityId($complexityId);
		$word->setUnitId($unitId);
		
		$wordsRepository->save($word);
		
		header('Location: words.php');
		exit();
	}
?>

<div class="well bs-component">
	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
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
							<input type="text" name="bgword" id="bgword" class="validate" value="<?= $word->getBgWord() ?>" required />
							<label for="bgword">BG Word</label>
						</div>
					</div>

					<div class="row">
						<div class="input-field col s12">
							<label for="enword">EN Word</label>
							<input type="text" name="enword" id="enword" value="<?= $word->getEnWord() ?>" req />
						</div>
					</div>

					<div class="row">
						<div class="input-field col s12">
							<select name="complexity" id="complexity">
								<?php
								foreach ($complexities as $c) :
									?>
									<option value="<?= $c->getId() ?>" <?= $c->getId() == $word->getComplexityId() ? 'selected' : '' ?>><?= $c->getName() ?></option>
									<?php
								endforeach;
								?>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="input-field col s12">
							<select name="unit" id="unit">
								<?php
								foreach ($units as $u) :
									?>
									<option value="<?= $u->getId() ?>" <?= $u->getId() == $word->getUnitId() ? 'selected' : '' ?>><?= $u->getName() ?></option>
									<?php
								endforeach;
								?>
							</select>
						</div>
					</div>

				</div>

				<div class="col s6">

					<div class="row">
						<?php
						if (!empty($word->getImagePath()) || $word->getImagePath() != NULL) :
							?>
							<img src="uploads/<?= $word->getImagePath() ?>" alt="" class="word-picture">
							<?php
						endif;
						?>
					</div>

					<div class="row">
						<div class="input-field file-field col s12">
							<div class="btn">
								<span>File</span>
								<input type="file" name="image">
							</div>

							<div class="file-path-wrapper">
								<input class="file-path validate" type="text">
							</div>
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