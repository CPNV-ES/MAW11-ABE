<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Create.css">';

// Base controller variables
$exercise = $data["exercise"];
$field = $data["field"];

ob_start();

?>

<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a
                href="/exercises/<?= $exercise["id"]; ?>/fields"><?= htmlspecialchars($exercise["title"], ENT_QUOTES, 'UTF-8') ?></a></span>
    </section>
</header>

<main class="container">
    <h1>Editing Field</h1>

    <form action="/exercises/<?= $exercise["id"] ?>/fields/<?= $field["id"] ?>" accept-charset="UTF-8" method="post">

        <div class="field">
            <label for="field_label">Label</label>
            <input type="text" value="<?= $field["label"] ?>" name="field[label]" id="field_label" />
        </div>

        <div class="field">
            <label for="field_value_kind">Value kind</label>
            <select name="field[type]" id="field_value_kind">
                <option <?= $field["type"] === "single_line" ? 'selected' : '' ?> value="single_line">Single line text
                </option>
                <option <?= $field["type"] === "single_line_list" ? 'selected' : '' ?> value="single_line_list">List of
                    single lines</option>
                <option <?= $field["type"] === "multi_line" ? 'selected' : '' ?> value="multi_line">Multi-line text
                </option>
            </select>
        </div>

        <div class="actions">
            <input type="submit" value="Update Field" />
        </div>

    </form>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
