@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-xl font-bold text-foreground font-heading leading-tight">Lịch sử hoạt động</h1>
        <p class="text-xs text-muted-foreground mt-1">Lịch sử cập nhật thông tin và cài đặt bảo mật cho tài khoản của bạn</p>
    </div>

    <!-- Timeline Wrapper -->
    <div class="bg-card rounded-xl border-none p-6 shadow-2xl shadow-slate-300/60 hover:-translate-y-2 hover:shadow-slate-300/80 transition-all duration-300">
        @if(count($activities) > 0)
        <div class="relative border-l border-border pl-6 ml-3 space-y-6 py-2">
            @foreach($activities as $act)
            @php
                $userName = $act['user_name'] ?? 'Admin';
            @endphp
            <div class="relative">
                <!-- Timeline Dot Indicator -->
                <span class="absolute -left-[31px] top-1.5 flex h-4.5 w-4.5 items-center justify-center rounded-full bg-background border border-primary text-primary">
                    <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                </span>
                
                <div class="space-y-1.5">
                    @if(isset($act['url']))
                        <a href="{{ $act['url'] }}" class="block hover:underline">
                            <div class="text-xs font-semibold text-foreground leading-snug">
                                <span class="font-bold text-primary">{{ $userName }}</span> {{ $act['activity'] }}
                            </div>
                        </a>
                    @else
                        <div class="text-xs font-semibold text-foreground leading-snug">
                            <span class="font-bold text-primary">{{ $userName }}</span> {{ $act['activity'] }}
                        </div>
                    @endif
                    <div class="flex items-center gap-1.5 text-[10px] text-muted-foreground font-mono">
                        <i data-lucide="clock" class="h-3.5 w-3.5"></i>
                        <span>{{ \Carbon\Carbon::parse($act['created_at'])->format('Y-m-d H:i:s') }}</span>
                        <span>·</span>
                        <span>{{ \Carbon\Carbon::parse($act['created_at'])->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="h-12 w-12 rounded-full bg-accent flex items-center justify-center mx-auto mb-3">
                <i data-lucide="history" class="h-5 w-5 text-muted-foreground"></i>
            </div>
            <p class="text-xs font-medium text-foreground">Không tìm thấy hoạt động nào</p>
            <p class="text-[11px] text-muted-foreground mt-0.5">Các hoạt động thay đổi thông tin tài khoản sẽ xuất hiện tại đây.</p>
        </div>
        @endif
    </div>
</div>
@endsection
