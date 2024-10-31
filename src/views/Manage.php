<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Manage.css">';

ob_start();
?>

<header class="heading results">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>
    </section>
</header>

<main class="container">
    <div class="row">
        <section class="column">
            <h1>Building</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </section>

        <section class="column">
            <h1>Answering</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </section>

        <section class="column">
            <h1>Closed</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </section>
    </div>
</main>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
