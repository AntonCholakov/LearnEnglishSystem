<?php require_once '/partials/header.php' ?>

<div class="row">

	<div class="col s4">
		<div class="center promo promo-example">
			<i class="material-icons large"></i>
			<p class="promo-caption">Guess Word</p>
			<p class="light center">Play guessing the word from english to bulgarian</p>
			<a href="guessword.php">Play now!</a>
		</div>
	</div>
	<div class="col s4">
		<div class="center promo promo-example">
			<i class="material-icons large"></i>
			<p class="promo-caption">Guess Image</p>
			<p class="light center">Play guessing the word from english to bulgarian</p>
			<a href="guessimage.php">Play now!</a>
		</div>
	</div>
	<div class="col s4">
		<div class="center promo promo-example">
			<i class="material-icons large"></i>
			<p class="promo-caption">Leave feedback</p>

			<form action="feedback.php" class="form-horizontal">

				<div class="row">
					<div class="input-field col s12">
						<label for="email">Email</label>
						<input name="email" id="email" type="email" class="validate">
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<label for="feedback">Feedback</label>
						<textarea name="feedback" id="feedback" class="materialize-textarea"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<button class="btn waves-effect waves-light right" type="submit" name="action">Send
							<i class="small material-icons right">email</i>
						</button>
					</div>
				</div>

			</form>
		</div>
	</div>

</div>

<?php require_once '/partials/footer.php' ?>