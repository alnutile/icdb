<?php

namespace App\Providers;

use App\MarvelApi;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class MarvelProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\MarvelInterface', function() {
            $base_url = env('MARVEL_URL');
            $client = new Client(['base_uri' => $base_url]);
            $key = env('MARVEL_KEY');
            $secret = env('MARVEL_SECRET');
            $client =  new MarvelApi($key, $secret, $client);

            $client->setApiVersion(env('MARVEL_API_VERSION'));
            return $client;
        });

    }
}
