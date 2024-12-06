<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Results.css">';

error_log(print_r($exercise, true));
error_log(print_r($field, true));
error_log(print_r($answers, true));

ob_start();
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?= $exercise["id"]; ?>/fields"><?= htmlspecialchars($exercise["title"], ENT_QUOTES, 'UTF-8') ?></a></span>
    </section>
</header>

<main class="container">
    <h1>r343r3r</h1>

    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><a href="/exercises/227/fulfillments/173">2024-12-06 07:08:56 UTC</a></td>
                <td>hkl/gj;</td>
            </tr>
            <tr>
                <td><a href="/exercises/227/fulfillments/174">2024-12-06 07:08:59 UTC</a></td>
                <td>xvbncm,b</td>
            </tr>
            <tr>
                <td><a href="/exercises/227/fulfillments/175">2024-12-06 07:09:03 UTC</a></td>
                <td>ugo;</td>
            </tr>
            <tr>
                <td><a href="/exercises/227/fulfillments/176">2024-12-06 07:09:11 UTC</a></td>
                <td>bartyv</td>
            </tr>
        </tbody>
    </table>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
