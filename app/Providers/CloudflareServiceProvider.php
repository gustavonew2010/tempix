<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CloudflareServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/cloudflare.php', 'cloudflare'
        );
    }

    public function boot()
    {
        // Publicar configuração
        $this->publishes([
            __DIR__.'/../../config/cloudflare.php' => config_path('cloudflare.php'),
        ], 'config');
    }
}