<?php
$content = file_get_contents('resources/views/events/show-template3.blade.php');
$fixed = mb_convert_encoding($content, 'Windows-1252', 'UTF-8');
$fixed = mb_convert_encoding($fixed, 'Windows-1252', 'UTF-8');
file_put_contents('resources/views/events/show-template3.blade.php', $fixed);
echo "Fixed template 3 encoding!\n";
