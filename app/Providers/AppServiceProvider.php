<?php

namespace App\Providers;

use App\Services\ZohoService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Client\ClientInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->when(ZohoService::class)->needs(ClientInterface::class)->give(
          function () {
            return new Client(
              [
                'base_uri' => config('api.zoho.baseUrl')
              ]
            );
          }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
