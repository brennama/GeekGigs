<?php

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private readonly Client $client;

    /**
     * Anonymous class constructor.
     */
    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHttpClient(new HttpClient(['verify' => false]))
            ->setSSLVerification(false)
            ->setHosts(config('database.connections.elasticsearch.hosts'))
            ->build();
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->client->indices()->create([
            'index' => 'jobs',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 1,
                ],
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->client->indices()->delete(['index' => 'jobs']);
    }
};
