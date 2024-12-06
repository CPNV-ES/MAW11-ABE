<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Fulfillment.css">';

ob_start();
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <span class="exercise-title"><?= htmlspecialchars($exercise["title"], ENT_QUOTES, 'UTF-8') ?></span></span>
    </section>
</header>

<main class="container">
    <h1>Fulfillments for <?= $exercise["title"] ?></h1>

    <table>
        <thead>
            <tr>
                <th>Taken at</th>
                <th colspan="3"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($fulfillments as $fulfillment): ?>
                <tr>
                    <td><?= $fulfillment["fulfillment"] ?> UTC</td>
                    <td><a href="/exercises/<?= $exercise["id"] ?>/fulfillments/<?= $fulfillment["id"] ?>">Show</a></td>
                    <td><a href="/exercises/<?= $exercise["id"] ?>/fulfillments/<?= $fulfillment["id"] ?>/edit">Edit</a></td>
                    <td><a href="/exercises/<?= $exercise["id"] ?>/fulfillments/<?= $fulfillment["id"] ?>/delete">Destroy</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
