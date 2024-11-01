<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Fields.css">';

$exerciseData = $data["exercise"];

ob_start();
?>


<header class="heading managing">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?= $exerciseData["id"]; ?>/fields"><?= htmlspecialchars($exerciseData["title"], ENT_QUOTES, 'UTF-8') ?></a></span>
    </section>
</header>

<main class="container">
    <div class="row">
        <section class="column">
            <h1>Fields</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Value kind</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($fields as $field): ?>
                        <tr>
                            <td><?= htmlspecialchars($field["label"], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= $field["type"] ?></td>
                            <td>
                                <a title="Edit" href="/exercises/<?= $exerciseData["id"]; ?>/fields/<?= $field["id"]; ?>/edit"><i class="fa fa-edit"></i></a>
                                <a href="/exercises/<?= $exerciseData["id"]; ?>/fields/<?= $field["id"]; ?>/delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a onclick="return confirm('Are you sure? You won\'t be able to further edit this exercise')" class="button" href="/exercises/<?= $exerciseData["id"]; ?>?status=answering"><i class="fa fa-comment"></i> Complete and be ready for answers</a>

        </section>
        <section class="column">
            <h1>New Field</h1>
            <form action="/exercises/<?= $exerciseData["id"]; ?>/fields" accept-charset="UTF-8" method="post">
                <div class="field">
                    <label for="field_label">Label</label>
                    <input type="text" name="field[label]" id="field_label" />
                </div>

                <div class="field">
                    <label for="field_value_kind">Value kind</label>
                    <select name="field[type]" id="field_value_kind">
                        <option selected="selected" value="single_line">Single line text</option>
                        <option value="single_line_list">List of single lines</option>
                        <option value="multi_line">Multi-line text</option>
                    </select>
                </div>

                <div class="actions">
                    <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field" />
                </div>
            </form>
        </section>
    </div>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/layout.php";
