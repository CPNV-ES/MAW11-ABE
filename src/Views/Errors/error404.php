<?php

//initialize page variables
$title = "404 error";
$style = '<link rel="stylesheet" href="/css/error.css">';

ob_start();
?>

<div class="rails-default-error-page">
    <div class="dialog">
        <div>
            <h1>The page you were looking for doesn't exist.</h1>
            <p>You may have mistyped the address or the page may have moved.</p>
        </div>
        <p>If you are the application owner check the logs for more information.</p>
    </div>
</div>


<?php

$content = ob_get_clean();

require VIEW_DIR . "/layout.php";
