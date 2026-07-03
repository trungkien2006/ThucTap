<?php
foreach (['resources/views/admin/events/create.blade.php', 'resources/views/admin/events/edit.blade.php'] as $file) {
    $content = file_get_contents($file);
    
    // Find Guest JS section
    $guestJsStart = strpos($content, '// Guest Search');
    if ($guestJsStart !== false) {
        $before = substr($content, 0, $guestJsStart);
        $after = substr($content, $guestJsStart);
        
        $after = str_replace("admin.guests.store", "admin.speakers.store", $after);
        $after = str_replace("addEventListener('click', closeAddModal)", "addEventListener('click', closeAddGuestModal)", $after);
        
        // Modal details
        $after = str_replace("getElementById('modalGuestPhoto')", "getElementById('modalSpeakerPhoto')", $after);
        $after = str_replace("getElementById('modalGuestName')", "getElementById('modalSpeakerName')", $after);
        $after = str_replace("getElementById('modalGuestTitle')", "getElementById('modalSpeakerTitle')", $after);
        $after = str_replace("getElementById('modalGuestBio')", "getElementById('modalSpeakerBio')", $after);
        $after = str_replace("getElementById('modalGuestType')", "getElementById('modalSpeakerType')", $after);
        
        // The id=guestModal doesn't exist, we use id=speakerModal for both!
        // My previous script already changed guestModal to speakerModal, but just in case:
        $after = str_replace("document.getElementById('guestModal').classList.remove('hidden')", "document.getElementById('speakerModal').classList.remove('hidden')", $after);
        
        $content = $before . $after;
        file_put_contents($file, $content);
        echo "Fixed $file\n";
    }
}
