<div class="bg-card rounded-lg border border-border p-4 shadow-sm hover:shadow-md transition-all flex flex-col justify-between h-[210px]">
    <div>
        {{-- Header Card --}}
        <div class="flex items-start gap-3 mb-3">
            <div class="h-12 w-12 shrink-0 rounded-full bg-gradient-to-br from-primary to-primary/60 text-primary-foreground grid place-items-center text-sm font-semibold overflow-hidden">
                @if($speaker->photo_url)
                    <img src="{{ $speaker->photo_url }}" alt="{{ $speaker->name }}" class="w-full h-full object-cover">
                @else
                    {{ collect(explode(' ', $speaker->name))->map(fn($w) => substr($w, 0, 1))->slice(0, 2)->implode('') }}
                @endif
            </div>
            <div class="min-w-0 flex-1">
                <div class="text-sm font-semibold truncate">{{ $speaker->name }}</div>
                <div class="text-[11px] text-muted-foreground truncate h-[16px]" title="{{ $speaker->title ?? '' }}">
                    {{ $speaker->title ?? '' }}
                </div>
                <div class="mt-1">
                    @if(($speaker->type ?? 'speaker') === 'guest')
                        <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-amber-50 border border-amber-200 text-amber-600">Khách mời</span>
                    @else
                        <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-blue-50 border border-blue-200 text-blue-600">Diễn giả</span>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- Bio --}}
        <p class="text-[11px] text-muted-foreground leading-relaxed line-clamp-2 mb-3">
            {{ $speaker->bio ?? 'Chưa có tiểu sử.' }}
        </p>
    </div>

    {{-- Footer: Event count & Actions --}}
    <div class="flex items-center justify-between pt-3 border-t border-border mt-auto">
        <span class="inline-flex items-center h-5 px-1.5 rounded text-[10px] font-medium bg-secondary text-secondary-foreground whitespace-nowrap shrink-0">
            {{ $speaker->events_count ?? 0 }} sự kiện
        </span>
        
        <div class="flex items-center gap-1 shrink-0">
            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="LinkedIn">
                <i data-lucide="linkedin" class="h-3 w-3"></i>
            </a>
            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Twitter">
                <i data-lucide="twitter" class="h-3 w-3"></i>
            </a>
            <a href="#" class="h-6 w-6 rounded flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Website">
                <i data-lucide="globe" class="h-3 w-3"></i>
            </a>
            <span class="text-muted-foreground/30 mx-1 text-xs">|</span>
            <a href="{{ route('admin.speakers.edit', $speaker) }}" 
                class="h-7 w-7 rounded-md flex items-center justify-center text-muted-foreground hover:bg-accent hover:text-foreground transition-all" title="Sửa">
                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
            </a>
            <form action="{{ route('admin.speakers.destroy', $speaker) }}" method="POST" class="inline" 
                    onsubmit="return confirm('Bạn có chắc chắn muốn ẩn diễn giả này không?');">
                @csrf @method('DELETE')
                <button type="submit" 
                        class="h-7 w-7 rounded-md flex items-center justify-center text-muted-foreground hover:bg-red-50 hover:text-red-500 transition-all" title="Ẩn">
                    <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                </button>
            </form>
        </div>
    </div>
</div>
