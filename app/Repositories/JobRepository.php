<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Job;
use Elastic\Elasticsearch\Client;
use Throwable;

/**
 * Class JobRepository
 *
 * @package App\Repositories
 */
class JobRepository
{
    /**
     * JobRepository constructor.
     */
    public function __construct(private readonly Client $client)
    {

    }

    /**
     * Retrieve document by its id.
     *
     * @throws Throwable
     */
    public function find(int|string $id): ?Job
    {
        try {
            $response = $this->client->get([
                'index' => 'jobs',
                'id' => (int) $id,
            ]);

            if ($response->getStatusCode() === 404) {
                return null;
            }

            $decoded = json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            $job = $decoded['_source'];
            $job['id'] = $decoded['_id'];

            return Job::hydrate($job);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Index document.
     *
     * @throws Throwable
     */
    public function save(Job $model): bool
    {
        $this->client->index([
            'index' => 'jobs',
            'body' => $model->toArray(),
        ]);

        return true;
    }
}
