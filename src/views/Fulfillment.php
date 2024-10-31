<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Fulfillment.css">';

ob_start();
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <span class="exercise-title"><?= $exercise["title"] ?></span></span>
    </section>
</header>

<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>

    <form action="/exercises/<?= $exercise["id"] ?>/fulfillments" method="post">

        <?php foreach ($fields as $field): ?>
            <div class="field">
                <label for="fulfillment_answers_attributes__value"><?= $field["label"] ?></label>
                <?php if ($field["type"] === "single_line"): ?>
                    <input type="text" name="fulfillment[answers_attributes][][value]" id="fulfillment_answers_attributes__value" />
                <?php else: ?>
                    <textarea name="fulfillment[answers_attributes][][value]" id="fulfillment_answers_attributes__value"></textarea>
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
