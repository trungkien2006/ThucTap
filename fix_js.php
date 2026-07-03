<?php
foreach (['resources/views/admin/events/create.blade.php', 'resources/views/admin/events/edit.blade.php'] as $file) {
    $content = file_get_contents($file);
    
    // Find the Guest JS section
    $guestJsStart = strpos($content, '// Guest Search');
    if ($guestJsStart !== false) {
        $before = substr($content, 0, $guestJsStart);
        $after = substr($content, $guestJsStart);
        
        $after = str_replace('const closeAddModal =', 'const closeAddGuestModal =', $after);
        $after = str_replace('closeAddModal()', 'closeAddGuestModal()', $after);
        $after = str_replace('closeAddModal;', 'closeAddGuestModal;', $after);
        
        // Also fix modal references inside the newly added js block
        $after = str_replace("document.getElementById('guestModal').classList.remove('hidden');", "document.getElementById('speakerModal').classList.remove('hidden');", $after);
        
        $content = $before . $after;
        file_put_contents($file, $content);
        echo "Fixed $file\n";
    }
}
