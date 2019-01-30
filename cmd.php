<?php
$output = shell_exec('php artisan cache:clear');
echo "<br>";
$output .= shell_exec('php artisan config:cache');
echo "<br>";
$output .= shell_exec('php artisan config:clear');
echo "<br>";
$output .= shell_exec('php artisan route:clear');
echo "<br>";
$output .= shell_exec('php artisan view:clear');
echo "<br>";
$output .= shell_exec('php artisan optimize');


echo "<pre>$output</pre>";
?>