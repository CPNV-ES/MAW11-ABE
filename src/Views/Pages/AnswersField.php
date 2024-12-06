<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Results.css">';

ob_start();
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?= $exercise["id"]; ?>/results"><?= htmlspecialchars($exercise["title"], ENT_QUOTES, 'UTF-8') ?></a></span>
    </section>
</header>

<main class="container">
    <h1><?= htmlspecialchars($field["label"], ENT_QUOTES, 'UTF-8') ?></h1>

    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($answers as $answer): ?>
                <tr>
                    <td><a href="/exercises/<?= $exercise["id"]; ?>/fulfillments/<?= $answer["fulfillment"]["id"]; ?>"><?= htmlspecialchars($answer["fulfillment"]["fulfillment"], ENT_QUOTES, 'UTF-8') ?> UTC</a></td>
                    <td><?= htmlspecialchars($answer["contents"], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
