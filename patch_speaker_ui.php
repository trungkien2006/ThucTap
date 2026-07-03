<?php
$content = file_get_contents('resources/views/admin/events/design.blade.php');

$alpineScript = <<<'SCRIPT'
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('speakerGuestManager', () => ({
            allPersons: @json($allSpeakers->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'bio' => Str::limit($s->bio, 30), 'photo' => $s->photo_url ? asset($s->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'])),
            selectedSpeakers: @json($event->speakers->where('pivot.role', 'speaker')->values()->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'photo' => $s->photo_url ? asset($s->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'])),
            selectedGuests: @json($event->speakers->where('pivot.role', 'guest')->values()->map(fn($s) => ['id' => $s->id, 'name' => $s->name, 'photo' => $s->photo_url ? asset($s->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'])),
            dropdownOpen: false,
            currentType: 'speaker', // 'speaker' or 'guest'
            searchQuery: '',

            openDropdown(type) {
                this.currentType = type;
                this.searchQuery = '';
                this.dropdownOpen = true;
                setTimeout(() => this.$refs.searchInput.focus(), 100);
            },
            
            closeDropdown() {
                this.dropdownOpen = false;
            },

            get filteredPersons() {
                if (this.searchQuery === '') return this.allPersons;
                return this.allPersons.filter(p => p.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
            },

            isSelected(id) {
                if (this.currentType === 'speaker') {
                    return this.selectedSpeakers.some(p => p.id === id);
                } else {
                    return this.selectedGuests.some(p => p.id === id);
                }
            },

            togglePerson(person) {
                if (this.currentType === 'speaker') {
                    if (this.isSelected(person.id)) {
                        this.selectedSpeakers = this.selectedSpeakers.filter(p => p.id !== person.id);
                    } else {
                        this.selectedSpeakers.push(person);
                    }
                } else {
                    if (this.isSelected(person.id)) {
                        this.selectedGuests = this.selectedGuests.filter(p => p.id !== person.id);
                    } else {
                        this.selectedGuests.push(person);
                    }
                }
            },

            removePerson(type, id) {
                if (type === 'speaker') {
                    this.selectedSpeakers = this.selectedSpeakers.filter(p => p.id !== id);
                } else {
                    this.selectedGuests = this.selectedGuests.filter(p => p.id !== id);
                }
            }
        }))
    });
</script>
SCRIPT;

$newUI = <<<'HTML'
                <!-- Right Column -->
                <div class="lg:col-span-4 space-y-6" style="position: sticky; top: 88px; align-self: start; height: max-content;" x-data="speakerGuestManager()">
                    
                    <!-- Speakers & Guests -->
                    <div class="uni-card p-6 transition-all relative" @click.away="closeDropdown()">
                        <!-- Speakers Section -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-3 border-b border-slate-100 pb-2">
                                <span class="text-[13px] text-slate-500 font-medium">Diễn giả tham gia</span>
                                <button type="button" @click="openDropdown('speaker')" class="material-symbols-outlined text-slate-400 hover:text-brand-orange transition-colors text-[18px]">add_circle</button>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="person in selectedSpeakers" :key="person.id">
                                    <div class="flex items-center gap-2 bg-orange-50 border border-orange-200 rounded-full py-1 pl-1 pr-3 shadow-sm">
                                        <img :src="person.photo" class="w-6 h-6 rounded-full object-cover">
                                        <span class="text-[12px] font-semibold text-primary" x-text="person.name"></span>
                                        <button type="button" @click="removePerson('speaker', person.id)" class="text-orange-400 hover:text-orange-600 ml-1 flex items-center"><span class="material-symbols-outlined text-[14px]">close</span></button>
                                        <input type="hidden" name="speaker_ids[]" :value="person.id" class="speaker-id-input">
                                    </div>
                                </template>
                                <div x-show="selectedSpeakers.length === 0" class="text-[12px] text-slate-400 italic">Chưa chọn diễn giả</div>
                            </div>
                        </div>

                        <!-- Guests Section -->
                        <div>
                            <div class="flex justify-between items-center mb-3 border-b border-slate-100 pb-2">
                                <span class="text-[13px] text-slate-500 font-medium">Khách mời đặc biệt</span>
                                <button type="button" @click="openDropdown('guest')" class="material-symbols-outlined text-slate-400 hover:text-brand-orange transition-colors text-[18px]">add_circle</button>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="person in selectedGuests" :key="person.id">
                                    <div class="flex items-center gap-2 bg-blue-50 border border-blue-200 rounded-full py-1 pl-1 pr-3 shadow-sm">
                                        <img :src="person.photo" class="w-6 h-6 rounded-full object-cover">
                                        <span class="text-[12px] font-semibold text-primary" x-text="person.name"></span>
                                        <button type="button" @click="removePerson('guest', person.id)" class="text-blue-400 hover:text-blue-600 ml-1 flex items-center"><span class="material-symbols-outlined text-[14px]">close</span></button>
                                        <input type="hidden" name="guest_ids[]" :value="person.id" class="guest-id-input">
                                    </div>
                                </template>
                                <div x-show="selectedGuests.length === 0" class="text-[12px] text-slate-400 italic">Chưa chọn khách mời</div>
                            </div>
                        </div>

                        <!-- Shared Dropdown Modal -->
                        <div x-show="dropdownOpen" class="absolute top-[40px] right-0 w-[300px] z-[60] bg-white rounded-2xl shadow-xl border border-slate-200 flex flex-col max-h-[350px]" style="display: none;">
                            <div class="p-3 border-b border-slate-100 flex items-center justify-between">
                                <div class="relative flex-1">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">search</span>
                                    <input type="text" x-model="searchQuery" x-ref="searchInput" :placeholder="currentType === 'speaker' ? 'Tìm tên diễn giả...' : 'Tìm khách mời...'" class="w-full pl-9 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[12px] focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all">
                                </div>
                                <button type="button" @click="closeDropdown()" class="ml-2 text-slate-400 hover:text-slate-600 flex items-center"><span class="material-symbols-outlined text-[18px]">close</span></button>
                            </div>
                            <div class="flex-1 overflow-y-auto p-2 space-y-1">
                                <template x-for="person in filteredPersons" :key="person.id">
                                    <div @click="togglePerson(person)" class="flex items-center justify-between p-2 rounded-xl hover:bg-orange-50 cursor-pointer transition-all">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg overflow-hidden shrink-0 bg-slate-100">
                                                <img :src="person.photo" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <h4 class="text-[12px] font-bold text-primary" x-text="person.name"></h4>
                                                <p class="text-[10px] text-slate-400 truncate max-w-[140px]" x-text="person.bio"></p>
                                            </div>
                                        </div>
                                        <div x-show="isSelected(person.id)">
                                            <span class="material-symbols-outlined text-brand-orange text-[18px]">check_circle</span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
HTML;

$pattern = '/<!-- Right Column -->.*?<!-- Schedule Card -->/s';
$content = preg_replace($pattern, $newUI . "\n\n                    <!-- Schedule Card -->", $content);

$content .= "\n" . $alpineScript;

file_put_contents('resources/views/admin/events/design.blade.php', $content);
?>
