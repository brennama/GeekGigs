<?php

namespace App\Providers;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class ElasticServiceProvider
 *
 * @package App\Providers
 */
class ElasticServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function () {
            return ClientBuilder::create()
                ->setHttpClient(new HttpClient(['verify' => false]))
                ->setSSLVerification(false)
                ->setHosts(config('database.connections.elasticsearch.hosts'))
                ->build();
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [Client::class];
    }
}
