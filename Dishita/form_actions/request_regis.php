
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    echo '<script type="text/javascript">';
    echo 'window.location.href="home.html";';
    echo '</script>';
    exit;
}

?>
