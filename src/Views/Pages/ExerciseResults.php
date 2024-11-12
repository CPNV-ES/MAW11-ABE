<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Results.css">';

$exercise = $data["exercise"];

ob_start();
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
        <span class="exercise-label">Exercise: <a href="/exercises/<?= $exercise["id"]; ?>/fields"><?= htmlspecialchars($exercise["title"], ENT_QUOTES, 'UTF-8') ?></a></span>
    </section>
</header>

<main class="container">
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th><a href="/exercises/174/results/309">Single line</a></th>
                <th><a href="/exercises/174/results/310">Single line</a></th>
                <th><a href="/exercises/174/results/311">Single line</a></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><a href="/exercises/174/fulfillments/103">2024-11-06 11:15:11 UTC</a></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
            </tr>
            <tr>
                <td><a href="/exercises/174/fulfillments/104">2024-11-06 11:15:20 UTC</a></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
            </tr>
            <tr>
                <td><a href="/exercises/174/fulfillments/105">2024-11-06 11:15:26 UTC</a></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
            </tr>
            <tr>
                <td><a href="/exercises/174/fulfillments/111">2024-11-08 07:23:45 UTC</a></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
            </tr>
            <tr>
                <td><a href="/exercises/174/fulfillments/112">2024-11-08 07:25:13 UTC</a></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
                <td class="answer"><i class="fa fa-check short"></i></td>
            </tr>
        </tbody>
    </table>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/layout.php";
