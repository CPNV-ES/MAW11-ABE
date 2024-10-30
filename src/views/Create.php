<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Create.css">';
ob_start();

?>


<header class="heading managing">
    <section class="container">
        <a href="/"> <img src="/img/logo.png" alt="Logo" class="logo"> </a>
        <span class="exercise-label">New exercise</span>
    </section>
</header>

<main class="container">
    <h1>New Exercise</h1>

    <form action="/exercises" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="/HfdEImdtV4/XIdB53jcsjYbLUvBfg22I5rFpg0+G6a9Xb+9pk5+50F3o0EontYy3Sl3l97prWQsBeRtIAir7A==" />

        <div class="field">
            <label for="exercise_title">Title</label>
            <input type="text" name="exercise[title]" id="exercise_title" />
        </div>

        <div class="actions">
            <input type="submit" name="commit" value="Create Exercise" data-disable-with="Create Exercise" />
        </div>
    </form>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
