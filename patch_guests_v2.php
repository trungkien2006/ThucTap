<?php
foreach (['resources/views/admin/events/create.blade.php', 'resources/views/admin/events/edit.blade.php'] as $file) {
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // 1. Insert Guests Section after Speakers Section
    if (preg_match('/<!-- Section 4: Speakers -->.*?<\/section>/s', $content, $matches)) {
        $speakerSection = $matches[0];
        $guestSection = str_replace(
            ['Section 4: Speakers', 'Diễn giả', 'diễn giả', 'speaker', 'Speaker'],
            ['Section 5: Guests', 'Khách mời', 'khách mời', 'guest', 'Guest'],
            $speakerSection
        );
        $guestSection = str_replace('groups', 'person', $guestSection);
        
        if (strpos($content, '<!-- Section 5: Guests -->') === false) {
            $content = str_replace($speakerSection, $speakerSection . "\n\n" . $guestSection, $content);
        }
    } else {
        echo "Could not find Section 4 in $file\n";
    }
    
    // 2. Fix Section numbers
    $content = preg_replace('/<!-- Section 5: Banner -->/', '<!-- Section 6: Banner -->', $content);
    $content = preg_replace('/<!-- Section 6: Actions -->/', '<!-- Section 7: Actions -->', $content);
    
    // 3. Insert Add Guest Modal after Add Speaker Modal
    if (preg_match('/<!-- Add Speaker Modal -->.*?<!-- \/Add Speaker Modal -->/s', $content, $matchesModal)) {
        $speakerModal = $matchesModal[0];
        $guestModal = str_replace(
            ['Add Speaker Modal', 'Thêm diễn giả', 'Diễn giả', 'diễn giả', 'speaker', 'Speaker'],
            ['Add Guest Modal', 'Thêm khách mời', 'Khách mời', 'khách mời', 'guest', 'Guest'],
            $speakerModal
        );
        if (strpos($content, '<!-- Add Guest Modal -->') === false) {
            $content = str_replace($speakerModal, $speakerModal . "\n\n" . $guestModal, $content);
        }
    } else {
        echo "Could not find Add Speaker Modal in $file\n";
    }
    
    // 4. Insert Add Guest JS after Add Speaker JS
    $jsStart = strpos($content, '// Speaker Search');
    if ($jsStart !== false) {
        $jsEnd = strpos($content, '});', strpos($content, 'if (ajaxAddSpeakerForm) {'));
        $jsEnd = strpos($content, '}', $jsEnd) + 1;
        $jsEnd = strpos($content, '}', $jsEnd) + 1; // get out of the event listener
        
        // Actually, just regex match the block
        if (preg_match('/\/\/ Speaker Search.*?(?=\/\/ ===|<script|<\/script|\/\/ Editor|tinymce)/s', $content, $matchesJs)) {
            $speakerJs = $matchesJs[0];
            $guestJs = str_replace(
                ['Speaker Search', 'speaker', 'Speaker', 'Diễn giả', 'diễn giả', 'sp.title || \'Diễn giả\'', 'typeBadge.textContent = \'Diễn giả\';'],
                ['Guest Search', 'guest', 'Guest', 'Khách mời', 'khách mời', 'sp.title || \'Khách mời\'', 'typeBadge.textContent = \'Khách mời\';'],
                $speakerJs
            );
            
            if (strpos($content, '// Guest Search') === false) {
                $content = str_replace($speakerJs, rtrim($speakerJs) . "\n\n" . $guestJs, $content);
            }
        } else {
            echo "Could not find Speaker JS in $file\n";
        }
    }
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Successfully patched $file\n";
    } else {
        echo "No changes needed for $file\n";
    }
}
