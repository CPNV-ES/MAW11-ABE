<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Results.css">';

$exercise = $data["exercise"];

ob_start();
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?= $exercise["id"]; ?>/fields"><?= htmlspecialchars($exercise["title"], ENT_QUOTES, 'UTF-8') ?></a></span>
    </section>
</header>

<main class="container">
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <?php foreach ($fields as $field): ?>
                    <th><a href="/exercises/<?= $exercise["id"]; ?>/results/<?= $field["id"]; ?>"><?= htmlspecialchars($field["label"], ENT_QUOTES, 'UTF-8') ?></a></th>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($fulfillments as $fulfillment): ?>
                <tr>
                    <td><a href="/exercises/<?= $exercise["id"]; ?>/fulfillments/<?= $fulfillment["id"]; ?>"><?= htmlspecialchars($fulfillment["fulfillment"], ENT_QUOTES, 'UTF-8') ?> UTC</a></td>
                    <?php foreach ($fields as $field): ?>
                        <td class="answer"><i class="fa fa-check short"></i></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/layout.php";
