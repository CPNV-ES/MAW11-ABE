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
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>

    <form action="/exercises/id/fulfillments" method="post">

        <input type="hidden" name="fulfillment[answers_attributes][][field_id]" id="fulfillment_answers_attributes__field_id" />

        <div class="field">
            <label for="fulfillment_answers_attributes__value">Single line</label>
            <input type="text" name="fulfillment[answers_attributes][][value]" id="fulfillment_answers_attributes__value" />
        </div>

        <input type="hidden" value="153" name="fulfillment[answers_attributes][][field_id]" id="fulfillment_answers_attributes__field_id" />

        <div class="field">
            <label for="fulfillment_answers_attributes__value">List Single lines</label>
            <textarea name="fulfillment[answers_attributes][][value]" id="fulfillment_answers_attributes__value"></textarea>
        </div>

        <input type="hidden" value="154" name="fulfillment[answers_attributes][][field_id]" id="fulfillment_answers_attributes__field_id" />

        <div class="field">
            <label for="fulfillment_answers_attributes__value">Multi-line</label>
            <textarea name="fulfillment[answers_attributes][][value]" id="fulfillment_answers_attributes__value"></textarea>
        </div>

        <div class="actions">
            <input type="submit" value="Save" />
        </div>
    </form>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
