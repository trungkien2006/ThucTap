@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-surface-gray py-20 px-margin-mobile md:px-margin-desktop flex items-center justify-center">
    <div class="max-w-xl w-full">
        <!-- Success Card -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-[0px_4px_20px_rgba(0,0,0,0.05)] border border-outline-variant/30 overflow-hidden relative">
            
            <!-- Header Pattern -->
            <div class="h-32 bg-fpt-orange relative overflow-hidden flex items-center justify-center">
                <div class="absolute inset-0 opacity-20">
                    <span class="material-symbols-outlined text-[120px] text-pure-white absolute -right-10 -bottom-10 rotate-12" style="font-variation-settings: 'FILL' 1;">celebration</span>
                </div>
                <div class="w-16 h-16 bg-pure-white rounded-full flex items-center justify-center shadow-lg relative z-10">
                    <span class="material-symbols-outlined text-green-500 text-4xl font-bold" data-icon="check_circle">check_circle</span>
                </div>
            </div>

            <div class="p-8 md:p-12 text-center">
                <h1 class="font-headline-lg text-headline-lg text-deep-navy mb-2">Registration Successful!</h1>
                <p class="font-body-md text-body-md text-text-muted mb-8">
                    Thank you for registering for <strong>{{ $registration->event->title }}</strong>.<br>
                    Your e-ticket is ready.
                </p>

                <!-- Ticket Area -->
                <div class="bg-surface-gray rounded-xl p-6 border border-outline-variant/30 relative">
                    <!-- Ticket cutouts -->
                    <div class="w-6 h-6 bg-surface-container-lowest rounded-full absolute -left-3 top-1/2 -translate-y-1/2 border border-outline-variant/30"></div>
                    <div class="w-6 h-6 bg-surface-container-lowest rounded-full absolute -right-3 top-1/2 -translate-y-1/2 border border-outline-variant/30"></div>
                    
                    <div class="mb-6">
                        <p class="font-label-sm text-label-sm text-text-muted uppercase tracking-wider mb-1">Attendee Name</p>
                        <p class="font-headline-md text-[20px] text-deep-navy font-bold">{{ $registration->full_name }}</p>
                        @if($registration->student_id)
                        <p class="font-body-sm text-body-sm text-text-muted mt-1">{{ $registration->student_id }}</p>
                        @endif
                    </div>

                    <div class="border-t border-dashed border-outline-variant pt-6 flex flex-col items-center">
                        <p class="font-label-sm text-label-sm text-text-muted uppercase tracking-wider mb-4">Your Event QR Code</p>
                        <div class="p-4 bg-white rounded-xl shadow-sm border border-outline-variant/30 inline-block mb-2">
                            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($registration->qr_code) !!}
                        </div>
                        <p class="font-body-sm text-body-sm text-text-muted max-w-[250px]">
                            Please save this QR code or check your email. You will need it to check-in at the event.
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                    <button onclick="window.print()" class="px-6 py-3 font-label-lg text-label-lg text-deep-navy border border-deep-navy/20 rounded-lg hover:bg-surface-gray transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">print</span> Print Ticket
                    </button>
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-fpt-orange text-pure-white font-label-lg text-label-lg rounded-lg shadow-md shadow-fpt-orange/20 hover:brightness-110 transition-all flex items-center justify-center gap-2">
                        Return to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
