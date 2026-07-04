<?php
foreach (['resources/views/admin/events/create.blade.php', 'resources/views/admin/events/edit.blade.php'] as $file) {
    $content = file_get_contents($file);
    
    // 1. Insert Guests Section after Speakers Section
    preg_match('/<!-- Section 4: Speakers -->.*?<\/section>/s', $content, $matches);
    if (!empty($matches)) {
        $speakerSection = $matches[0];
        $guestSection = str_replace(
            ['Section 4: Speakers', 'Diễn giả', 'diễn giả', 'speaker', 'Speaker'],
            ['Section 5: Guests', 'Khách mời', 'khách mời', 'guest', 'Guest'],
            $speakerSection
        );
        // Fix a few specific words in guestSection
        $guestSection = str_replace('groups', 'person', $guestSection); // Icon
        
        if (strpos($content, '<!-- Section 5: Guests -->') === false) {
            $content = str_replace($speakerSection, $speakerSection . "\n\n" . $guestSection, $content);
        }
    }
    
    // 2. Fix Section numbers
    $content = preg_replace('/<!-- Section 5: Banner -->/', '<!-- Section 6: Banner -->', $content);
    $content = preg_replace('/<!-- Section 6: Actions -->/', '<!-- Section 7: Actions -->', $content);
    
    // 3. Insert Add Guest Modal after Add Speaker Modal
    preg_match('/<!-- Add Speaker Modal -->.*?<!-- \/Add Speaker Modal -->/s', $content, $matchesModal);
    if (!empty($matchesModal)) {
        $speakerModal = $matchesModal[0];
        $guestModal = str_replace(
            ['Add Speaker Modal', 'Thêm diễn giả', 'Diễn giả', 'diễn giả', 'speaker', 'Speaker'],
            ['Add Guest Modal', 'Thêm khách mời', 'Khách mời', 'khách mời', 'guest', 'Guest'],
            $speakerModal
        );
        if (strpos($content, '<!-- Add Guest Modal -->') === false) {
            $content = str_replace($speakerModal, $speakerModal . "\n\n" . $guestModal, $content);
        }
    }
    
    // 4. Insert Add Guest JS after Add Speaker JS
    $jsSearchStr = <<<EOD
    // Speaker Search
    const speakerSearch = document.getElementById('speaker_search');
    const speakerList = document.getElementById('speaker_list_container');
    const speakerEmptyState = document.getElementById('speaker_search_empty');

    if (speakerSearch && speakerList) {
        speakerSearch.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const labels = speakerList.querySelectorAll('label');
            let hasVisibleItem = false;

            labels.forEach(label => {
                const name = label.querySelector('.speaker-name-text').textContent.toLowerCase();
                const title = label.querySelector('.speaker-title-text').textContent.toLowerCase();
                if (name.includes(term) || title.includes(term)) {
                    label.classList.remove('hidden');
                    hasVisibleItem = true;
                } else {
                    label.classList.add('hidden');
                }
            });

            if (hasVisibleItem) {
                if (speakerEmptyState) speakerEmptyState.classList.add('hidden');
            } else {
                if (speakerEmptyState) speakerEmptyState.classList.remove('hidden');
            }
        });
    }

    // Add Speaker Modal controls
    const addSpeakerModal = document.getElementById('addSpeakerModal');
    const openAddSpeakerBtns = document.querySelectorAll('.open-add-speaker-modal-btn');
    const closeAddSpeakerModalBtn = document.getElementById('closeAddSpeakerModalBtn');
    const cancelAddSpeakerBtn = document.getElementById('cancelAddSpeakerBtn');
    const ajaxAddSpeakerForm = document.getElementById('ajaxAddSpeakerForm');
    const addSpeakerSpinner = document.getElementById('add_speaker_spinner');

    if (openAddSpeakerBtns) {
        openAddSpeakerBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                addSpeakerModal.classList.remove('hidden');
            });
        });
    }

    const closeAddModal = () => {
        addSpeakerModal.classList.add('hidden');
        ajaxAddSpeakerForm.reset();
    };

    if (closeAddSpeakerModalBtn) closeAddSpeakerModalBtn.addEventListener('click', closeAddModal);
    if (cancelAddSpeakerBtn) cancelAddSpeakerBtn.addEventListener('click', closeAddModal);

    window.addEventListener('click', function(e) {
        if (e.target === addSpeakerModal) {
            closeAddModal();
        }
    });

    if (ajaxAddSpeakerForm) {
        ajaxAddSpeakerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (addSpeakerSpinner) addSpeakerSpinner.classList.remove('hidden');
            const submitBtn = ajaxAddSpeakerForm.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.disabled = true;

            const formData = new FormData(this);

            fetch('{{ route("admin.speakers.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.speaker) {
                    const sp = data.speaker;
                    
                    const photoUrl = sp.photo_url 
                        ? ((sp.photo_url.startsWith('http') || sp.photo_url.startsWith('/')) ? sp.photo_url : \`/\${sp.photo_url}\`) 
                        : \`https://ui-avatars.com/api/?name=\${encodeURIComponent(sp.name)}&background=random\`;

                    const html = \`
                        <label class="flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg cursor-pointer hover:border-brand-orange transition-all relative">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="speaker_ids[]" value="\${sp.id}" checked class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange w-4 h-4">
                                <div class="flex items-center gap-3">
                                    <img src="\${photoUrl}" class="w-8 h-8 rounded-full object-cover">
                                    <div>
                                        <p class="text-[13px] font-semibold text-primary speaker-name-text">\${sp.name}</p>
                                        <p class="text-[11px] text-slate-400 speaker-title-text">\${sp.title || 'Diễn giả'}</p>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="speaker-details-btn p-1 text-slate-400 hover:text-brand-orange hover:bg-slate-50 rounded-lg transition-colors z-20"
                                data-name="\${sp.name}"
                                data-title="\${sp.title || ''}"
                                data-photo="\${photoUrl}"
                                data-bio="\${sp.bio || ''}"
                                data-type="\${sp.type || 'speaker'}">
                                <span class="material-symbols-outlined text-[20px]">info</span>
                            </button>
                        </label>
                    \`;

                    const noSpeakerText = speakerList.querySelector('.col-span-full:not(#speaker_search_empty)');
                    if (noSpeakerText) {
                        noSpeakerText.remove();
                    }

                    speakerList.insertAdjacentHTML('afterbegin', html);
                    closeAddModal();

                    // Re-bind click event for the new details button
                    const newBtn = speakerList.querySelector('.speaker-details-btn');
                    if (newBtn) {
                        newBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            const name = this.getAttribute('data-name');
                            const title = this.getAttribute('data-title');
                            const bio = this.getAttribute('data-bio');
                            const photo = this.getAttribute('data-photo');
                            const type = this.getAttribute('data-type');
                            
                            document.getElementById('modalSpeakerName').textContent = name;
                            document.getElementById('modalSpeakerTitle').textContent = title || 'Diễn giả';
                            document.getElementById('modalSpeakerBio').textContent = bio || 'Chưa có thông tin.';
                            document.getElementById('modalSpeakerPhoto').src = photo;
                            
                            const typeBadge = document.getElementById('modalSpeakerType');
                            if (type === 'speaker') {
                                typeBadge.textContent = 'Diễn giả';
                                typeBadge.className = 'inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-blue-50 border border-blue-200 text-blue-600';
                            } else {
                                typeBadge.textContent = 'Khách mời';
                                typeBadge.className = 'inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-purple-50 border border-purple-200 text-purple-600';
                            }
                            
                            document.getElementById('speakerDetailsModal').classList.remove('hidden');
                        });
                    }
                } else {
                    alert('Không thể lưu diễn giả. Vui lòng thử lại.');
                }
            })
            .catch(err => {
                console.error(err);
                if (err.errors) {
                    alert(Object.values(err.errors).flat().join('\\n'));
                } else {
                    alert('Có lỗi xảy ra khi thêm diễn giả.');
                }
            })
            .finally(() => {
                if (addSpeakerSpinner) addSpeakerSpinner.classList.add('hidden');
                if (submitBtn) submitBtn.disabled = false;
            });
        });
    }
EOD;
    $guestJs = str_replace(
        ['speaker', 'Speaker', 'Diễn giả', 'diễn giả', 'sp.title || \'Diễn giả\'', 'typeBadge.textContent = \'Diễn giả\';'],
        ['guest', 'Guest', 'Khách mời', 'khách mời', 'sp.title || \'Khách mời\'', 'typeBadge.textContent = \'Khách mời\';'],
        $jsSearchStr
    );
    // Be careful with JS string replacements for the typeBadge part, they are already handled by data-type above!
    // But the modal details JS logic is shared (speakerDetailsModal), so we don't need to duplicate the details modal JS part.
    // Let's just do a simpler search and replace.

    if (strpos($content, '// Guest Search') === false) {
        $content = str_replace($jsSearchStr, $jsSearchStr . "\n\n" . $guestJs, $content);
    }
    
    file_put_contents($file, $content);
    echo "Patched $file\n";
}
