<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Fulfillment.css">';

ob_start();
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <span class="exercise-title"></span></span>
    </section>
</header>

<main class="container">
    <div class="container dashboard">
        <section class="row">
            <div class="column">
                <a class="button answering column" href="/exercises/answering">Take an exercise</a>
            </div>
            <div class="column">
                <a class="button managing column" href="/exercises/new">Create an exercise</a>
            </div>
            <div class="column">
                <a class="button results column" href="/exercises">Manage an exercise</a>
            </div>
        </section>
    </div>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
