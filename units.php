<?php
require_once '/partials/header-admin.php';

require_once '/DAL/UnitsRepository.php';
$unitsRepository = new UnitsRepository();
$units = $unitsRepository->getAll();

require_once '/DAL/WordsRepository.php';
$wordsRepository = new WordsRepository();
?>

    <h2>Units</h2>

    <div>
        <a href="edit_unit.php">Add new unit</a>
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
        foreach ($units as $unit) :
            ?>

            <tr>
                <td><?= $unit->getName() ?></td>
                <td>
                    <a href="edit_unit.php?id=<?= $unit->getId() ?>">Edit</a> |
                    <a class="modal-trigger" href="#modal<?= $unit->getId() ?>">Show all words</a> |
                    <a href="delete_unit.php?id=<?= $unit->getId() ?>">Delete</a>
                </td>

                <!-- Modal Words for Unit -->
                <div id="modal<?= $unit->getId() ?>" class="modal bottom-sheet">
                    <div class="modal-content">
                        <h4>Words for <?= $unit->getName() ?></h4>
                        <ul class="collection">
                            <?php
                                // Get all words for unit
                                $words = $wordsRepository->getAllByUnitId($unit->getId());

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
