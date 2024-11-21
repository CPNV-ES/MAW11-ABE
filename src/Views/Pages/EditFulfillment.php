<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Fulfillment.css">';

$exercise = $data["exercise"];

ob_start();
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <span class="exercise-title"><?= htmlspecialchars($exercise["title"], ENT_QUOTES, 'UTF-8') ?></span></span>
    </section>
</header>

<main class="container">
    <h1>Your take</h1>
    <p>Bookmark this page, it's yours. You'll be able to come back later to finish.</p>

    <form action="/exercises/<?= $exercise["id"] ?>/fulfillments/<?= $fulfillment["id"] ?>" method="post">

        <?php foreach ($fields as $field): ?>
            <div class="field">
                <label for="fulfillment_answers_<?= $field["answer"]["id"] ?>_value"><?= htmlspecialchars($field["label"], ENT_QUOTES, 'UTF-8') ?></label>
                <?php if ($field["type"] === "single_line"): ?>
                    <input type="text" name="fulfillment[answers][<?= $field["answer"]["id"] ?>][value]"
                        id="fulfillment_answers_id_value" value="<?= htmlspecialchars($field["answer"]["contents"], ENT_QUOTES, 'UTF-8') ?>" />
                <?php else: ?>
                    <textarea name="fulfillment[answers][<?= $field["answer"]["id"] ?>][value]"
                        id="fulfillment_answers_<?= $field["answer"]["id"] ?>_value"
                        value="<?= htmlspecialchars($field["answer"]["contents"], ENT_QUOTES, 'UTF-8') ?>"></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="actions">
            <input type="submit" value="Save" />
        </div>
    </form>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
