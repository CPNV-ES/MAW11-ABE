<?php

//initialize page variables
$title = "403 error";
$style = '<link rel="stylesheet" href="/css/error.css">';

ob_start();

?>

<div class="rails-default-error-page">
    <div class="dialog">
        <div>
            <h1>We're sorry, but something went wrong.</h1>
        </div>
        <p>If you are the application owner check the logs for more information.</p>
    </div>
</div>

<?php

$content = ob_get_clean();

require VIEW_DIR . "/layout.php";
