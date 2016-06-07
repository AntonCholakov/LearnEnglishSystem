<?php
require_once '/partials/header-admin.php';

require_once '/DAL/ComplexitiesRepository.php';
$complexitiesRepository = new ComplexitiesRepository();
$complexities = $complexitiesRepository->getAll();

require_once '/DAL/WordsRepository.php';
$wordsRepository = new WordsRepository();
?>

<h2>Complexities</h2>

<div>
    <a href="edit_complexity.php">Add new complexity</a>
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
    foreach ($complexities as $complexity) :
        ?>

        <tr>
            <td><?= $complexity->getName() ?></td>
            <td>
                <a href="edit_complexity.php?id=<?= $complexity->getId() ?>">Edit</a> |
                <a class="modal-trigger" href="#modal<?= $complexity->getId() ?>">Show all words</a> |
                <a href="delete_complexity.php?id=<?= $complexity->getId() ?>">Delete</a>
            </td>

            <!-- Modal Words for Complexity Level -->
            <div id="modal<?= $complexity->getId() ?>" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4>Words for <?= $complexity->getName() ?></h4>
                    <ul class="collection">
                        <?php
                            // Get all words for complexity level
                            $words = $wordsRepository->getAllByComplexityId($complexity->getId());

                            foreach ($words as $word) :
                        ?>

                            <li class="collection-item avatar">
                                <img src="uploads/<?= $word->getImagePath() ?>" alt="" class="circle">
                                <span class="title"><?= $word->getEnWord() ?></span>
                                <p><?= $word->getBgWord() ?></p>
                                <a href="edit_word.php?id=<?= $word->getId() ?>" class="secondary-content" target="_blank">Edit</a>
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
