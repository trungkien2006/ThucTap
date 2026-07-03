<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Masbug\Flysystem\GoogleDriveAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Storage::extend('google', function ($app, $config) {
            try {
                if (empty($config['clientId']) || empty($config['clientSecret']) || empty($config['refreshToken'])) {
                    throw new \Exception("Google Drive credentials are not fully configured in .env");
                }

                $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
                $client = new \Google\Client();
                $client->setHttpClient($guzzleClient);
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);

                $service = new \Google\Service\Drive($client);

                $options = [];
                if (isset($config['teamDriveId'])) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }
                if (isset($config['folderId'])) {
                    $options['sharedFolderId'] = $config['folderId'];
                }

                $adapter = new GoogleDriveAdapter($service, null, $options);

                return new \Illuminate\Filesystem\FilesystemAdapter(
                    new Filesystem($adapter),
                    $adapter,
                    $config
                );
            } catch (\Exception $e) {
                \Log::warning("Google Drive client failed: " . $e->getMessage() . ". Falling back to local public disk.");
                return Storage::disk('public');
            }
        });
    }
}
