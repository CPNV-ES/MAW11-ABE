<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Fulfillment.css">';

ob_start();
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>

    </section>
</header>

<main class="container">
    <ul class="ansering-list">
        <?php foreach ($exercises as $exercise): ?>
            <li class="row">
                <div class="column card">
                    <div class="title"><?= htmlspecialchars($exercise['title'], ENT_QUOTES, 'UTF-8') ?></div>
                    <a class="button" href="/exercises/<?= $exercise['id'] ?>/fulfillments/new">Take it</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</main>


<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
