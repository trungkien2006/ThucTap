<?php
$file = 'resources/views/admin/events/edit.blade.php';
$content = file_get_contents($file);
if (strpos($content, 'has_speakers_field') === false) {
    $content = str_replace('<form ', '<form ' . "\n" . '                    <input type="hidden" name="has_speakers_field" value="1">' . "\n" . '                    <input type="hidden" name="has_guests_field" value="1">', $content);
    file_put_contents($file, $content);
    echo "Fixed edit.blade.php\n";
}
