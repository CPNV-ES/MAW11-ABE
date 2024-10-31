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

    <form action="/exercises" accept-charset="UTF-8" method="post">

        <div class="field">
            <label for="exercise_title">Title</label>
            <input type="text" name="title" id="exercise_title" />
        </div>

        <div class="actions">
            <input type="submit" name="commit" value="Create Exercise" />
        </div>
    </form>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
