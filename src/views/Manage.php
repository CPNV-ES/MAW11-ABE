<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Manage.css">';

ob_start();
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
    </section>
</header>

<main class="container">
    <div class="row">
        <section class="column">
            <h1>Building</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($exercises["building"] as $buildingExercise): ?>
                        <tr>
                            <td><?= $buildingExercise["title"] ?></td>
                            <td>
                                <a title="Manage fields" href="/exercises/<?= $buildingExercise["id"] ?>/fields"><i class="fa fa-edit"></i></a>
                                <a href="/exercises/<?= $buildingExercise["id"]; ?>/delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="column">
            <h1>Answering</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($exercises["answering"] as $answeringExercise): ?>
                        <tr>
                            <td><?= $answeringExercise["title"] ?></td>
                            <td>
                                <a title="Show results" href="/exercises/<?= $answeringExercise["id"] ?>/results"><i class="fa fa-chart-bar"></i></a>
                                <a title="Close" href="/exercises/<?= $answeringExercise["id"]; ?>?status=closed"><i class="fa fa-minus-circle"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="column">
            <h1>Closed</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($exercises["closed"] as $closedExercise): ?>
                        <tr>
                            <td><?= $closedExercise["title"] ?></td>
                            <td>
                                <a title="Show results" href="/exercises/<?= $closedExercise["id"] ?>/results"><i class="fa fa-chart-bar"></i></a>
                                <a href="/exercises/<?= $closedExercise["id"]; ?>/delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
