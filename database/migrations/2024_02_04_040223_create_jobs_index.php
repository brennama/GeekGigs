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
                'mappings' => [
                    'properties' => [
                        'userId' => [
                            'type' => 'integer',
                        ],
                        'title' => [
                            'type' => 'text',
                        ],
                        'company' => [
                            'type' => 'text',
                        ],
                        'companyUrl' => [
                            'type' => 'text',
                            'index' => false,
                        ],
                        'jobUrl' => [
                            'type' => 'text',
                            'index' => false,
                        ],
                        'description' => [
                            'type' => 'text',
                        ],
                        'city' => [
                            'type' => 'keyword',
                        ],
                        'state' => [
                            'type' => 'keyword',
                        ],
                        'jobType' => [
                            'type' => 'keyword',
                        ],
                        'remotePolicy' => [
                            'type' => 'keyword',
                        ],
                        'experienceLevel' => [
                            'type' => 'keyword',
                        ],
                        'salaryRangeMin' => [
                            'type' => 'integer',
                            'index' => false,
                        ],
                        'salaryRangeMax' => [
                            'type' => 'integer',
                            'index' => false,
                        ],
                        'archived' => [
                            'type' => 'boolean',
                        ],
                        'createdAt' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis',
                            'ignore_malformed' => true,
                        ],
                        'updatedAt' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis',
                            'ignore_malformed' => true,
                            'null_value' => null,
                        ],
                    ],
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
