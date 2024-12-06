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
    <h1>Fulfillments for m k kc dc</h1>

    <table>
        <thead>
            <tr>
                <th>Taken at</th>
                <th colspan="3"></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>2024-12-06 07:08:56 UTC</td>
                <td><a href="/exercises/227/fulfillments/173">Show</a></td>
                <td><a href="/exercises/227/fulfillments/173/edit">Edit</a></td>
                <td><a data-confirm="Are you sure?" rel="nofollow" data-method="delete" href="/exercises/227/fulfillments/173">Destroy</a></td>
            </tr>
            <tr>
                <td>2024-12-06 07:08:59 UTC</td>
                <td><a href="/exercises/227/fulfillments/174">Show</a></td>
                <td><a href="/exercises/227/fulfillments/174/edit">Edit</a></td>
                <td><a data-confirm="Are you sure?" rel="nofollow" data-method="delete" href="/exercises/227/fulfillments/174">Destroy</a></td>
            </tr>
        </tbody>
    </table>
</main>


<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
