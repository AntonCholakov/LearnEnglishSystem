<?php
require_once '/partials/header.php';

require_once '/DAL/WordsRepository.php';
$wordsRepo = new WordsRepository();

$word = new Word();
if (isset($_GET["id"])) {
    $word = $wordsRepo->getById($_GET["id"]);
}
else {
    $word = $wordsRepo->getRandom();
}

?>

    <div class="error-msg">
        <?php
        if (isset($_GET["id"])) :
            ?>
            <h1>Wrong! Try again!</h1>
            <?php
        endif;
        ?>
    </div>

    <div class="well bs-component">
        <form class="form-horizontal" action="check-word.php" method="POST">
            <fieldset>
                <legend>Guess the Word!</legend>
                <input type="hidden" name="id" value="<?= $word->getId() ?>">
                <img src="uploads/<?= $word->getImagePath() ?>" alt="image">
                <br>
                <label for="enword">EN</label>
                <input type="text" name="enword" id="enword" placeholder="Your answer...">
                <input type="submit" class="btn" value="Check!">
            </fieldset>
        </form>
    </div>

<?php
require_once '/partials/footer.php';
?>