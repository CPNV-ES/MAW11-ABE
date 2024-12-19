<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Results.css">';

ob_start();

?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a
                href="/exercises/<?= $exercise["id"]; ?>/fields"><?= htmlspecialchars($exercise["title"], ENT_QUOTES, 'UTF-8') ?></a></span>
    </section>
</header>

<main class="container">
    <h1>2024-11-23 12:55:54 UTC</h1>
    <dl class="answer">
        <?php foreach ($fields as $field): ?>
            <dt><?= htmlspecialchars($field["label"], ENT_QUOTES, 'UTF-8') ?></dt>
            <dd><?= htmlspecialchars($field["answer"]["contents"], ENT_QUOTES, 'UTF-8') ?></dd>
        <?php endforeach; ?>
    </dl>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
