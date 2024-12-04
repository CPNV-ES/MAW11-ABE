<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Results.css">';

ob_start();
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/226/results">Hibout</a></span>
    </section>
</header>

<main class="container">
    <h1>2024-11-23 12:55:54 UTC</h1>
    <dl class="answer">
        <dt>wer</dt>
        <dd>egrgg</dd>
        <dt>werwer</dt>
        <dd></dd>
    </dl>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
