<?php
$str = "Trang chÃ¡Â»Â§";
$fixed = mb_convert_encoding($str, 'Windows-1252', 'UTF-8');
$fixed = mb_convert_encoding($fixed, 'Windows-1252', 'UTF-8');
echo "Double decode: " . $fixed . "\n";
