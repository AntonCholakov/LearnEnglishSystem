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

<div class="row">
    <form class="form-horizontal" action="check-word.php" method="POST">
        <fieldset>
            <legend>Guess the Word!</legend>

            <?php require_once '/partials/error-message.php' ?>

            <input type="hidden" name="id" value="<?= $word->getId() ?>">
            <input type="hidden" name="redirect" value="guessword">

            <label for="bgword">BG</label>
            <input type="text" name="bgword" id="bgword" value="<?= $word->getBgWord() ?>" readonly>
            <label for="enword">EN</label>
            <input type="text" name="enword" id="enword" placeholder="Your answer...">
            <input type="submit" class="btn" value="Check!">
        </fieldset>
    </form>
</div>

<?php
require_once '/partials/footer.php';
?>