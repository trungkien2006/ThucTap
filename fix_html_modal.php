<?php
foreach (['resources/views/admin/events/create.blade.php', 'resources/views/admin/events/edit.blade.php'] as $file) {
    $content = file_get_contents($file);
    
    // Check if addGuestModal already exists
    if (strpos($content, 'id="addGuestModal"') === false) {
        // Extract Add Speaker Modal HTML
        preg_match('/<!-- Add Speaker Modal -->.*?<\/div>\s*<\/div>\s*@endsection/s', $content, $matches);
        if (!empty($matches)) {
            $speakerModalBlock = $matches[0];
            
            // Generate Guest Modal HTML by replacing strings, but DO NOT replace @endsection
            $guestModalHtml = str_replace(
                ['Add Speaker Modal', 'Thêm diễn giả', 'Diễn giả', 'diễn giả', 'speaker', 'Speaker', '@endsection'],
                ['Add Guest Modal', 'Thêm khách mời', 'Khách mời', 'khách mời', 'guest', 'Guest', ''],
                $speakerModalBlock
            );
            
            // Insert Guest Modal before @endsection
            $content = str_replace('@endsection', $guestModalHtml . "\n@endsection", $content);
            file_put_contents($file, $content);
            echo "Added Guest Modal to $file\n";
        } else {
            echo "Could not find Add Speaker Modal in $file\n";
        }
    } else {
        echo "Guest Modal already exists in $file\n";
    }
}
