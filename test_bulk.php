<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $ids = App\Models\EventMedia::take(2)->pluck('id')->toArray();
    $req = Illuminate\Http\Request::create('/admin/media/bulk-destroy', 'POST', ['ids' => $ids]);
    
    // login as admin
    $user = App\Models\User::first();
    auth()->login($user);

    $app->make(\Illuminate\Contracts\Http\Kernel::class);
    // disable csrf
    app()->instance(\App\Http\Middleware\VerifyCsrfToken::class, new class {
        public function handle($request, $next) { return $next($request); }
    });

    $resp = app()->handle($req);
    echo $resp->getContent();
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}
